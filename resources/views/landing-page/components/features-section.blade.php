<!-- resources/views/landing-page/components/features-section.blade.php -->
<section class="py-20 bg-[#f7fafc]">
    <h2 class="text-4xl font-extrabold text-center mb-12 text-[#FF6F00]">Featured Auberges</h2>
    
    <div class="container mx-auto grid md:grid-cols-3 gap-8 px-4">
        @foreach($auberges as $auberge)
        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
            @if($auberge->featuredPhoto)
            <img src="{{ asset('storage/' . $auberge->featuredPhoto->path) }}" 
                 alt="{{ $auberge->name }}" 
                 class="w-full h-48 object-cover">
            @else
            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                <span class="text-gray-500">No Image</span>
            </div>
            @endif
            
            <div class="p-6">
                <h3 class="text-xl font-bold mb-2">{{ $auberge->name }}</h3>
                <p class="text-gray-600 mb-2">
                    <i class="fas fa-map-marker-alt text-[#FF6F00] mr-2"></i>
                    {{ $auberge->city }}
                </p>
                <p class="text-gray-700 mb-4 line-clamp-2">{{ $auberge->description }}</p>
                
                <div class="flex justify-between items-center">
                    <div>
                        <span class="font-bold text-[#FF6F00]">${{ number_format($auberge->price_per_night, 2) }}</span>
                        <span class="text-gray-500 text-sm">/ night</span>
                    </div>
                    
                    @auth
                        @if(auth()->user()->hasRole('visitor'))
                        <a href="{{ route('reservations.create', ['auberge_id' => $auberge->id]) }}" 
                           class="bg-[#FF6F00] text-white px-4 py-2 rounded-lg hover:bg-[#ff8c00] transition">
                           Book Now
                        </a>
                        @else
                        <a href="{{ route('auberges.show', $auberge) }}" 
                           class="text-[#FF6F00] hover:underline">
                           View Details
                        </a>
                        @endif
                    @else
                    <a href="{{ route('login') }}" 
                       class="bg-[#FF6F00] text-white px-4 py-2 rounded-lg hover:bg-[#ff8c00] transition">
                       Login to Book
                    </a>
                    @endauth
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <div class="text-center mt-8">
        <a href="{{ route('auberges.index') }}" 
           class="inline-block bg-[#FF6F00] text-white px-6 py-3 rounded-lg font-semibold hover:bg-[#ff8c00] transition">
           View All Auberges
        </a>
    </div>
</section>