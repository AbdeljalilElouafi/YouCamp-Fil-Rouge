<!-- resources/views/admin/managers.blade.php -->
@extends('layouts.admin')

@section('title', 'Gérants Management')

@section('content')
    <div class="card p-6">
        <h2 class="text-2xl font-bold mb-6 text-white">Pending Managers</h2>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white bg-opacity-10 rounded-lg">
                <thead>
                    <tr class="text-white">
                        <th class="px-4 py-3">ID</th>
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pendingManagers as $manager)
                        <tr class="text-white">
                            <td class="px-4 py-3">{{ $manager->id }}</td>
                            <td class="px-4 py-3">{{ $manager->name }}</td>
                            <td class="px-4 py-3">{{ $manager->email }}</td>
                            <td class="px-4 py-3">
                                <form action="{{ route('admin.managers.approve', $manager->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-green-500 hover:text-green-700 mr-2">
                                        <i class="fas fa-check"></i> Approve
                                    </button>
                                </form>
                                <form action="{{ route('admin.managers.reject', $manager->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                        <i class="fas fa-times"></i> Reject
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('admin.forms.gerant-form')
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