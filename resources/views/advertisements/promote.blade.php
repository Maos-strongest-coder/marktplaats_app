@extends('layouts.app')

@section('title', 'Promotion')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-2xl flex flex-col items-center justify-center">
<h2>Promote "{{$advertisement->title}}"</h2>
<p>pay ten dorra to promote your advertisement, placing it on top of the homepage</p>

<form method="POST" action="{{ route('advertisements.promote', $advertisement) }}">
    @csrf

    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">
        Pay Ten Dorra
    </button>
</form>

<a href="{{ route('advertisements.my') }}" class="bg-red-500 text-white px-4 py-2 rounded">
    Cancel</a>
</div>
@endsection
