@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="container mx-auto">
                    <!-- Dashboard Overview -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                        @include('components.card', [
                            'title' => 'Total Campsites',
                            'value' => '347',
                            'color' => 'indigo',
                            'icon' => 'campground',
                            'percentage' => '12%'
                        ])
                        <!-- Add other cards here -->
                        @include('components.card', [
                            'title' => 'Total users',
                            'value' => '1809',
                            'color' => 'indigo',
                            'icon' => 'users',
                            'percentage' => '46%'
                        ])
                    </div>

                    <!-- Charts Section -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                        @include('components.chart', [
                            'title' => 'Reservation Trends',
                            'id' => 'reservationChart'
                        ])
                        @include('components.chart', [
                            'title' => 'User Demographics',
                            'id' => 'demographicsChart'
                        ])
                    </div>

                    <!-- Recent Activity -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <!-- Recent Bookings Table -->
                        <div class="card p-6 lg:col-span-2">
                            <!-- Table content here -->
                        </div>

                        <!-- Top Campsites -->
                        <div class="card p-6">
                            <!-- Top Campsites content here -->
                        </div>
                    </div>
                </div>
@endsection