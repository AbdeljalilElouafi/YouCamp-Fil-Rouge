@extends('layouts.manager')

@section('content')
<div class="animate-fade-in">
    <div class="bg-gray-800 rounded-xl shadow-2xl overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-gray-700 to-gray-800 p-6 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-white">{{ $auberge->name }}</h1>
            <div class="flex space-x-3">
                @auth
                    @if(Auth::id() == $auberge->manager_id)
                    <a href="{{ route('auberges.edit', $auberge->id) }}" class="px-4 py-2 bg-gray-700 rounded-lg hover:bg-gray-600 transition duration-300">
                        <i class="fas fa-edit mr-2"></i> Edit
                    </a>
                    @endif
                @endauth
                <a href="{{ route('auberges.index') }}" class="px-4 py-2 bg-orange-500 rounded-lg hover:bg-orange-600 transition duration-300">
                    <i class="fas fa-arrow-left mr-2"></i> Back
                </a>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 p-6">
            <!-- Left Column (2/3 width) -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Image Gallery -->
                @if($auberge->photos->count())
                <div class="relative">
                    <div class="grid grid-cols-2 gap-4">
                        @foreach($auberge->photos as $photo)
                        <div class="overflow-hidden rounded-lg">
                            <img src="{{ asset('storage/' . $photo->path) }}" 
                                 class="w-full h-64 object-cover hover:scale-105 transition duration-500 cursor-pointer"
                                 alt="Auberge photo">
                        </div>
                        @endforeach
                    </div>
                </div>
                @else
                <div class="bg-gray-700 h-64 rounded-lg flex items-center justify-center text-gray-400">
                    <i class="fas fa-image fa-5x"></i>
                </div>
                @endif
                
                <!-- Description -->
                <div class="bg-gray-700 p-6 rounded-lg">
                    <h2 class="text-xl font-semibold text-orange-400 mb-3">Description</h2>
                    <p class="text-gray-300">{{ $auberge->description }}</p>
                </div>
                
                    <!-- Location Section -->
                    <div class="bg-gray-700 p-6 rounded-lg">
                        <h2 class="text-xl font-semibold text-orange-400 mb-3">Location</h2>
                        <p class="text-gray-300 mb-4">
                            <i class="fas fa-map-marker-alt text-orange-400 mr-2"></i>
                            {{ $auberge->address }}, {{ $auberge->city->ville }}
                        </p>
                        
                        @if($auberge->latitude && $auberge->longitude)
                        <div id="map-container" class="relative w-full h-64 rounded-lg bg-gray-600 overflow-hidden">
                            <div id="map" class="absolute top-0 left-0 w-full h-full"></div>
                        </div>
                        @endif
                    </div>
            </div>
            
            <!-- Right Column (1/3 width) -->
            <div class="space-y-6">
                <!-- Details Card -->
                <div class="bg-gray-700 p-6 rounded-lg">
                    <h2 class="text-xl font-semibold text-orange-400 mb-4">Details</h2>
                    
                    <div class="space-y-4">
                        <div class="flex justify-between">
                            <span class="text-gray-400">Manager:</span>
                            <span class="text-white">{{ $auberge->manager->name }}</span>
                        </div>
                        
                        <div class="flex justify-between">
                            <span class="text-gray-400">Status:</span>
                            <span class="{{ $auberge->is_active ? 'text-green-400' : 'text-red-400' }}">
                                {{ $auberge->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                        
                        <div class="flex justify-between">
                            <span class="text-gray-400">Featured:</span>
                            <span class="{{ $auberge->is_featured ? 'text-yellow-400' : 'text-gray-400' }}">
                                {{ $auberge->is_featured ? 'Yes' : 'No' }}
                            </span>
                        </div>
                        
                        <div class="flex justify-between">
                            <span class="text-gray-400">Capacity:</span>
                            <span class="text-white">{{ $auberge->capacity }}</span>
                        </div>
                        
                        <div class="flex justify-between">
                            <span class="text-gray-400">Price per Night:</span>
                            <span class="text-orange-400 font-bold">{{ number_format($auberge->price_per_night, 2) }} MAD</span>
                        </div>
                    </div>
                </div>
                
                <!-- Contact Card -->
                <div class="bg-gray-700 p-6 rounded-lg">
                    <h2 class="text-xl font-semibold text-orange-400 mb-4">Contact</h2>
                    
                    <div class="space-y-3">
                        <div class="flex items-center">
                            <i class="fas fa-phone text-orange-400 mr-3"></i>
                            <span class="text-gray-300">{{ $auberge->phone }}</span>
                        </div>
                        
                        <div class="flex items-center">
                            <i class="fas fa-envelope text-orange-400 mr-3"></i>
                            <span class="text-gray-300">{{ $auberge->email }}</span>
                        </div>
                        
                        @if($auberge->website)
                        <div class="flex items-center">
                            <i class="fas fa-globe text-orange-400 mr-3"></i>
                            <a href="{{ $auberge->website }}" target="_blank" class="text-gray-300 hover:text-orange-400 transition duration-300">
                                {{ $auberge->website }}
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
                
                <!-- Services & Tags -->
                <div class="bg-gray-700 p-6 rounded-lg">
                    <h2 class="text-xl font-semibold text-orange-400 mb-4">Amenities</h2>
                    
                    <div class="space-y-4">
                        <div>
                            <h3 class="text-gray-400 mb-2">Services</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach($auberge->services as $service)
                                <span class="px-3 py-1 bg-gray-600 rounded-full text-sm text-white">{{ $service->name }}</span>
                                @endforeach
                            </div>
                        </div>
                        
                        <div>
                            <h3 class="text-gray-400 mb-2">Tags</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach($auberge->tags as $tag)
                                <span class="px-3 py-1 bg-orange-500 rounded-full text-sm text-white">{{ $tag->name }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Rooms Section -->
        <div class="p-6">
            <h2 class="text-2xl font-bold text-orange-400 mb-6">Rooms</h2>
            
            @if($auberge->rooms->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($auberge->rooms as $room)
                <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-white mb-2">{{ $room->type }}</h3>
                        <p class="text-gray-400 mb-4">{{ $room->description }}</p>
                        
                        <div class="space-y-3 mb-4">
                            <div class="flex justify-between">
                                <span class="text-gray-400">Max Occupancy:</span>
                                <span class="text-white">{{ $room->max_occupancy }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Price per Night:</span>
                                <span class="text-orange-400">{{ number_format($room->price_per_night, 2) }} MAD</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Available:</span>
                                <span class="text-white">{{ $room->quantity }}</span>
                            </div>
                        </div>
                        
                        @if($room->amenities)
                        <div>
                            <h4 class="text-gray-400 mb-2">Amenities:</h4>
                            <div class="flex flex-wrap gap-2">
                                @foreach($room->amenities as $amenity)
                                <span class="px-2 py-1 bg-gray-700 rounded text-xs text-gray-300">{{ $amenity }}</span>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="bg-gray-800 p-6 rounded-lg text-center">
                <i class="fas fa-door-open text-4xl text-gray-600 mb-3"></i>
                <p class="text-gray-400">No rooms available for this auberge.</p>
            </div>
            @endif
        </div>
    </div>
</div>

@if($auberge->latitude && $auberge->longitude)
@push('scripts')
<script>
    // Initialize map when the window loads
    function initMap() {
        try {
            const location = { 
                lat: {{ $auberge->latitude }}, 
                lng: {{ $auberge->longitude }} 
            };
            
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 15,
                center: location,
                styles: [
                    // Your dark theme map styles here
                    // ...
                ]
            });
            
            new google.maps.Marker({
                position: location,
                map: map,
                title: "{{ $auberge->name }}",
                icon: {
                    url: "https://maps.google.com/mapfiles/ms/icons/red-dot.png"
                }
            });
        } catch (error) {
            console.error("Google Maps initialization error:", error);
            document.getElementById("map-container").innerHTML = 
                '<div class="flex items-center justify-center h-full text-red-400">' +
                '   <i class="fas fa-exclamation-triangle mr-2"></i>' +
                '   Map could not be loaded' +
                '</div>';
        }
    }

    // Load Google Maps API
    function loadGoogleMaps() {
        const script = document.createElement('script');
        script.src = `https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap`;
        script.async = true;
        script.defer = true;
        script.onerror = function() {
            document.getElementById("map-container").innerHTML = 
                '<div class="flex items-center justify-center h-full text-red-400">' +
                '   <i class="fas fa-exclamation-triangle mr-2"></i>' +
                '   Failed to load Google Maps API' +
                '</div>';
        };
        document.head.appendChild(script);
    }

    // Load the script when the page is ready
    if (document.getElementById("map")) {
        document.addEventListener('DOMContentLoaded', loadGoogleMaps);
    }
</script>
@endpush
@endif
@endsection