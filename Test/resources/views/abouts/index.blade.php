@extends('layouts.layouts')

@section('title', 'About Us')

@section('content')
    <h1>About Us</h1>

    <x-alert type="success" />
    <x-alert type="error" />

    <form action="{{ route('abouts.update', ['about' => $about]) }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" value="{{ $about->title ?? '' }}" class="form-control">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control">{{ $about->description ?? '' }}</textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <img src="{{ asset('storage/' . $about->image) }}" width="100" class="form-label">
            <input name="image" type="file" class="form-control"></input>
        </div>

        <div class="mb-3">
            <a href="{{ $about->facebook ?? '' }}" target="_blank">Facebook</a>
            <input type="text" name="facebook" value="{{ $about->facebook ?? '' }}" class="form-control">
        </div>

        <div class="mb-3">
            <a href="{{ $about->twitter ?? '' }}" target="_blank">Twitter</a>
            <input type="text" name="twitter" value="{{ $about->twitter ?? '' }}" class="form-control">
        </div>

        <div class="mb-3">
            <a href="{{ $about->linkedin ?? '' }}" target="_blank">LinkedIn</a>
            <input type="text" name="linkedin" value="{{ $about->linkedin ?? '' }}" class="form-control">

        </div>

        <button type="submit" class="btn btn-primary">
            Update
        </button>
    </form>
@endsection
