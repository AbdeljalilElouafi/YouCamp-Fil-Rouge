@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8 animate-fade-in">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-orange-400">My Reservations</h1>
        <a href="{{ route('auberges.index') }}" class="text-orange-400 hover:text-orange-300 transition flex items-center">
            Browse Auberges <i class="fas fa-arrow-right ml-2"></i>
        </a>
    </div>

    @if($reservations->isEmpty())
        <div class="bg-gray-800/50 border border-gray-700 rounded-xl p-8 text-center">
            <i class="fas fa-calendar-times text-4xl text-gray-600 mb-4"></i>
            <p class="text-gray-400">You don't have any reservations yet.</p>
            <a href="{{ route('auberges.index') }}" class="mt-4 inline-block text-orange-400 hover:text-orange-300 transition">
                Explore available auberges
            </a>
        </div>
    @else
        <div class="space-y-6">
            @foreach($reservations as $reservation)
                <div class="bg-gray-800 rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <h2 class="text-xl font-bold text-white">{{ $reservation->auberge->name }}</h2>
                                <p class="text-gray-400">{{ $reservation->auberge->city->ville }}</p>
                            </div>
                            <span class="px-3 py-1 rounded-full text-sm font-medium
                                @if($reservation->status === 'confirmed') bg-green-900 text-green-300
                                @elseif($reservation->status === 'cancelled') bg-red-900 text-red-300
                                @else bg-yellow-900 text-yellow-300 @endif">
                                {{ ucfirst($reservation->status) }}
                            </span>
                        </div>

                        <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="bg-gray-700 p-4 rounded-lg">
                                <p class="text-gray-400 text-sm">Dates</p>
                                <p class="text-white font-medium">
                                    {{ $reservation->check_in->format('M d, Y') }} - {{ $reservation->check_out->format('M d, Y') }}
                                </p>
                                <p class="text-gray-400 text-sm mt-1">
                                    {{ $reservation->nights }} night(s)
                                </p>
                            </div>
                            
                            <div class="bg-gray-700 p-4 rounded-lg">
                                <p class="text-gray-400 text-sm">Guests</p>
                                <p class="text-white font-medium">{{ $reservation->guests }}</p>
                            </div>
                            
                            <div class="bg-gray-700 p-4 rounded-lg">
                                <p class="text-gray-400 text-sm">Total</p>
                                <p class="text-orange-400 font-bold">{{ number_format($reservation->total_price, 2) }} MAD</p>
                            </div>
                        </div>

                        <div class="mt-6 flex justify-between items-center">
                            <a href="{{ route('reservations.show', $reservation) }}" 
                               class="text-orange-400 hover:text-orange-300 transition flex items-center">
                                <i class="fas fa-eye mr-2"></i> View Details
                            </a>
                            
                            @if($reservation->status === 'pending' || $reservation->status === 'confirmed')
                                <form action="{{ route('reservations.destroy', $reservation) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-400 hover:text-red-300 transition flex items-center"
                                            onclick="return confirm('Are you sure you want to cancel this reservation?')">
                                        <i class="fas fa-times-circle mr-2"></i> Cancel
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection