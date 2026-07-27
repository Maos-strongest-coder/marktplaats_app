@extends('layouts.app')

@section('title', 'Login Page')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-2xl flex flex-col items-center justify-center">
    <div class="mb-6">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Login</h2>
    </div>

    <form method="POST" action="{{ route('login.attempt') }}">
        @csrf

        <div class="mb-4">
            <label class="block">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="JohnDoe@email.com" class="border p-2" required>
        </div>

        <div class="mb-4">
            <label class="block">Password</label>
            <input type="password" name="password" class="border p-2" placeholder="********" required>
        </div>
        <a href="{{ route('password.request') }}" class="text-black hover:text-blue-300" >I forgot my password</a><br>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2">Log in</button>
    </form>

    <div>
        <h2 class="text-2xl font-bold mb-6 text-gray-800">No account yet?</h2>
        <p class="text-gray-600"></p>
        <a href="{{ route('register.show') }}" class="text-blue-600 font-bold flex flex-col items-center justify-center hover:text-blue-300">Sign up to create an account</a>
    </div>
</div>
@endsection
