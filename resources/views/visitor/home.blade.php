@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="container mx-auto px-4 py-8 animate-fade-in">
    <h1 class="text-3xl font-bold text-white mb-6">Welcome to YouCamp, {{ Auth::user()->name }}!</h1>

    <!-- Featured Auberges -->
    <div class="mb-12">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-white">Featured Auberges</h2>
            <a href="{{ route('auberges.index') }}" class="text-orange-400 hover:text-orange-300 transition flex items-center">
                View all <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
        
        @if($featuredAuberges->isEmpty())
        <div class="bg-gray-800/50 border border-gray-700 rounded-lg p-8 text-center">
            <i class="fas fa-campground text-4xl text-gray-600 mb-4"></i>
            <p class="text-gray-400">No featured auberges available at the moment.</p>
        </div>
        @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($featuredAuberges as $auberge)
            <div class="bg-gray-800 rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                @if($auberge->featuredPhoto)
                <img src="{{ asset('storage/' . $auberge->featuredPhoto->path) }}" 
                     alt="{{ $auberge->name }}" 
                     class="w-full h-48 object-cover">
                @else
                <div class="w-full h-48 bg-gray-700 flex items-center justify-center text-gray-500">
                    <i class="fas fa-campground text-4xl"></i>
                </div>
                @endif
                
                <div class="p-6">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-xl font-bold text-white">{{ $auberge->name }}</h3>
                        <span class="bg-orange-500 text-white px-2 py-1 rounded-full text-xs">
                            {{ $auberge->city->ville }}
                        </span>
                    </div>
                    
                    <p class="text-gray-400 mb-4 line-clamp-2">{{ $auberge->description }}</p>
                    
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="text-orange-400 font-bold">{{ number_format($auberge->price_per_night, 2) }} MAD</span>
                            <span class="text-gray-500 text-sm">/ night</span>
                        </div>
                        
                        <a href="{{ route('reservations.create', ['auberge_id' => $auberge->id]) }}" 
                           class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 transition flex items-center">
                            <i class="fas fa-calendar-check mr-2"></i> Book Now
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>

    <!-- All Available Auberges -->
    <div class="mb-12">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-white">Available Auberges</h2>
            <a href="{{ route('auberges.index') }}" class="text-orange-400 hover:text-orange-300 transition flex items-center">
                View all <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
        
        @if($availableAuberges->isEmpty())
        <div class="bg-gray-800/50 border border-gray-700 rounded-lg p-8 text-center">
            <i class="fas fa-campground text-4xl text-gray-600 mb-4"></i>
            <p class="text-gray-400">No auberges available at the moment.</p>
        </div>
        @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($availableAuberges as $auberge)
            <div class="bg-gray-800 rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                @if($auberge->featuredPhoto)
                <img src="{{ asset('storage/' . $auberge->featuredPhoto->path) }}" 
                     alt="{{ $auberge->name }}" 
                     class="w-full h-48 object-cover">
                @else
                <div class="w-full h-48 bg-gray-700 flex items-center justify-center text-gray-500">
                    <i class="fas fa-campground text-4xl"></i>
                </div>
                @endif
                
                <div class="p-6">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-xl font-bold text-white">{{ $auberge->name }}</h3>
                        <span class="bg-orange-500 text-white px-2 py-1 rounded-full text-xs">
                            {{ $auberge->city->ville }}
                        </span>
                    </div>
                    
                    <div class="flex items-center text-sm text-gray-400 mb-2">
                        <i class="fas fa-users mr-2"></i> Capacity: {{ $auberge->capacity }}
                        <span class="mx-2">•</span>
                        @if($auberge->is_featured)
                        <span class="text-yellow-400 flex items-center">
                            <i class="fas fa-star mr-1"></i> Featured
                        </span>
                        @endif
                    </div>
                    
                    <p class="text-gray-400 mb-4 line-clamp-2">{{ $auberge->description }}</p>
                    
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="text-orange-400 font-bold">{{ number_format($auberge->price_per_night, 2) }} MAD</span>
                            <span class="text-gray-500 text-sm">/ night</span>
                        </div>
                        
                        <div class="flex space-x-2">
                            <a href="{{ route('auberges.show', $auberge->id) }}" 
                               class="px-3 py-2 border border-gray-600 rounded-lg hover:bg-gray-700 transition">
                                <i class="fas fa-info-circle"></i>
                            </a>
                            <a href="{{ route('reservations.create', ['auberge_id' => $auberge->id]) }}" 
                               class="bg-orange-500 text-white px-3 py-2 rounded-lg hover:bg-orange-600 transition">
                                <i class="fas fa-bookmark"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>

    
</div>
@endsection