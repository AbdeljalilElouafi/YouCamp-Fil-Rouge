@extends('layouts.app')

@section('title', 'Manager Dashboard')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-white mb-6">Manager Dashboard</h1>

    <!-- Welcome Message with Real Data -->
    <div class="bg-gray-800 p-6 rounded-lg shadow-lg mb-6">
        <h2 class="text-2xl font-semibold text-white">Welcome, {{ Auth::user()->name }}!</h2>
        @if($myAuberges->count() > 0)
            <p class="text-gray-400 mt-2">You are managing {{ $myAuberges->count() }} auberge(s).</p>
        @else
            <p class="text-gray-400 mt-2">You don't have any auberges yet. <a href="{{ route('auberges.create') }}" class="text-orange-500 hover:underline">Create one now</a>.</p>
        @endif
    </div>

    <!-- Quick Stats with Real Data -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-gray-800 p-6 rounded-lg shadow-lg hover:bg-gray-700 transition">
            <a href="{{ route('auberges.my') }}" class="block">
                <h3 class="text-lg font-semibold text-white">My Auberges</h3>
                <p class="text-3xl font-bold text-orange-500">{{ $myAuberges->count() }}</p>
            </a>
        </div>
        
        <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
            <h3 class="text-lg font-semibold text-white">Active Reservations</h3>
            <p class="text-3xl font-bold text-orange-500">{{ $activeReservations }}</p>
        </div>
        
        <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
            <h3 class="text-lg font-semibold text-white">This Month's Revenue</h3>
            <p class="text-3xl font-bold text-orange-500">${{ number_format($monthlyRevenue, 2) }}</p>
        </div>
    </div>

    <!-- Recent Reservations -->
    <div class="bg-gray-800 p-6 rounded-lg shadow-lg mb-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold text-white">Recent Reservations</h2>
            <a href="#" class="text-orange-500 hover:underline">View All</a>
        </div>
        
        @if($recentReservations->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full bg-gray-700 rounded-lg">
                <thead>
                    <tr class="text-white">
                        <th class="px-4 py-3 text-left">Auberge</th>
                        <th class="px-4 py-3 text-left">Guest</th>
                        <th class="px-4 py-3 text-left">Dates</th>
                        <th class="px-4 py-3 text-left">Amount</th>
                        <th class="px-4 py-3 text-left">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentReservations as $reservation)
                    <tr class="text-gray-300 hover:bg-gray-600">
                        <td class="px-4 py-3">{{ $reservation->auberge->name }}</td>
                        <td class="px-4 py-3">{{ $reservation->user->name }}</td>
                        <td class="px-4 py-3">
                            {{ $reservation->check_in->format('M d') }} - {{ $reservation->check_out->format('M d') }}
                        </td>
                        <td class="px-4 py-3">${{ number_format($reservation->total_price, 2) }}</td>
                        <td class="px-4 py-3">
                            <span class="{{ $reservation->status === 'confirmed' ? 'bg-green-500' : 'bg-yellow-500' }} text-white px-2 py-1 rounded-full text-xs">
                                {{ ucfirst($reservation->status) }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="bg-gray-700 p-4 rounded-lg text-gray-400">
            No recent reservations found.
        </div>
        @endif
    </div>

    <!-- Quick Actions -->
    <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold text-white mb-4">Quick Actions</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('auberges.create') }}" class="bg-orange-600 hover:bg-orange-700 text-white p-4 rounded-lg flex items-center transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Add New Auberge
            </a>
            <a href="{{ route('auberges.my') }}" class="bg-purple-600 hover:bg-purple-700 text-white p-4 rounded-lg flex items-center transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
                Manage Auberges
            </a>
            
        </div>
    </div>
</div>
@endsection