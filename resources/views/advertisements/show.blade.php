@extends('layouts.app')

@section('title', $advertisement->title)

@section('content')
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        @include('partials.advertisement-card')
    </div>

@endsection
