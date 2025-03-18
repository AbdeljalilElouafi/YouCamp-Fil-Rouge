<!-- resources/views/user/home.blade.php -->
@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-white mb-6">Welcome to YouCamp, {{ Auth::user()->name }}!</h1>

        <!-- Featured Auberges -->
        <div class="mb-8">
            <h2 class="text-2xl font-semibold text-white mb-4">Featured Auberges</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Static Data for Now -->
                <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
                    <img src="https://via.placeholder.com/400x200" alt="Auberge Image" class="w-full h-48 object-cover rounded-lg mb-4">
                    <h3 class="text-xl font-semibold text-white">Auberge du Mont</h3>
                    <p class="text-gray-400 mt-2">Located in the heart of the mountains, this auberge offers breathtaking views and cozy accommodations.</p>
                    <a href="#" class="mt-4 inline-block bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600">Book Now</a>
                </div>
                <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
                    <img src="https://via.placeholder.com/400x200" alt="Auberge Image" class="w-full h-48 object-cover rounded-lg mb-4">
                    <h3 class="text-xl font-semibold text-white">Auberge du Lac</h3>
                    <p class="text-gray-400 mt-2">A serene lakeside retreat perfect for relaxation and outdoor activities.</p>
                    <a href="#" class="mt-4 inline-block bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600">Book Now</a>
                </div>
                <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
                    <img src="https://via.placeholder.com/400x200" alt="Auberge Image" class="w-full h-48 object-cover rounded-lg mb-4">
                    <h3 class="text-xl font-semibold text-white">Auberge du Soleil</h3>
                    <p class="text-gray-400 mt-2">Experience the warmth of the sun and the beauty of nature at this charming auberge.</p>
                    <a href="#" class="mt-4 inline-block bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600">Book Now</a>
                </div>
            </div>
        </div>

        <!-- Latest Posts -->
        <div class="mb-8">
            <h2 class="text-2xl font-semibold text-white mb-4">Latest Posts</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Static Data for Now -->
                <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold text-white">Top 10 Camping Tips</h3>
                    <p class="text-gray-400 mt-2">Discover the best tips and tricks for a successful camping trip.</p>
                    <a href="#" class="mt-4 inline-block bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600">Read More</a>
                </div>
                <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold text-white">Best Hiking Trails</h3>
                    <p class="text-gray-400 mt-2">Explore the most scenic hiking trails near our auberges.</p>
                    <a href="#" class="mt-4 inline-block bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600">Read More</a>
                </div>
            </div>
        </div>
    </div>
@endsection