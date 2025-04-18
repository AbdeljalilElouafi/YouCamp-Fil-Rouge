@extends('layouts.manager')

@section('content')
<div class="animate-fade-in">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-orange-400">My Auberges</h1>
        <a href="{{ route('auberges.create') }}" class="px-4 py-2 bg-orange-500 rounded-lg hover:bg-orange-600 transition duration-300 flex items-center">
            <i class="fas fa-plus mr-2"></i> Create New Auberge
        </a>
    </div>

    @if($auberges->isEmpty())
    <div class="bg-blue-900/30 border border-blue-700 rounded-lg p-4 text-blue-200">
        <i class="fas fa-info-circle mr-2"></i> You don't have any auberges yet. 
        <a href="{{ route('auberges.create') }}" class="text-orange-400 hover:text-orange-300 transition duration-300">Create one now</a>.
    </div>
    @else
    <div class="bg-gray-800 rounded-xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-700 text-gray-300">
                    <tr>
                        <th class="px-6 py-3 text-left">Name</th>
                        <th class="px-6 py-3 text-left">City</th>
                        <th class="px-6 py-3 text-center">Status</th>
                        <th class="px-6 py-3 text-center">Featured</th>
                        <th class="px-6 py-3 text-right">Price/Night</th>
                        <th class="px-6 py-3 text-center">Capacity</th>
                        <th class="px-6 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @foreach($auberges as $auberge)
                    <tr class="hover:bg-gray-700/50 transition duration-200">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                @if($auberge->featuredPhoto)
                                <div class="flex-shrink-0 h-10 w-10 mr-3">
                                    <img class="h-10 w-10 rounded-full object-cover" src="{{ asset('storage/' . $auberge->featuredPhoto->path) }}" alt="{{ $auberge->name }}">
                                </div>
                                @endif
                                <div class="font-medium text-white">{{ $auberge->name }}</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-400">
                            {{ $auberge->city->ville }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span class="px-2 py-1 text-xs rounded-full {{ $auberge->is_active ? 'bg-green-900 text-green-300' : 'bg-gray-600 text-gray-300' }}">
                                {{ $auberge->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span class="px-2 py-1 text-xs rounded-full {{ $auberge->is_featured ? 'bg-yellow-900 text-yellow-300' : 'bg-gray-600 text-gray-300' }}">
                                {{ $auberge->is_featured ? 'Featured' : 'Regular' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-orange-400 font-medium">
                            {{ number_format($auberge->price_per_night, 2) }} MAD
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-gray-400">
                            {{ $auberge->capacity }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right">
                            <div class="flex justify-end space-x-2">
                                <a href="{{ route('auberges.show', $auberge->id) }}" 
                                   class="p-2 text-gray-400 hover:text-orange-400 transition duration-300"
                                   title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('auberges.edit', $auberge->id) }}" 
                                   class="p-2 text-gray-400 hover:text-blue-400 transition duration-300"
                                   title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('auberges.destroy', $auberge->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="p-2 text-gray-400 hover:text-red-400 transition duration-300"
                                            title="Delete"
                                            onclick="return confirm('Are you sure you want to delete this auberge?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>

@push('scripts')
<script>
    // Confirm before deleting
    document.addEventListener('DOMContentLoaded', function() {
        const deleteForms = document.querySelectorAll('form[action*="destroy"]');
        deleteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('Are you sure you want to delete this auberge?')) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
@endpush
@endsection