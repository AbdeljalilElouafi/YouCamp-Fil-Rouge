<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auberge Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fade-in 0.6s ease-out both;
        }
        .bg-gradient-dark {
            background: linear-gradient(135deg, #1a202c 0%, #2d3748 100%);
        }
    </style>
</head>
<body class="bg-gray-900 text-gray-100 min-h-screen flex flex-col">
    <!-- Header -->
    <header class="bg-gray-800 py-4 shadow-lg">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <h1 class="text-2xl font-bold text-orange-400">Auberge Manager</h1>
                <nav class="hidden md:flex space-x-1">
                    <a href="{{ route('manager.dashboard') }}" class="px-3 py-2 rounded hover:bg-gray-700 transition duration-300">Dashboard</a>
                    <a href="{{ route('auberges.index') }}" class="px-3 py-2 rounded hover:bg-gray-700 transition duration-300">All Auberges</a>
                    @auth
                    <a href="{{ route('auberges.my') }}" class="px-3 py-2 rounded hover:bg-gray-700 transition duration-300">My Auberges</a>
                    <a href="{{ route('auberges.create') }}" class="px-3 py-2 rounded hover:bg-gray-700 transition duration-300">Create Auberge</a>
                    @endauth
                </nav>
            </div>
            
            <div class="flex items-center space-x-4">
                @auth
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center text-white hover:text-orange-400 transition duration-300">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </button>
                </form>
                @else
                <a href="{{ route('login') }}" class="px-3 py-2 rounded hover:bg-gray-700 transition duration-300">Login</a>
                <a href="{{ route('register') }}" class="px-3 py-2 bg-orange-500 rounded hover:bg-orange-600 transition duration-300">Register</a>
                @endauth
                <button class="md:hidden focus:outline-none" id="mobile-menu-button">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>
        
        <!-- Mobile menu -->
        <div class="md:hidden hidden bg-gray-700" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="{{ route('auberges.index') }}" class="block px-3 py-2 rounded hover:bg-gray-600">All Auberges</a>
                @auth
                <a href="{{ route('auberges.my') }}" class="block px-3 py-2 rounded hover:bg-gray-600">My Auberges</a>
                <a href="{{ route('auberges.create') }}" class="block px-3 py-2 rounded hover:bg-gray-600">Create Auberge</a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 py-8 animate-fade-in">
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-600 text-white rounded-lg shadow-lg">
                {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div class="mb-6 p-4 bg-red-600 text-white rounded-lg shadow-lg">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 py-6 mt-8">
        <div class="container mx-auto px-4 text-center">
            <p class="text-gray-400">&copy; 2025 Auberge Manager. All rights reserved.</p>
        </div>
    </footer>

    <script>
        
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    @stack('scripts')
</body>
</html>