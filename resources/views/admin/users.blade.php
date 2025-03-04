@extends('layouts.admin')

@section('title', 'Users Management')

@section('content')
    <div class="card p-6">
        <h2 class="text-2xl font-bold mb-6 text-white">Users Management</h2>

        <!-- Add User Button -->
        <div class="mb-4">
        <button onclick="openModal('userModal')" class="bg-orange-500 text-white px-4 py-2 rounded-md hover:bg-orange-600">
            <i class="fas fa-plus mr-2"></i>Add User
        </button>
        </div>

        <!-- Users Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white bg-opacity-10 rounded-lg">
                <thead>
                    <tr class="text-white">
                        <th class="px-4 py-3">ID</th>
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">Role</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Static Data for Now -->
                    <tr class="text-white">
                        <td class="px-4 py-3">1</td>
                        <td class="px-4 py-3">John Doe</td>
                        <td class="px-4 py-3">john@example.com</td>
                        <td class="px-4 py-3">User</td>
                        <td class="px-4 py-3">
                            <button class="text-blue-500 hover:text-blue-700 mr-2">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="text-red-500 hover:text-red-700">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @include('admin.forms.user-form')
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