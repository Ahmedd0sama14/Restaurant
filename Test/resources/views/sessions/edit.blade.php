@extends('layouts.layouts')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header">
            <h4>Edit Session</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('sessions.update', ['session' => $session]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Course --}}
                <div class="mb-3">
                    <label class="form-label">Course</label>

                    <select name="course_id" class="form-control">
                        <option value="">Select Course</option>

                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}"
                                {{ $session->course_id == $course->id ? 'selected' : '' }}>
                                {{ $course->title }}
                            </option>
                        @endforeach
                    </select>

                    @error('course_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Session Type --}}
                <div class="mb-3">
                    <label class="form-label">Session Type</label>

                    <select name="session_type" class="form-control">
                        <option value="">Select Type</option>

                        @foreach ($sessionsTypes as $type)
                            <option value="{{ $type->value }}"
                                {{ $session->session_type->value == $type->value ? 'selected' : '' }}>
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('session_type')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Current File --}}
                @if($session->file)
                    <div class="mb-3">
                        <label class="form-label d-block">Current File</label>

                        <a href="{{ asset('storage/' . $session->file) }}"
                           target="_blank"
                           class="btn btn-sm btn-info">
                            View File
                        </a>
                    </div>
                @endif

                {{-- Upload New File --}}
                <div class="mb-3">
                    <label class="form-label">Upload New File</label>

                    <input type="file" name="file" class="form-control">

                    @error('file')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn btn-primary">
                    Update Session
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
