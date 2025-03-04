<!-- resources/views/components/chart.blade.php -->
<div class="card p-6">
    <h3 class="text-xl font-bold text-white mb-4">{{ $title }}</h3>
    <div class="chart-container">
        <canvas id="{{ $id }}"></canvas>
    </div>
</div>