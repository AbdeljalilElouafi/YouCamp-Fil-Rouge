<!-- resources/views/auth/pending_activation.blade.php -->
@extends('layouts.auth')

@section('title', 'Pending Activation')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="bg-gray-800 p-6 rounded-lg shadow-lg text-center">
            <h1 class="text-2xl font-bold text-white mb-4">Account Pending Activation</h1>
            <p class="text-gray-400">{{ session('message', 'Sorry, your account hasn\'t been activated yet. We will be in touch as soon as possible.') }}</p>
            <form method="POST" action="{{ route('logout') }}" class="flex items-center justify-center">
                @csrf
                <button type="submit" class="flex items-center text-white hover:text-orange-400 transition duration-300 ease-in-out">
                    <i class="fas fa-sign-out-alt text-xl"></i>
                    <span class="ml-2">Go Back</span>
                </button>
            </form>        
        </div>
    </div>
@endsection