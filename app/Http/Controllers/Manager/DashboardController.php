<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $auberges = $user->auberges()->withCount('reservations')->get();

        return view('manager.dashboard', [
            'myAuberges' => $auberges,
            'activeReservations' => $this->getActiveReservationsCount($user),
            'monthlyRevenue' => $this->getMonthlyRevenue($user),
            'recentReservations' => $this->getRecentReservations($user)
        ]);
    }

    protected function getActiveReservationsCount($user)
    {
        return Reservation::whereIn('auberge_id', $user->auberges()->pluck('id'))
            ->where('status', 'confirmed')
            ->count();
    }

    protected function getMonthlyRevenue($user)
    {
        return Reservation::whereIn('auberge_id', $user->auberges()->pluck('id'))
            ->where('status', 'confirmed')
            ->whereMonth('created_at', now()->month)
            ->sum('total_price');
    }

    protected function getRecentReservations($user)
    {
        return Reservation::whereIn('auberge_id', $user->auberges()->pluck('id'))
            ->with(['auberge', 'user'])
            ->latest()
            ->take(5)
            ->get();
    }
}
