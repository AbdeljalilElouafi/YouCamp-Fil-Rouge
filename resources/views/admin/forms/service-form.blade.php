<!-- Service Modal -->
<div id="serviceModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <!-- Modal Overlay -->
        <div class="fixed inset-0 transition-opacity bg-black bg-opacity-75"></div>

        <!-- Modal Content -->
        <div class="inline-block align-bottom bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="px-6 py-4">
                <h2 class="text-2xl font-bold mb-6 text-white">{{ isset($service) ? 'Edit Service' : 'Add Service' }}</h2>

                <form action="{{ isset($service) ? route('admin.services.update', $service->id) : route('admin.services.store') }}" method="POST">
                    @csrf
                    @if (isset($service))
                        @method('PUT')
                    @endif

                    <!-- Name -->
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-white">Name</label>
                        <input type="text" id="name" name="name" value="{{ isset($service) ? $service->name : '' }}" class="mt-1 block w-full px-4 py-2 bg-white bg-opacity-10 border border-transparent rounded-md text-white focus:border-orange-500 focus:ring-orange-500" placeholder="Enter service name">
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-white">Description</label>
                        <textarea id="description" name="description" class="mt-1 block w-full px-4 py-2 bg-white bg-opacity-10 border border-transparent rounded-md text-white focus:border-orange-500 focus:ring-orange-500" placeholder="Enter service description">{{ isset($service) ? $service->description : '' }}</textarea>
                    </div>

                    <!-- Submit and Close Buttons -->
                    <div class="mt-6 flex justify-end space-x-4">
                        <button type="button" onclick="closeModal('serviceModal')" class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700">
                            Cancel
                        </button>
                        <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded-md hover:bg-orange-600">
                            {{ isset($service) ? 'Update Service' : 'Add Service' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>