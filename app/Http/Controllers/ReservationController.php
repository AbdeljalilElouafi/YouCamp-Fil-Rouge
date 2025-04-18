<?php


namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Auberge;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;



class ReservationController extends Controller
{

    use AuthorizesRequests;

    public function create()
    {
        $auberge = Auberge::findOrFail(request('auberge_id'));
        return view('reservations.create', compact('auberge'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'auberge_id' => 'required|exists:auberges,id',
            'room_id' => $request->payment_method === 'stripe' ? 'required|exists:rooms,id' : 'nullable|exists:rooms,id',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1|max:10',
            'total_price' => 'required|numeric|min:0',
            'special_requests' => 'nullable|string',
            'payment_method' => 'required|in:cash,stripe'
        ]);
        
        $validated['user_id'] = auth()->id();
        $validated['status'] = $request->payment_method === 'cash' ? 'confirmed' : 'pending';
    
        $reservation = Reservation::create($validated);
    
        if ($request->payment_method === 'stripe') {
            Stripe::setApiKey(config('services.stripe.secret'));
    
            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => config('services.stripe.currency', 'usd'),
                        'product_data' => [
                            'name' => 'Stay at '.$reservation->auberge->name,
                        ],
                        'unit_amount' => $reservation->total_price * 100,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('payment.success', $reservation),
                'cancel_url' => route('payment.cancel', $reservation),
                'metadata' => [
                    'reservation_id' => $reservation->id
                ],
            ]);
    
            $reservation->update(['stripe_session_id' => $session->id]);
    
            return redirect($session->url);
        }
    
        return redirect()->route('reservations.show', $reservation)
            ->with('success', 'Reservation confirmed! Please bring cash on arrival.');
    }

    public function show(Reservation $reservation)
    {
        return view('reservations.show', compact('reservation'));
    }

   

    public function index()
    {
        $reservations = auth()->user()->reservations()
            ->with(['auberge', 'room'])
            ->latest()
            ->get();

        return view('reservations.index', compact('reservations'));
    }

    public function edit(Reservation $reservation)
    {
        $this->authorize('update', $reservation);
        
        if ($reservation->status !== 'pending') {
            return redirect()->back()->with('error', 'Only pending reservations can be modified');
        }

        return view('reservations.edit', [
            'reservation' => $reservation,
            'auberge' => $reservation->auberge
        ]);
    }

    public function update(Request $request, Reservation $reservation)
    {
        $this->authorize('update', $reservation);

        if ($reservation->status !== 'pending') {
            return redirect()->back()->with('error', 'Only pending reservations can be modified');
        }

        $validated = $request->validate([
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1|max:10',
            'special_requests' => 'nullable|string'
        ]);

        $reservation->update($validated);

        return redirect()->route('reservations.show', $reservation)
            ->with('success', 'Reservation updated successfully!');
    }

    public function destroy(Reservation $reservation)
    {
        

        if (!in_array($reservation->status, ['pending', 'confirmed'])) {
            return redirect()->back()->with('error', 'Only pending or confirmed reservations can be cancelled');
        }

        $reservation->update(['status' => 'cancelled']);

        return redirect()->route('reservations.index')
            ->with('success', 'Reservation cancelled successfully!');
    }

    public function paymentSuccess(Reservation $reservation)
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    
        if (empty($reservation->stripe_session_id)) {
            return redirect()->route('reservations.show', $reservation)
                ->with('error', 'No Stripe session ID found. Payment verification failed.');
        }
    
        try {
            $session = \Stripe\Checkout\Session::retrieve($reservation->stripe_session_id);
    
            if ($session->payment_status === 'paid') {
                $reservation->update(['status' => 'confirmed']);
                return redirect()->route('reservations.show', $reservation)
                    ->with('success', 'Payment successful! Your reservation is confirmed.');
            }
    
            return redirect()->route('reservations.show', $reservation)
                ->with('error', 'Payment not completed yet. Please check again later.');
        } catch (\Exception $e) {
            return redirect()->route('reservations.show', $reservation)
                ->with('error', 'Payment verification failed: ' . $e->getMessage());
        }
    }
    

    public function paymentCancel(Reservation $reservation)
    {
        $reservation->update(['status' => 'cancelled']);
        return redirect()->route('auberges.show', $reservation->auberge)
            ->with('error', 'Payment was cancelled. Your reservation has been removed.');
    }


}