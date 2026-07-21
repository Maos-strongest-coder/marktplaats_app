@extends('layouts.app')

@section('title', 'Inbox')

@section('content')
    <div class="flex h-[80vh] bg-white border rounded-lg overflow-hidden max-w-6xl mx-auto my-6">
    

        <div class="w-1/3 border-r bg-gray-50 overflow-y-auto">
            <div class="p-4 font-bold border-b bg-gray-100">Conversations</div>

            <ul class="divide-y">
                
                @forelse ($conversations as $conversation)
                    @php
                        $partner = $conversation->sender_id === Auth::id() ? $conversation->receiver : $conversation->sender;
                        $ad = $conversation->advertisement;

                        $isActive = request('partner_id') == $partner->id && request('advertisement_id') == $conversation->advertisement_id;
                    @endphp
                    <li>
                       <a href="{{ route('inbox', ['partner_id' => $partner->id, 'advertisement_id' => $conversation->advertisement_id]) }}" class="block p-4 hover:bg-blue-500 transition {{ $isActive ? 'bg-blue-300' : '' }}">
                        
                            <p class="font-medium">{{$partner->name }}</p>

                            <p class="text-sm text-gray-600">{{ substr($ad->title, 0, 20) }} @if(strlen($ad->title) > 20)...@endif</p>
                        </a>
                    </li>
                    @empty
                    <li class="p-4 text-gray-500 text-sm text-center">No conversations yet</li>
                @endforelse
            </ul>                              
        </div>
            
        

        
        <div class="w-full border-l h-full relative overflow-y-auto bg-white flex flex-col justify-between">
            @if ($activeMessages->isNotEmpty())
                @php
                    $firstMessage = $activeMessages->first();
                    $activePartner = $firstMessage->sender_id === Auth::id() ? $firstMessage->receiver : $firstMessage->sender;
                    $activeAd = $firstMessage->advertisement;
                @endphp

                <div class="p-4 border-b bg-gray-50 shrink-0">
                    <h2 class="font-bold text-lg text-gray-900">{{ $activePartner->name }}</h2>
                    <h3 class="text-xs text-gray-500">{{ $activeAd->title }}</h3>
                </div>
            

                
                 <div class="flex-1 p-4 overflow-y-auto space-y-3 bg-gray-50/30">
                    @foreach($activeMessages as $message)
                        @php $isMe =$message->sender_id === Auth::id(); @endphp

                        <div class="flex {{ $isMe ? 'justify-end' : 'justify-start' }}">
                            <div class="max-w-[70%] p-3 rounded-lg text-sm  {{ $isMe ? 'bg-blue-600 text-white rounded-br-none' : 'bg-gray-200 text-gray-800 rounded-bl-none' }}">
                                <h2 class="font-medium {{ $isMe ? 'text-gray-800' : '' }} ">{{ $message->sender->name }}</h2>
                                <p>{{ $message->content }}</p>
                                <span  class="block text-[10px] mt-1 text-right {{ $isMe ? 'text-blue-200' : 'text-gray-400' }}">
                                    > {{ $message->created_at->format('d M Y H:i') }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                 </div>

                
                <div class="p-4 border-t bg-white shrink-0">
                    <form action="{{ route('messages.send') }}" method="POST" class="flex gap-2">
                        @csrf
                        <input type="hidden" name="receiver_id" value="{{ $activePartner->id }}">
                        <input type="hidden" name="advertisement_id" value="{{ $activeAd->id }}">
                        <input type="text" name="content" placeholder="Write a message..." class="flex-1 border rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
                        <button type="submit"  class="bg-blue-600 text-white px-4 py-2 rounded">Send Message</button>
                    </form>
                </div>

            @else
                <div class="m-auto text-center text-gray-400 p-6">
                    <p class="text-base font-medium">Select a conversation from the left to begin</p>
                </div>
            @endif
        </div>
    </div>

@endsection
