
<div class="card p-6">
    <div class="flex justify-between items-start">
        <div>
            <h3 class="text-lg font-medium text-white opacity-90">{{ $title }}</h3>
            <p class="number-counter">{{ $value }}</p>
        </div>
        <div class="bg-{{ $color }}-600 rounded-lg p-3 text-white">
            <i class="fas fa-{{ $icon }} text-xl"></i>
        </div>
    </div>
    <div class="mt-4 text-white text-sm">
        <span class="text-green-400"><i class="fas fa-arrow-up mr-1"></i>{{ $percentage }}</span> from last month
    </div>
</div>