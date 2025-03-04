<!-- resources/views/components/header.blade.php -->
<header class="header shadow-lg z-10">
    <div class="flex items-center justify-between py-4 px-6">
        <div class="flex items-center">
            <h1 class="text-3xl font-bold text-white logo-font">
                Adventure Dashboard
            </h1>
        </div>
        <div class="flex items-center space-x-4">
            <div class="relative">
                <input type="text" placeholder="Search..." class="bg-gray-800 text-white border-0 rounded-full py-2 px-4 pl-10 focus:outline-none focus:ring-2 focus:ring-orange-500">
                <i class="fas fa-search absolute left-3 top-2.5 text-gray-400"></i>
            </div>
            <div class="relative pulse">
                <i class="fas fa-bell text-white text-xl cursor-pointer"></i>
                <span class="absolute -top-1 -right-1 bg-red-500 rounded-full w-4 h-4 flex items-center justify-center text-xs text-white">3</span>
            </div>
            <div class="flex items-center">
                <img src="/api/placeholder/40/40" alt="Admin" class="w-10 h-10 rounded-full border-2 border-orange-500">
                <span class="ml-2 text-white">Admin User</span>
            </div>
        </div>
    </div>
</header>