@extends('layouts.layouts')
@section('title', 'Create Course')
@section('content')
    <h1>Create Course</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" name="price" id="price" class="form-control" value="{{ old('price') }}"
                step="0.01">
        </div>
        <div class="mb-3">
            <label for="discount" class="form-label">Discount </label>
            <input type="number" name="discount" id="discount" class="form-control" value="{{ old('discount') }}"
                step="0.01">
        </div>
        <select name="discount_type" class="form-control">
            @foreach ($discountTypes as $type)
                <option value="{{ $type->value }}" @selected(old('discount_type') == $type->value)>
                    {{ $type->name }}
                </option>
            @endforeach
        </select>

        <div class="mb-3">
            <label for="duration" class="form-label">Duration</label>
            <input type="number" name="duration" id="duration" class="form-control" value="{{ old('duration') }}">
        </div>
        <select name="duration_type" id="duration_type" class="form-control">
            @foreach ($durationTypes as $type)
                <option value="{{ $type->value }}" @selected(old('duration_type') == $type->value)>
                    {{ $type->name }}
                </option>
            @endforeach
        </select>
        <div class="mb-3">
            <label for="teacher_id" class="form-label">Teacher</label>
            <select name="teacher_id" id="teacher_id" class="form-control">
                @foreach ($teachers as $teacher)
                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="course_type_id" class="form-label">Course Type</label>
            <select name="course_type_id" id="course_type_id" class="form-control">
                @foreach ($courseTypes as $courseType)
                    <option value="{{ $courseType->id }}">{{ $courseType->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Course Image</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>
        <div class="mb-3">
            <label for="video" class="form-label">Course Video</label>
            <input type="file" name="introduction_video" id="video" class="form-control" accept="video/*">
        </div>


        <!-- Add other fields similarly -->

        <button type="submit" class="btn btn-primary">Create Course</button>
    </form>
@endsection
