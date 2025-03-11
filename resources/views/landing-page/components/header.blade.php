
<header class="bg-gradient-to-r from-[#FF6F00] to-[#fda83a] text-white shadow-lg">
    <div class="container mx-auto flex items-center justify-between py-5 px-8">
        <div class="flex items-center space-x-3">
            <i class="fas fa-campground text-3xl text-white"></i>
            <span class="text-3xl font-bold text-white">YouCamp</span>
        </div>
        <nav class="space-x-8">
            <a href="{{ route('login') }}" class="text-lg font-medium hover:text-gray-200 transition duration-300">Log In</a>
            <a href="{{ route('register') }}" class="text-lg font-medium hover:text-gray-200 transition duration-300">Register</a>
        </nav>
    </div>
</header>
