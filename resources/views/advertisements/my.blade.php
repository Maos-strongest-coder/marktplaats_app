@extends('layouts.app')

@section('title', 'My Advertisements')

@section('content')


<h2 class="text-2xl font-bold mb-6 text-gray-800">My Advertisements</h2>

@if($advertisements->isEmpty())
<p>No advertisements found.</p>

<a href="{{ route('advertisements.create') }}" class="font-bold">Create a new Advertisement -></a>
@else
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($advertisements as $advertisement)
        @include('partials.advertisement-card')
        @endforeach
    </div>
</div>
@endif
@endsection