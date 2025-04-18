@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 animate-fade-in">
    <div class="max-w-4xl mx-auto bg-gray-800 rounded-xl shadow-2xl overflow-hidden">
        <div class="bg-gradient-to-r from-orange-600 to-orange-400 p-8 text-white">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-3xl font-bold">Reservation Details</h1>
                    <p class="mt-1 text-orange-100">#{{ $reservation->id }}</p>
                </div>
                <span class="px-4 py-1 rounded-full text-sm font-bold
                    @if($reservation->status === 'confirmed') bg-green-900 text-green-300
                    @elseif($reservation->status === 'cancelled') bg-red-900 text-red-300
                    @else bg-yellow-900 text-yellow-300 @endif">
                    {{ ucfirst($reservation->status) }}
                </span>
            </div>
        </div>

        <div class="p-8 space-y-8">
            <!-- Auberge Details -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h2 class="text-2xl font-semibold text-white">{{ $reservation->auberge->name }}</h2>
                    <p class="text-gray-400">{{ $reservation->auberge->address }}</p>
                    <p class="text-gray-400">{{ $reservation->auberge->city->ville }}</p>
                </div>
                <div class="md:text-right">
                    <a href="{{ route('auberges.show', $reservation->auberge) }}"
                       class="inline-block text-orange-400 hover:text-orange-300 transition">
                        <i class="fas fa-external-link-alt mr-1"></i> View Auberge
                    </a>
                </div>
            </div>

            <!-- Booking Timeline -->
            <div class="bg-gray-700 p-6 rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="text-center">
                        <p class="text-sm text-gray-400">Check-in</p>
                        <p class="text-lg font-semibold text-white">{{ $reservation->check_in->format('D, M d, Y') }}</p>
                        <p class="text-sm text-gray-400">2:00 PM</p>
                    </div>
                    <div class="flex items-center justify-center">
                        <div class="h-px bg-gray-600 w-full relative">
                            <span class="absolute -top-3 left-1/2 transform -translate-x-1/2 bg-gray-700 px-2 text-sm text-gray-400">
                                {{ $reservation->nights }} night(s)
                            </span>
                        </div>
                    </div>
                    <div class="text-center">
                        <p class="text-sm text-gray-400">Check-out</p>
                        <p class="text-lg font-semibold text-white">{{ $reservation->check_out->format('D, M d, Y') }}</p>
                        <p class="text-sm text-gray-400">11:00 AM</p>
                    </div>
                </div>
            </div>

            <!-- Room Info -->
            @if($reservation->room)
            <div class="bg-gray-700 p-6 rounded-lg">
                <h3 class="text-xl font-bold mb-4 text-white">Room Details</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-400">Type</p>
                        <p class="text-white">{{ $reservation->room->type }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400">Price per night</p>
                        <p class="text-orange-400">{{ number_format($reservation->room->price_per_night, 2) }} MAD</p>
                    </div>
                </div>
            </div>
            @endif

            <!-- Price Breakdown -->
            <div class="bg-gray-700 p-6 rounded-lg">
                <h3 class="text-xl font-bold mb-4 text-white">Price Breakdown</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-400">Room rate × {{ $reservation->nights }} nights</span>
                        <span class="text-white">{{ number_format($reservation->room->price_per_night * $reservation->nights, 2) }} MAD</span>
                    </div>
                    <div class="border-t border-gray-600 pt-2 flex justify-between font-bold">
                        <span class="text-white">Total</span>
                        <span class="text-orange-400">{{ number_format($reservation->total_price, 2) }} MAD</span>
                    </div>
                </div>
            </div>

            <!-- Special Requests -->
            @if($reservation->special_requests)
            <div class="bg-gray-700 p-6 rounded-lg">
                <h3 class="text-xl font-bold mb-2 text-white">Special Requests</h3>
                <p class="text-gray-300 whitespace-pre-line">{{ $reservation->special_requests }}</p>
            </div>
            @endif

            <!-- Payment Info -->
            <div class="bg-gray-700 p-6 rounded-lg">
                <h3 class="text-xl font-bold mb-4 text-white">Payment Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-400">Payment Method</p>
                        <p class="text-white capitalize">{{ $reservation->payment_method }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400">Payment Status</p>
                        <p class="text-white capitalize">{{ $reservation->payment_status ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

            <!-- Footer Actions -->
            <div class="flex flex-col md:flex-row justify-between items-center pt-6 border-t border-gray-700 space-y-4 md:space-y-0">
                <a href="{{ route('reservations.index') }}"
                   class="text-gray-400 hover:text-white transition flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Back to My Reservations
                </a>

                @if($reservation->status === 'pending' || $reservation->status === 'confirmed')
                <form action="{{ route('reservations.destroy', $reservation) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-medium transition flex items-center"
                            onclick="return confirm('Are you sure you want to cancel this reservation?')">
                        <i class="fas fa-times-circle mr-2"></i> Cancel Reservation
                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection