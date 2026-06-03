@extends('layouts.layouts')
@section('title', 'Edit Exam')
@section('content')
    <h1>Edit Exam</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('exams.update', ['exam' => $exam]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $exam->title) }}"
                required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image">
            @if ($exam->image)
                <img src="{{ asset('storage/' . $exam->image) }}" alt="{{ $exam->title }}" width="100" class="mt-2">
            @endif
        </div>

        <div class="form-check mb-3">
            <input type="hidden" name="is_active" value="0">

            <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1"
                {{ old('is_active', $exam->is_active) ? 'checked' : '' }}>

            <label class="form-check-label" for="is_active">
                Active
            </label>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
