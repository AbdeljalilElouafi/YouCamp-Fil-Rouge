
<div class="sidebar w-72 space-y-6 py-7 px-4 overflow-y-auto">
    <div class="logo-font text-3xl font-bold text-center mb-8 text-white flex items-center justify-center">
        <span class="fire-icon mr-2"><i class="fas fa-campground text-orange-500"></i></span>
        <span class="bg-clip-text text-white bg-gradient-to-r from-orange-500 to-yellow-300">YouCamp</span>
    </div>
    <nav>
        <ul class="space-y-3">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 text-white">
                    <i class="fas fa-tachometer-alt mr-3 text-xl"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.users') }}" class="flex items-center px-4 py-3 text-white">
                    <i class="fas fa-users mr-3 text-xl"></i>
                    <span>Users</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.managers') }}" class="flex items-center px-4 py-3 text-white">
                    <i class="fas fa-user-tie mr-3 text-xl"></i>
                    <span>Gérants</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.categories') }}" class="flex items-center px-4 py-3 text-white">
                    <i class="fas fa-tags mr-3 text-xl"></i>
                    <span>Categories</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.tags') }}" class="flex items-center px-4 py-3 text-white">
                    <i class="fas fa-hashtag mr-3 text-xl"></i>
                    <span>Tags</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.posts') }}" class="flex items-center px-4 py-3 text-white">
                    <i class="fas fa-newspaper mr-3 text-xl"></i>
                    <span>Posts</span>
                </a>
            </li>
            
        </ul>
    </nav>
    <div class="mt-auto pt-10">
        <div class="card p-4 text-white text-center">
            <div class="text-sm font-medium opacity-70">Current Season</div>
            <div class="text-xl font-bold mt-1">Summer 2025</div>
            <div class="mt-2 text-xs opacity-70">Peak camping season!</div>
        </div>
    </div>
</div>