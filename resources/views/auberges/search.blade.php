@extends('layouts.manager')

@section('content')
<div class="container mx-auto py-8">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Filters Sidebar -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-xl font-bold mb-4">Filter Auberges</h3>
            
            <form action="{{ route('auberges.search') }}" method="GET">
                <!-- Location Filter -->
                <div class="mb-6">
                    <label class="block text-gray-700 mb-2">Location</label>
                    <input type="text" name="city" placeholder="City" 
                           value="{{ request('city') }}"
                           class="w-full px-4 py-2 border rounded-lg">
                </div>

                <!-- Price Range -->
                <div class="mb-6">
                    <label class="block text-gray-700 mb-2">Price Range</label>
                    <div class="flex space-x-4">
                        <input type="number" name="price_min" placeholder="Min" 
                               value="{{ request('price_min') }}"
                               class="w-1/2 px-4 py-2 border rounded-lg">
                        <input type="number" name="price_max" placeholder="Max" 
                               value="{{ request('price_max') }}"
                               class="w-1/2 px-4 py-2 border rounded-lg">
                    </div>
                </div>

                <!-- Date Availability -->
                <div class="mb-6">
                    <label class="block text-gray-700 mb-2">Dates</label>
                    <div class="space-y-2">
                        <input type="date" name="check_in" 
                               value="{{ request('check_in') }}"
                               class="w-full px-4 py-2 border rounded-lg">
                        <input type="date" name="check_out"
                               value="{{ request('check_out') }}"
                               class="w-full px-4 py-2 border rounded-lg">
                    </div>
                </div>

                <!-- Services Filter -->
                <div class="mb-6">
                    <label class="block text-gray-700 mb-2">Amenities</label>
                    <div class="space-y-2">
                        @foreach($services as $service)
                        <label class="flex items-center">
                            <input type="checkbox" name="services[]" 
                                   value="{{ $service->id }}"
                                   {{ in_array($service->id, request('services', [])) ? 'checked' : '' }}
                                   class="mr-2">
                            <span>{{ $service->name }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <button type="submit" 
                        class="w-full bg-[#FF6F00] text-white py-2 rounded-lg hover:bg-[#ff8c00] transition">
                    Apply Filters
                </button>
            </form>
        </div>

        <!-- Results -->
        <div class="lg:col-span-3">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($auberges as $auberge)
                <!-- Auberge Card (similar to your home page) -->
                @include('auberges.partials.card', ['auberge' => $auberge])
                @endforeach
            </div>

            <div class="mt-6">
                {{ $auberges->links() }}
            </div>
        </div>
    </div>
</div>
@endsection