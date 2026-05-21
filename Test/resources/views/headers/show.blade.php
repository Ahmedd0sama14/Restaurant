@extends('layouts.layouts')
@section('title', $header->title)
@section('content')

    <h1>{{ $header->title }}</h1>

    <img src="{{ asset('storage/' . $header->image) }}" alt="{{ $header->title }}" width="300">

    <p>{{ $header->description }}</p>

    <a href="{{ route('headers.index') }}" class="btn btn-secondary">
        Back to Headers
    </a>

@endsection
