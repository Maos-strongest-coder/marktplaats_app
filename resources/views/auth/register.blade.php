@extends('layouts.app')

@section('title', 'Signup Page')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-2xl flex flex-col items-center justify-center">
    <div class="mb-6">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Register</h2>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

         <div class="mb-4">
            <label class="block">Name</label>
            <input type="name" name="name" value="{{ old('name') }}" placeholder="John Doe" class="border p-2" required>
        </div>

        <div class="mb-4">
            <label class="block">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="JohnDoe@email.com" class="border p-2" required>
        </div>

        <div class="mb-4">
            <label class="block">Password</label>
            <input type="password" name="password" placeholder="********" class="border p-2" required>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2">Register</button>
    </form>

    <div>
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Do you have an account already?</h2>
        <a href="{{ route('login') }}" class="text-blue-600 font-bold flex flex-col items-center justify-center">Log in instead</a>
    </div>
</div>
@endsection
