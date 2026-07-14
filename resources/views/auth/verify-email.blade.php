@extends('layouts.app')

@section('title', 'Verify Email')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-2xl flex flex-col items-center justify-center">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Account registered succesfully</h2>
    <p>Good job signing up! are you also able to verify your email address by clicking on the link I just emailed you?</p>

    @if(session('status') == 'verification-link-sent')
    <p>A new verification link has been sent to the email address you provided during registration</p>
    @endif

    <p>Didn't receive the email?</p>

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf

        <button class="bg-blue-600 text-white px-4 py-2">Resend Verification Email</button>
    </form>
</div>
@endsection
