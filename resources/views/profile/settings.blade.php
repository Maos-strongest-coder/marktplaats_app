@extends('layouts.app')

@section('title', 'Profile Settings')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-2xl flex flex-col items-center justify-center">
    <div class="mb-6">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Profile Settings</h2>
    </div>

    <form method="POST" action="{{ route('settings.update') }}">
        @csrf
        @method('PUT')

        <div class="space-y-4">
            <h3 class="text-lg font-medium mb-6 text-gray-800">Notification Settings</h3>
                
                
            <input id="notifications_enabled" name="notifications_enabled" type="checkbox" value="1" {{ $user->notifications_enabled ? 'checked' : '' }}>
            <label focus for="notifications_enabled" class="font-medium text-gray-700 cursor-pointer">Email Notifications</label>
                        
            <p class="text-gray-500 text-xs mt-0.5">Receive an email notification whenever a user sends you a new chat message about an advertisement.</p>
        </div>
        
        <button type="submit" class="bg-blue-600 text-white px-4 py-2">Change Settings</button>
        
</div>
@endsection
