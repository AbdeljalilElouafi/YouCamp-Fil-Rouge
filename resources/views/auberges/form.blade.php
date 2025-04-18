@extends('layouts.manager')

@section('content')
<div class="bg-gray-800 rounded-xl shadow-2xl overflow-hidden animate-fade-in">
    <div class="bg-gradient-to-r from-gray-700 to-gray-800 p-6">
        <h2 class="text-2xl font-bold text-white">{{ isset($auberge) ? 'Edit Auberge' : 'Create New Auberge' }}</h2>
    </div>
    
    <div class="p-6">
        <form action="{{ isset($auberge) ? route('auberges.update', $auberge->id) : route('auberges.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @if(isset($auberge))
                @method('PUT')
            @endif
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Left Column -->
                <div class="space-y-6">
                    <div>
                        <label for="name" class="block text-gray-300 mb-2">Auberge Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $auberge->name ?? '') }}" 
                               class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-white" required>
                    </div>
                    
                    <div>
                        <label for="description" class="block text-gray-300 mb-2">Description</label>
                        <textarea id="description" name="description" rows="3"
                                  class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-white" required>{{ old('description', $auberge->description ?? '') }}</textarea>
                    </div>
                    
                    <div>
                        <label for="address" class="block text-gray-300 mb-2">Address</label>
                        <input type="text" id="address" name="address" value="{{ old('address', $auberge->address ?? '') }}"
                               class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-white" required>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="latitude" class="block text-gray-300 mb-2">Latitude</label>
                            <input type="number" step="0.000001" id="latitude" name="latitude" value="{{ old('latitude', $auberge->latitude ?? '') }}"
                                   class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-white">
                        </div>
                        <div>
                            <label for="longitude" class="block text-gray-300 mb-2">Longitude</label>
                            <input type="number" step="0.000001" id="longitude" name="longitude" value="{{ old('longitude', $auberge->longitude ?? '') }}"
                                   class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-white">
                        </div>
                    </div>
                    <div>
                            <label for="region_id" class="block text-gray-300 mb-2">Region</label>
                            <select id="region_id" name="region_id" required
                                    class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-white">
                                <option value="">Select Region</option>
                                @foreach($regions as $region)
                                    <option value="{{ $region->id }}" {{ old('region_id', $auberge->region_id ?? '') == $region->id ? 'selected' : '' }}>
                                        {{ $region->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div>
                            <label for="city_id" class="block text-gray-300 mb-2">City</label>
                            <select id="city_id" name="city_id" required
                                    class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-white">
                                <option value="">Select City</option>
                                @if(isset($auberge) || old('region_id'))
                                    @foreach($cities as $city)
                                        <option value="{{ $city->id }}" {{ old('city_id', $auberge->city_id ?? '') == $city->id ? 'selected' : '' }}>
                                            {{ $city->ville }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>  
                </div>

                
                <!-- Right Column -->
                <div class="space-y-6">
                    <div>
                        <label for="phone" class="block text-gray-300 mb-2">Phone</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone', $auberge->phone ?? '') }}"
                               class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-white" required>
                    </div>
                    
                    <div>
                        <label for="email" class="block text-gray-300 mb-2">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $auberge->email ?? '') }}"
                               class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-white" required>
                    </div>
                    
                    <div>
                        <label for="website" class="block text-gray-300 mb-2">Website</label>
                        <input type="url" id="website" name="website" value="{{ old('website', $auberge->website ?? '') }}"
                               class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-white">
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="capacity" class="block text-gray-300 mb-2">Capacity</label>
                            <input type="number" id="capacity" name="capacity" min="1" value="{{ old('capacity', $auberge->capacity ?? '') }}"
                                   class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-white" required>
                        </div>
                        <div>
                            <label for="price_per_night" class="block text-gray-300 mb-2">Price per Night (MAD)</label>
                            <input type="number" step="0.01" id="price_per_night" name="price_per_night" min="0" value="{{ old('price_per_night', $auberge->price_per_night ?? '') }}"
                                   class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-white" required>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center">
                            <input type="checkbox" id="is_featured" name="is_featured" value="1" 
                                   class="w-4 h-4 text-orange-500 bg-gray-700 border-gray-600 rounded focus:ring-orange-500"
                                   {{ old('is_featured', isset($auberge) && $auberge->is_featured) ? 'checked' : '' }}>
                            <label for="is_featured" class="ml-2 text-gray-300">Featured Auberge</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" id="is_active" name="is_active" value="1" 
                                   class="w-4 h-4 text-orange-500 bg-gray-700 border-gray-600 rounded focus:ring-orange-500"
                                   {{ old('is_active', isset($auberge) ? $auberge->is_active : true) ? 'checked' : '' }}>
                            <label for="is_active" class="ml-2 text-gray-300">Active</label>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Services and Tags -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-gray-300 mb-2">Services</label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                        @foreach($services as $service)
                        <div class="flex items-center">
                            <input type="checkbox" name="services[]" value="{{ $service->id }}" id="service_{{ $service->id }}"
                                   class="w-4 h-4 text-orange-500 bg-gray-700 border-gray-600 rounded focus:ring-orange-500"
                                   {{ (isset($auberge) && $auberge->services->contains($service->id)) || in_array($service->id, old('services', [])) ? 'checked' : '' }}>
                            <label for="service_{{ $service->id }}" class="ml-2 text-gray-300">{{ $service->name }}</label>
                        </div>
                        @endforeach
                    </div>
                </div>
                
                <div>
                    <label class="block text-gray-300 mb-2">Tags</label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                        @foreach($tags as $tag)
                        <div class="flex items-center">
                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}" id="tag_{{ $tag->id }}"
                                   class="w-4 h-4 text-orange-500 bg-gray-700 border-gray-600 rounded focus:ring-orange-500"
                                   {{ (isset($auberge) && $auberge->tags->contains($tag->id)) || in_array($tag->id, old('tags', [])) ? 'checked' : '' }}>
                            <label for="tag_{{ $tag->id }}" class="ml-2 text-gray-300">{{ $tag->name }}</label>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            
            <!-- Photos -->
            <div>
                <label for="photos" class="block text-gray-300 mb-2">Photos</label>
                <input type="file" id="photos" name="photos[]" multiple
                       class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-white">
                
                @if(isset($auberge) && $auberge->photos->count())
                <div class="mt-4">
                    <h4 class="text-gray-300 mb-2">Current Photos</h4>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                        @foreach($auberge->photos as $photo)
                        <div class="relative group">
                            <img src="{{ asset('storage/' . $photo->path) }}" class="w-full h-32 object-cover rounded-lg">
                            <div class="absolute top-2 left-2">
                                <input type="radio" name="featured_photo" value="{{ $photo->id }}"
                                       class="w-4 h-4 text-orange-500 bg-gray-700 border-gray-600 rounded focus:ring-orange-500"
                                       {{ $photo->is_featured ? 'checked' : '' }}>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
            
            <!-- Submit Buttons -->
            <div class="flex justify-end space-x-4 pt-4">
                <a href="{{ isset($auberge) ? route('auberges.show', $auberge->id) : route('auberges.index') }}" 
                   class="px-6 py-2 border border-gray-600 rounded-lg hover:bg-gray-700 transition duration-300">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-2 bg-orange-500 rounded-lg hover:bg-orange-600 transition duration-300">
                    {{ isset($auberge) ? 'Update' : 'Create' }}
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#region_id').change(function() {
            const regionId = $(this).val();
            if (regionId) {
                $.get(`/regions/${regionId}/villes`, function(data) {
                    $('#city_id').empty();
                    $('#city_id').append('<option value="">Select City</option>');
                    $.each(data, function(key, city) {
                        $('#city_id').append(`<option value="${city.id}">${city.ville}</option>`);
                    });
                });
            } else {
                $('#city_id').empty();
                $('#city_id').append('<option value="">Select City</option>');
            }
        });
    });
</script>
@endpush
@endsection