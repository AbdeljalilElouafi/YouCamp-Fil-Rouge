@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8 animate-fade-in">
    <div class="max-w-3xl mx-auto bg-gray-800 rounded-xl shadow-2xl overflow-hidden">
        <div class="bg-gradient-to-r from-orange-800 to-orange-600 p-6 text-white">
            <h1 class="text-2xl font-bold">Book Your Stay</h1>
            <p class="mt-2 text-orange-100">{{ $auberge->name }} in {{ $auberge->city->ville }}</p>
        </div>

        <div class="p-6">
            @if($errors->any())
                <div class="bg-red-900/50 border border-red-600 text-red-100 px-4 py-3 rounded-lg mb-6">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('reservations.store') }}" method="POST">
                @csrf
                <input type="hidden" name="auberge_id" value="{{ $auberge->id }}">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Dates -->
                    <div>
                        <label class="block text-gray-300 mb-2">Check-in Date</label>
                        <input type="date" name="check_in" 
                               class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-orange-500 text-white"
                               min="{{ date('Y-m-d') }}" required
                               value="{{ old('check_in') }}">
                    </div>
                    <div>
                        <label class="block text-gray-300 mb-2">Check-out Date</label>
                        <input type="date" name="check_out" 
                               class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-orange-500 text-white"
                               min="{{ date('Y-m-d', strtotime('+1 day')) }}" required
                               value="{{ old('check_out') }}">
                    </div>

                    <!-- Room Selection -->
                    <div class="md:col-span-2">
                        <label class="block text-gray-300 mb-2">Room Type</label>
                        <select name="room_id" class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-orange-500 text-white">
                            <option value="">Select a Room</option>
                            @foreach($auberge->rooms as $room)
                                <option value="{{ $room->id }}" 
                                    data-price="{{ $room->price_per_night }}"
                                    {{ old('room_id') == $room->id ? 'selected' : '' }}>
                                    {{ $room->type }} - {{ number_format($room->price_per_night, 2) }} MAD per night
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Guests -->
                    <div>
                        <label class="block text-gray-300 mb-2">Number of Guests</label>
                        <input type="number" name="guests" min="1" max="10" 
                               class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-orange-500 text-white"
                               value="{{ old('guests', 1) }}" required>
                    </div>

                    <!-- Total Price (calculated) -->
                    <div>
                        <label class="block text-gray-300 mb-2">Total Price</label>
                        <div class="px-4 py-2 bg-gray-700 rounded-lg text-orange-400 font-bold">
                            <span id="total-price-display">0.00</span> MAD
                        </div>
                        <input type="hidden" name="total_price" id="total-price-input" value="{{ old('total_price', 0) }}">
                    </div>

                    <!-- Special Requests -->
                    <div class="md:col-span-2">
                        <label class="block text-gray-300 mb-2">Special Requests</label>
                        <textarea name="special_requests" rows="3"
                                  class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-orange-500 text-white">{{ old('special_requests') }}</textarea>
                    </div>

                    <!-- Payment Method -->
                    <div class="md:col-span-2 mt-6">
                        <h3 class="text-lg font-bold text-gray-300 mb-4">Payment Method</h3>
                        <div class="space-y-4">
                            <label class="flex items-center space-x-3 text-gray-300">
                                <input type="radio" name="payment_method" value="cash" 
                                    class="h-5 w-5 text-orange-500 focus:ring-orange-500 bg-gray-700 border-gray-600"
                                    {{ old('payment_method', 'cash') == 'cash' ? 'checked' : '' }}>
                                <span>Pay with Cash on arrival</span>
                            </label>
                            <label class="flex items-center space-x-3 text-gray-300">
                                <input type="radio" name="payment_method" value="stripe" 
                                    class="h-5 w-5 text-orange-500 focus:ring-orange-500 bg-gray-700 border-gray-600"
                                    {{ old('payment_method') == 'stripe' ? 'checked' : '' }}>
                                <span>Pay with Credit Card (Stripe)</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex justify-end">
                    <button type="submit" class="bg-orange-500 text-white px-8 py-3 rounded-lg font-semibold hover:bg-orange-600 transition duration-300 flex items-center">
                        <i class="fas fa-calendar-check mr-2"></i> Confirm Booking
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const roomSelect = document.querySelector('select[name="room_id"]');
        const checkInInput = document.querySelector('input[name="check_in"]');
        const checkOutInput = document.querySelector('input[name="check_out"]');
        const totalPriceDisplay = document.getElementById('total-price-display');
        const totalPriceInput = document.getElementById('total-price-input');
        const paymentMethodRadios = document.querySelectorAll('input[name="payment_method"]');

        function calculateTotal() {
            if (!roomSelect.value || !checkInInput.value || !checkOutInput.value) return;

            const pricePerNight = parseFloat(roomSelect.selectedOptions[0].dataset.price);
            const checkIn = new Date(checkInInput.value);
            const checkOut = new Date(checkOutInput.value);
            const nights = (checkOut - checkIn) / (1000 * 60 * 60 * 24);
            
            if (nights > 0) {
                const total = pricePerNight * nights;
                totalPriceDisplay.textContent = total.toFixed(2);
                totalPriceInput.value = total.toFixed(2);
            }
        }

        // Initialize calculation if there are old values
        if (roomSelect.value && checkInInput.value && checkOutInput.value) {
            calculateTotal();
        }

        roomSelect.addEventListener('change', calculateTotal);
        checkInInput.addEventListener('change', calculateTotal);
        checkOutInput.addEventListener('change', calculateTotal);
        
        // Validate room selection when payment method is stripe
        paymentMethodRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'stripe' && !roomSelect.value) {
                    alert('Please select a room for credit card payment');
                    this.checked = false;
                    paymentMethodRadios[0].checked = true;
                }
            });
        });
    });
</script>
@endpush
@endsection