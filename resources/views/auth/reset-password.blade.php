@extends('layouts.auth')

@section('title', 'Reset Password')

@section('content')
<div class="flex items-center justify-center min-h-screen auth-container">
    <div class="w-full max-w-md p-8 auth-card">
        <div class="text-center mb-8">
            <h1 class="logo-font text-4xl font-bold text-center mb-2">
                <span class="fire-icon inline-block mr-2"><i class="fas fa-campground text-orange-500"></i></span>
                <span class="bg-clip-text text-white bg-gradient-to-r from-orange-500 to-yellow-300">YouCamp</span>
            </h1>
            <p class="text-white text-opacity-70">Reset your password</p>
        </div>

        <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div>
                <label for="email" class="text-white text-sm font-medium block mb-2">Email Address</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-envelope text-gray-400"></i>
                    </div>
                    <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}" required
                        class="form-input w-full pl-10 pr-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 @error('email') border-red-500 @enderror">
                </div>
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="text-white text-sm font-medium block mb-2">New Password</label>
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

            <div>
                <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-white bg-gradient-to-r from-orange-600 to-orange-500 hover:from-orange-500 hover:to-orange-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-600 transition-all duration-300 ease-in-out transform hover:-translate-y-1">
                    <i class="fas fa-sync-alt mr-2"></i> Reset Password
                </button>
            </div>
        </form>
    </div>
</div>
@endsection