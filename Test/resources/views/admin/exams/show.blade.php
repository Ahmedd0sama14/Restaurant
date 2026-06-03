@extends('layouts.layouts')

@section('title', 'Show Exam')

@section('content')
    <h1>Show Exam</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $exam->title }}</h5>
            <p class="card-text">
                <img src="{{ Storage::url($exam->image) }}" alt="{{ $exam->title }}" class="img-fluid">
            </p>
            <p class="card-text">
                <strong>Active:</strong> {{ $exam->is_active ? 'Yes' : 'No' }}
            </p>
        </div>
    </div>
@endsection
