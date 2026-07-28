@extends('layouts.app')

@section('title', $advertisement->title)

@section('content')
    <div class="flex h-[80vh] bg-white border rounded-lg overflow-hidden max-w-6xl mx-auto my-6">
        
        <div class="w-1/3 border-r bg-gray-50 overflow-y-auto">
            
            <div class="p-4 font-bold border-b bg-gray-100 flex justify-between items-center">
                <h2 class="font-bold text-base text-gray-900 mb-2">Bids</h2>
            </div>

            <ul class="divide-y">
                @forelse ($advertisement->bids as $bid)
                    <li class="p-4 hover:bg-gray-100 transition bg-white">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="font-medium text-gray-900">{{ $bid->user->name }}</p>
    
                                <p class="text-xs text-gray-500">{{ $bid->created_at->format('d M Y H:i') }}</p>
                            </div>
                            <span class="text-sm font-bold text-green-600 bg-green-50 px-2 py-1 rounded">
                                € {{ number_format($bid->amount, 2, ',', '.') }}
                            </span>
                        </div>
                    </li>
                @empty
                    <li class="p-8 text-gray-500 text-sm text-center italic">
                        No Bids Yet
                    </li>
                @endforelse
                
            </ul>
        </div>
            




    <div class="container mx-auto px-4 py-8 max-w-4xl">
        @include('partials.advertisement-card')

        @auth
            @if(Auth::id() !== $advertisement->user_id)
                <h2 class="font-bold text-base text-gray-900 mb-2">Ask the seller a question</h2>

                <form  action="{{ route('messages.send') }}" method="POST" class="flex flex-col gap-3">
                    <input type="hidden" name="receiver_id" value="{{ $advertisement->user_id }}">
                    <input type="hidden" name="advertisement_id" value="{{ $advertisement->id }}">

                    <textarea name="content" rows="4" placeholder="I'm interested in {{ $advertisement->title }}" required></textarea>

                    <button type="submit"  class="bg-blue-600 text-white px-4 py-2 rounded">
                        Send Message
                    </button>
                </form>
            @endif
        @else
            <p class="text-sm text-gray-600">You have to be <a href="{{ route('login')}}" class="text-blue-600 font-semibold hover:text-blue-300">logged in</a>to send a message</p>
        @endauth
    </div>

    <div class="p-4 border-t bg-white shrink-0">     
        <form action="{{ route('advertisements.bids.store', $advertisement->id) }}" method="POST" class="flex gap-2 items-center">
            @csrf

            <div class="relative flex-1">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center ">
                    <span class="text-gray-500 sm:text-sm">€</span>
                </div>
                <input type="number" name="amount" id="bid_amount" step="0.01" min="1" max="9999" placeholder="Make a Bid..." required
                    class="w-full border rounded-lg pl-7 pr-4 py-2 text-sm">
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded" onclick="return confirm('Confirm to make a bid of €' + document.getElementById('bid_amount').value + ' on {{ $advertisement->title }}')">
                Bid
            </button>
        </form>       
    </div>

@endsection
