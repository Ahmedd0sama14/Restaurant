@extends('layouts.layouts')

@section('title', $course->title)

@section('content')

    <div class="container py-5">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h1 class="fw-bold mb-1">
                    {{ $course->title }}
                </h1>

                <p class="text-muted mb-0">
                    Course Details
                </p>
            </div>

            <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary">
                ← Back
            </a>

        </div>

        <div class="row g-4">

            {{-- Course Image --}}
            <div class="col-lg-5">

                <div class="card shadow-sm border-0 overflow-hidden">

                    <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->title }}" class="img-fluid"
                        style="height: 350px; object-fit: cover;">

                </div>

            </div>

            {{-- Course Details --}}
            <div class="col-lg-7">

                <div class="card shadow-sm border-0 h-100">

                    <div class="card-body">

                        {{-- Description --}}
                        <div class="mb-4">

                            <h4 class="fw-bold mb-3">
                                Description
                            </h4>

                            <p class="text-muted lh-lg">
                                {{ $course->description }}
                            </p>

                        </div>

                        {{-- Info --}}
                        <div class="row g-3">

                            {{-- Teacher --}}
                            <div class="col-md-6">

                                <div class="border rounded p-3 h-100">

                                    <small class="text-muted d-block mb-1">
                                        Teacher
                                    </small>

                                    <h6 class="fw-bold mb-0">
                                        {{ $course->teacher->name ?? 'N/A' }}
                                    </h6>

                                </div>

                            </div>

                            {{-- Course Type --}}
                            <div class="col-md-6">

                                <div class="border rounded p-3 h-100">

                                    <small class="text-muted d-block mb-1">
                                        Course Type
                                    </small>

                                    <span class="badge bg-primary">
                                        {{ $course->courseType->name ?? 'N/A' }}
                                    </span>

                                </div>

                            </div>

                            {{-- Original Price --}}
                            <div class="col-md-6">

                                <div class="border rounded p-3 h-100">

                                    <small class="text-muted d-block mb-1">
                                        Original Price
                                    </small>

                                    <h5 class="fw-bold mb-0">
                                        ${{ number_format($course->price, 2) }}
                                    </h5>

                                </div>

                            </div>

                            {{-- Final Price --}}
                            <div class="col-md-6">

                                <div class="border rounded p-3 h-100 bg-success bg-opacity-10">

                                    <small class="text-muted d-block mb-1">
                                        Final Price
                                    </small>

                                    <h5 class="fw-bold text-success mb-0">
                                        ${{ number_format($course->price_after_discount, 2) }}
                                    </h5>

                                </div>

                            </div>

                            {{-- Discount --}}
                            @if ($course->discount && $course->discount_type)

                                <div class="col-md-6">

                                    <div class="border rounded p-3 h-100">

                                        <small class="text-muted d-block mb-1">
                                            Discount
                                        </small>

                                        <div>

                                            <span class="badge bg-danger">

                                                {{ $course->discount }}

                                                @if ($course->discount_type->label() === 'Percentage')
                                                    %
                                                @endif

                                            </span>

                                            <small class="text-muted ms-2">
                                                ({{ $course->discount_type->label() }})
                                            </small>

                                        </div>

                                    </div>

                                </div>
                            @else
                                <div class="col-md-6">

                                    <div class="border rounded p-3 h-100">

                                        <small class="text-muted d-block mb-1">
                                            Discount
                                        </small>

                                        <span class="text-muted">
                                            No Discount
                                        </span>

                                    </div>

                                </div>

                            @endif

                            {{-- Duration --}}
                            <div class="col-md-6">

                                <div class="border rounded p-3 h-100">

                                    <small class="text-muted d-block mb-1">
                                        Duration
                                    </small>

                                    <h6 class="fw-bold mb-0">
                                        {{ $course->duration }}
                                        {{ ucfirst($course->duration_type->label()) }}
                                    </h6>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        {{-- Introduction Video --}}
        @if ($course->introduction_video)
            <div class="card shadow-sm border-0 mt-5">

                <div class="card-body">

                    <h3 class="fw-bold mb-4">
                        Introduction Video
                    </h3>

                    <video controls class="w-100 rounded" style="max-height: 500px;">

                        <source src="{{ asset('storage/' . $course->introduction_video) }}" type="video/mp4">

                        Your browser does not support the video tag.

                    </video>

                </div>

            </div>
        @endif

    </div>

@endsection
