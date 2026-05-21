@extends('layouts.layouts')
@section('title', 'Show Course')
@section('content')
    <h1>{{ $course->title }}</h1>
    <p>{{ $course->description }}</p>
    <p>Price: {{ $course->price }}</p>
    <p>Price after discount: {{ $course->price_after_discount }}</p>
    <p>Duration: {{ $course->duration }} {{ $course->duration_type }}</p>
    <p>Discount: {{ $course->discount }}% ({{ $course->discount_type }})</p>
    <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->title }}" width="300">

    @if ($course->introduction_video)
        <video controls>
            <source src="{{ asset('storage/' . $course->introduction_video) }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    @endif


    <a href="{{ route('courses.index') }}" class="btn btn-secondary">Back to Courses</a>
@endsection
