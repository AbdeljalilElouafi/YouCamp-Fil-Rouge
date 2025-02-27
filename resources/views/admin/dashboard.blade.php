@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Card 1: Total Users -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold mb-4">Total Users</h2>
            <p class="text-3xl font-bold">1,234</p>
        </div>

        <!-- Card 2: Total Gérants -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold mb-4">Total Gérants</h2>
            <p class="text-3xl font-bold">56</p>
        </div>

        <!-- Card 3: Total Reservations -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold mb-4">Total Reservations</h2>
            <p class="text-3xl font-bold">789</p>
        </div>
    </div>

    <!-- Chart Placeholder -->
    <div class="mt-8 bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-xl font-semibold mb-4">Reservations Overview</h2>
        <div id="chart" class="h-64"></div>
    </div>
@endsection