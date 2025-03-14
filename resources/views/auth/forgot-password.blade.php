@extends('layouts.auth')

@section('title', 'Forgot Password')

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

        @if (session('status'))
            <div class="mb-4 text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
            @csrf

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
                <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-white bg-gradient-to-r from-orange-600 to-orange-500 hover:from-orange-500 hover:to-orange-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-600 transition-all duration-300 ease-in-out transform hover:-translate-y-1">
                    <i class="fas fa-paper-plane mr-2"></i> Send Reset Link
                </button>
            </div>
        </form>
    </div>
</div>
@endsection