@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-2xl flex flex-col items-center justify-center">
    <div class="mb-6">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Reset Password</h2>
    </div>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="mb-4">
            <label class="block mb-1 font-medium text-gray-700">Email</label>
            <input type="email" name="email" value="{{ $request->email ?? old('email') }}" class="border p-2 w-full bg-gray-100 text-gray-500 cursor-not-allowed" required>
        </div>

        <div class="mb-4">
            <label class="block">New Password</label>
            <input type="password" name="password" class="border p-2 w-full" placeholder="********" required>
        </div>

        <div class="mb-6">
            <label class="block">Confirm Password</label>
            <input type="password" name="password_confirmation" class="border p-2 w-full" placeholder="********" required>
        </div>

         <button type="submit" class="bg-blue-600 text-white px-4 py-2">Reset Password</button>
    </form>
</div>
@endsection