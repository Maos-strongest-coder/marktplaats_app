@extends('layouts.app')

@section('title', 'Forgot Password')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-2xl flex flex-col items-center justify-center">
    <div class="mb-6">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Password Forgotten?</h2>
    </div>

    

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-4">
            <input type="email" id="email" name="email" value="{{ old('email') }}" size="30" placeholder="Enter your email:" required/>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2">Send Password Reset Link</button>
    </form>
@endsection
