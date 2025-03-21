@extends('layouts.admin')

@section('title', 'Tags Management')

@section('content')
    <div class="card p-6">
        <h2 class="text-2xl font-bold mb-6 text-white">Tags Management</h2>

        <!-- Add Tag Button -->
        <div class="mb-4">
            <button onclick="openModal('tagModal')" class="bg-orange-500 text-white px-4 py-2 rounded-md hover:bg-orange-600">
                <i class="fas fa-plus mr-2"></i>Add Tag
            </button>
        </div>

        <!-- Tags Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white bg-opacity-10 rounded-lg">
                <thead>
                    <tr class="text-white">
                        <th class="px-4 py-3">ID</th>
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tags as $tag)
                        <tr class="text-white">
                            <td class="px-4 py-3">{{ $tag->id }}</td>
                            <td class="px-4 py-3">{{ $tag->name }}</td>
                            <td class="px-4 py-3">
                                <button onclick="openModal('tagModal')" class="text-blue-500 hover:text-blue-700 mr-2">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ route('admin.tags.destroy', $tag->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('admin.forms.tag-form')


    <script>
        function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
        }

        // Close Modal
        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target.classList.contains('bg-black')) {
                event.target.closest('.fixed').classList.add('hidden');
            }
        };
    </script>
@endsection