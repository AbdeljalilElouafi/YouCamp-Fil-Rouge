@extends('layouts.manager')

@section('content')
<div class="animate-fade-in">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-orange-400">All Auberges</h1>
        <a href="{{ route('auberges.create') }}" class="px-4 py-2 bg-orange-500 rounded-lg hover:bg-orange-600 transition duration-300">
            <i class="fas fa-plus mr-2"></i> Add Auberge
        </a>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($auberges as $auberge)
        <div class="bg-gray-800 rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
            @if($auberge->featuredPhoto)
            <img src="{{ asset('storage/' . $auberge->featuredPhoto->path) }}" class="w-full h-48 object-cover" alt="{{ $auberge->name }}">
            @else
            <div class="bg-gray-700 h-48 flex items-center justify-center text-gray-400">
                <i class="fas fa-image fa-3x"></i>
            </div>
            @endif
            
            <div class="p-6">
                <div class="flex justify-between items-start">
                    <h3 class="text-xl font-semibold text-white">{{ $auberge->name }}</h3>
                    <span class="bg-orange-500 text-white px-2 py-1 rounded-full text-xs">{{ $auberge->city->ville }}</span>
                </div>
                
                <p class="text-gray-400 mt-2">{{ Str::limit($auberge->description, 100) }}</p>
                
                <div class="flex justify-between items-center mt-4">
                    <div>
                        <span class="text-orange-400 font-bold">{{ number_format($auberge->price_per_night, 2) }} MAD</span>
                        <span class="text-gray-400 text-sm">/ night</span>
                    </div>
                    <span class="text-gray-300 text-sm">
                        <i class="fas fa-users mr-1"></i> {{ $auberge->capacity }}
                    </span>
                </div>
                
                <div class="mt-4 pt-4 border-t border-gray-700 flex justify-between">
                    <a href="{{ route('auberges.show', $auberge->id) }}" class="text-orange-400 hover:text-orange-300 transition duration-300">
                        View Details <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                    @auth
                        @if(Auth::id() == $auberge->manager_id)
                        <a href="{{ route('auberges.edit', $auberge->id) }}" class="text-gray-400 hover:text-white transition duration-300">
                            <i class="fas fa-edit"></i>
                        </a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
        @endforeach
    </div>
    

</div>
@endsection