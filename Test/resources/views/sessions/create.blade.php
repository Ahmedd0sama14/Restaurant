@extends('layouts.layouts')

@section('title', 'Insert Session')

@section('content')

    <div class="container py-5">

        <div class="row justify-content-center">
            <div class="col-lg-7">

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                    {{-- Header --}}
                    <div class="bg-primary text-white p-4">
                        <h2 class="fw-bold mb-1">
                            Create New Session
                        </h2>

                        <p class="mb-0 opacity-75">
                            Add a new course session with file upload
                        </p>
                    </div>

                    {{-- Body --}}
                    <div class="card-body p-5">

                        {{-- Validation Errors --}}
                        @if ($errors->any())
                            <div class="alert alert-danger rounded-3">

                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>

                            </div>
                        @endif

                        <form action="{{ route('sessions.store') }}" method="POST" enctype="multipart/form-data">

                            @csrf

                            {{-- Course --}}
                            <div class="mb-4">

                                <label for="course_id" class="form-label fw-semibold text-dark">
                                    Course
                                </label>

                                <select name="course_id" id="course_id" class="form-select form-select-lg rounded-3"
                                    required>
                                    <option value="">
                                        -- Select Course --
                                    </option>

                                    @foreach ($courses as $course)
                                        <option value="{{ $course->id }}"
                                            {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                            {{ $course->title }}
                                        </option>
                                    @endforeach

                                </select>

                            </div>

                            {{-- Session Type --}}
                            <div class="mb-4">

                                <label for="session_type" class="form-label fw-semibold">
                                    Session Type
                                </label>

                                <select name="session_type" id="session_type" class="form-select rounded-3" required>
                                    <option value="">-- Select Type --</option>
                                    @foreach ($sessionsTypes as $type)
                                        <option value="{{ $type->value }}" @selected(old('session_type') == $type->value)>
                                            {{ $type->name }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>

                            {{-- File Upload --}}
                            <div class="mb-4">

                                <label for="file" class="form-label fw-semibold text-dark">
                                    Upload File
                                </label>

                                <input type="file" id="file" name="file"
                                    class="form-control form-control-lg rounded-3" required>

                                <small class="text-muted">
                                    Allowed: mp4, mov, avi, wmv, mp3
                                </small>

                            </div>

                            {{-- Buttons --}}
                            <div class="d-flex gap-3">

                                <button type="submit" class="btn btn-primary flex-fill rounded-pill py-3 fw-bold">
                                    Create Session
                                </button>

                                <a href="{{ route('sessions.index') }}"
                                    class="btn btn-outline-secondary flex-fill rounded-pill py-3 fw-bold">
                                    Cancel
                                </a>

                            </div>

                        </form>

                    </div>

                </div>

            </div>
        </div>

    </div>

@endsection
