@extends('layouts.layouts')

@section('title', 'Edit Course')

@section('content')

    <div class="container py-5">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h1 class="fw-bold mb-1">
                    Edit Course
                </h1>

                <p class="text-muted mb-0">
                    Update course information
                </p>
            </div>

            <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary">
                ← Back
            </a>

        </div>

        {{-- Form --}}
        <div class="card shadow-sm border-0">
            <div class="card-body">

                <form action="{{ route('courses.update', ['course' => $course]) }}" method="POST"
                    enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="row g-3">

                        {{-- Title --}}
                        <div class="col-md-6">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" value="{{ old('title', $course->title) }}"
                                class="form-control">
                        </div>

                        {{-- Price --}}
                        <div class="col-md-3">
                            <label class="form-label">Price</label>
                            <input type="number" step="0.01" name="price" value="{{ old('price', $course->price) }}"
                                class="form-control">
                        </div>

                        {{-- Discount --}}
                        <div class="col-md-3">
                            <label class="form-label">Discount</label>
                            <input type="number" name="discount" value="{{ old('discount', $course->discount) }}"
                                class="form-control">
                        </div>

                        {{-- Duration --}}
                        <div class="col-md-3">
                            <label class="form-label">Duration</label>
                            <input type="number" name="duration" value="{{ old('duration', $course->duration) }}"
                                class="form-control">
                        </div>

                        {{-- Duration Type --}}
                        <div class="col-md-3">
                            <label class="form-label">Duration Type</label>
                            <select name="duration_type" class="form-select">

                                @foreach ($durationTypes as $type)
                                    <option value="{{ $type->value }}" @selected($course->duration_type->value == $type->value)>
                                        {{ $type->label() }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        {{-- Discount Type --}}
                        <div class="col-md-3">
                            <label class="form-label">Discount Type</label>
                            <select name="discount_type" class="form-select">

                                {{-- No Discount --}}
                                <option value="">
                                    No Discount
                                </option>

                                @foreach ($discountTypes as $type)
                                    <option value="{{ $type->value }}" @selected($course->discount_type?->value == $type->value)>

                                        {{ $type->label() }}

                                    </option>
                                @endforeach

                            </select>
                        </div>

                        {{-- Teacher --}}
                        <div class="col-md-3">
                            <label class="form-label">Teacher</label>
                            <select name="teacher_id" class="form-select">

                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->id }}" @selected($course->teacher_id == $teacher->id)>
                                        {{ $teacher->name }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        {{-- Course Type --}}
                        <div class="col-md-3">
                            <label class="form-label">Course Type</label>
                            <select name="course_type_id" class="form-select">

                                @foreach ($courseTypes as $type)
                                    <option value="{{ $type->id }}" @selected($course->course_type_id == $type->id)>
                                        {{ $type->title }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        {{-- Description --}}
                        <div class="col-12">
                            <label class="form-label">Description</label>
                            <textarea name="description" rows="4" class="form-control">{{ old('description', $course->description) }}</textarea>
                        </div>

                        {{-- Image --}}
                        <div class="col-md-6">
                            <label class="form-label">Image</label>
                            <input type="file" name="image" class="form-control">

                            @if ($course->image)
                                <img src="{{ asset('storage/' . $course->image) }}" class="mt-2 rounded" width="120">
                            @endif
                        </div>

                        {{-- Video --}}
                        <div class="col-md-6">
                            <label class="form-label">Introduction Video</label>
                            <input type="file" name="introduction_video" class="form-control">

                            @if ($course->introduction_video)
                                <video class="mt-2 w-100 rounded" controls style="max-height:200px;">
                                    <source src="{{ asset('storage/' . $course->introduction_video) }}" type="video/mp4">
                                </video>
                            @endif
                        </div>

                        {{-- Submit --}}
                        <div class="col-12 text-end mt-3">
                            <button class="btn btn-primary px-4">
                                Update Course
                            </button>
                        </div>

                    </div>

                </form>

            </div>
        </div>

    </div>

@endsection
