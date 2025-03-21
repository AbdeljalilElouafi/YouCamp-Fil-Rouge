<!-- resources/views/manager/dashboard.blade.php -->
@extends('layouts.app')

@section('title', 'Manager Dashboard')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-white mb-6">Manager Dashboard</h1>

       

        <!-- Welcome Message -->
        <div class="bg-gray-800 p-6 rounded-lg shadow-lg mb-6">
            <h2 class="text-2xl font-semibold text-white">Welcome, {{ Auth::user()->name }}!</h2>
            <p class="text-gray-400 mt-2">You are managing <span class="font-bold text-orange-500">Auberge du Mont</span>.</p>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
                <h3 class="text-lg font-semibold text-white">Total Bookings</h3>
                <p class="text-3xl font-bold text-orange-500">120</p>
            </div>
            <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
                <h3 class="text-lg font-semibold text-white">Pending Requests</h3>
                <p class="text-3xl font-bold text-orange-500">5</p>
            </div>
            <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
                <h3 class="text-lg font-semibold text-white">Revenue</h3>
                <p class="text-3xl font-bold text-orange-500">$12,000</p>
            </div>
        </div>

        <!-- Recent Bookings -->
        <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold text-white mb-4">Recent Bookings</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-gray-700 rounded-lg">
                    <thead>
                        <tr class="text-white">
                            <th class="px-4 py-3">Booking ID</th>
                            <th class="px-4 py-3">Customer</th>
                            <th class="px-4 py-3">Check-In</th>
                            <th class="px-4 py-3">Check-Out</th>
                            <th class="px-4 py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Static Data for Now -->
                        <tr class="text-gray-300">
                            <td class="px-4 py-3">#12345</td>
                            <td class="px-4 py-3">John Doe</td>
                            <td class="px-4 py-3">2023-10-15</td>
                            <td class="px-4 py-3">2023-10-20</td>
                            <td class="px-4 py-3">
                                <span class="bg-green-500 text-white px-2 py-1 rounded-full text-sm">Confirmed</span>
                            </td>
                        </tr>
                        <tr class="text-gray-300">
                            <td class="px-4 py-3">#12346</td>
                            <td class="px-4 py-3">Jane Smith</td>
                            <td class="px-4 py-3">2023-10-18</td>
                            <td class="px-4 py-3">2023-10-22</td>
                            <td class="px-4 py-3">
                                <span class="bg-yellow-500 text-white px-2 py-1 rounded-full text-sm">Pending</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection