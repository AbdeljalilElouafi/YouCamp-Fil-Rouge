<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - YouCamp</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-900 text-white">
    <!-- Header -->
    <header class="bg-gray-800 py-4">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold">YouCamp</h1>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="flex items-center text-white hover:text-orange-400 transition duration-300 ease-in-out">
                    <i class="fas fa-sign-out-alt text-xl"></i>
                    <span class="ml-2">Logout</span>
                </button>
            </form>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 py-4 mt-8">
        <div class="container mx-auto px-4 text-center">
            <p class="text-gray-400">&copy; 2023 YouCamp. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>