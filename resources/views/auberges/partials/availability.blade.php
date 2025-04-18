<div class="mt-6">
    <h4 class="font-bold mb-2">Check Availability</h4>
    <div class="grid grid-cols-2 gap-4 mb-4">
        <div>
            <label class="block text-sm text-gray-600">Check-in</label>
            <input type="date" id="check_in" 
                   class="w-full px-3 py-2 border rounded-lg" 
                   min="{{ date('Y-m-d') }}">
        </div>
        <div>
            <label class="block text-sm text-gray-600">Check-out</label>
            <input type="date" id="check_out" 
                   class="w-full px-3 py-2 border rounded-lg" 
                   min="{{ date('Y-m-d', strtotime('+1 day')) }}">
        </div>
    </div>
    <button onclick="checkAvailability({{ $auberge->id }})" 
            class="bg-[#FF6F00] text-white px-4 py-2 rounded-lg hover:bg-[#ff8c00] transition">
        Check Dates
    </button>
    <div id="availability-result" class="mt-2 text-sm"></div>
</div>

@push('scripts')
<script>
function checkAvailability(aubergeId) {
    const checkIn = document.getElementById('check_in').value;
    const checkOut = document.getElementById('check_out').value;
    
    if (!checkIn || !checkOut) {
        document.getElementById('availability-result').innerHTML = 
            '<p class="text-red-500">Please select both dates</p>';
        return;
    }

    fetch(`/auberges/${aubergeId}/availability?check_in=${checkIn}&check_out=${checkOut}`)
        .then(response => response.json())
        .then(data => {
            const resultDiv = document.getElementById('availability-result');
            if (data.available) {
                resultDiv.innerHTML = `
                    <p class="text-green-500">Available!</p>
                    <p>${data.message}</p>
                    <a href="{{ route('reservations.create') }}?auberge_id=${aubergeId}&check_in=${checkIn}&check_out=${checkOut}" 
                       class="text-[#FF6F00] hover:underline">
                        Book Now
                    </a>
                `;
            } else {
                resultDiv.innerHTML = `
                    <p class="text-red-500">Not Available</p>
                    <p>${data.message}</p>
                `;
            }
        });
}
</script>
@endpush