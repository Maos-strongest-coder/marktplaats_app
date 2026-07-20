@extends('layouts.app')

@section('title', $advertisement->title)

@section('content')
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        @include('partials.advertisement-card')

        @auth
            @if(Auth::id() !== $advertisement->user_id)
                <h2 class="font-bold text-base text-gray-900 mb-2">Ask the seller a question</h2>

                <form  action="{{ route('messages.send') }}" method="POST" class="flex flex-col gap-3">
                    <input type="hidden" name="receiver_id" value="{{ $advertisement->user_id }}">
                    <input type="hidden" name="advertisement_id" value="{{ $advertisement->id }}">

                    <textarea name="content" rows="4" placeholder="I'm interested in {{ $advertisement->title }}" required></textarea>

                    <button type="submit"  class="bg-blue-600 text-white px-4 py-2 rounded">Send Message</button>
                </form>
            @endif
        @else
            <p class="text-sm text-gray-600">You have to be <a href="{{ route('login')}}" class="text-blue-600 font-semibold hover:text-blue-300">logged in</a>to send a message</p>
        @endauth
    </div>

@endsection
