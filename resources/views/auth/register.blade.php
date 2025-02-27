@extends('layouts.auth')

@section('title', 'Register for YouCamp')

@section('content')
<div class="flex items-center justify-center min-h-screen auth-container py-10">
    <div class="w-full max-w-md p-8 auth-card">
        <div class="text-center mb-8">
            <h1 class="logo-font text-4xl font-bold text-center mb-2">
                <span class="fire-icon inline-block mr-2"><i class="fas fa-campground text-orange-500"></i></span>
                <span class="bg-clip-text text-white bg-gradient-to-r from-orange-500 to-yellow-300">YouCamp</span>
            </h1>
            <p class="text-white text-opacity-70">Start your camping adventure!</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf
            
            <div>
                <label for="name" class="text-white text-sm font-medium block mb-2">Full Name</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-user text-gray-400"></i>
                    </div>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                        class="form-input w-full pl-10 pr-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 @error('name') border-red-500 @enderror">
                </div>
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="text-white text-sm font-medium block mb-2">Email Address</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-envelope text-gray-400"></i>
                    </div>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                        class="form-input w-full pl-10 pr-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 @error('email') border-red-500 @enderror">
                </div>
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="text-white text-sm font-medium block mb-2">Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-lock text-gray-400"></i>
                    </div>
                    <input id="password" type="password" name="password" required
                        class="form-input w-full pl-10 pr-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 @error('password') border-red-500 @enderror">
                </div>
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="text-white text-sm font-medium block mb-2">Confirm Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-lock text-gray-400"></i>
                    </div>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                        class="form-input w-full pl-10 pr-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-white bg-gradient-to-r from-orange-600 to-orange-500 hover:from-orange-500 hover:to-orange-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-600 transition-all duration-300 ease-in-out transform hover:-translate-y-1">
                    <i class="fas fa-user-plus mr-2"></i> Create Account
                </button>
            </div>
        </form>
        
        <div class="mt-6 text-center">
            <p class="text-white text-opacity-70 text-sm">
                Already have an account? 
                <a href="{{ route('login') }}" class="text-orange-400 hover:text-orange-300 font-medium">
                    Log in
                </a>
            </p>
        </div>
    </div>
</div>
@endsection