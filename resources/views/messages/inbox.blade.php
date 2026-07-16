@extends('layouts.app')

@section('title', Inbox)

@section('content')
    @foreach(Auth::user->sent)

@endsection
