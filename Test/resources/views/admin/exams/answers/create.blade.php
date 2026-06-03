@extends('layouts.layouts')

@section('title', 'Add Answer')

@section('content')
<div class="container">
    <h1 class="mb-4">Add Answer to Question: {{ $question->title }}</h1>

    <form action="{{ route('answers.store', [$exam, $question]) }}" method="POST">
        @csrf

        <input type="hidden" name="question_id" value="{{ $question->id }}">

        <div class="mb-3">
            <label class="form-label">Answer Text</label>
            <input
                type="text"
                name="answer"
                class="form-control"
                required
            >
        </div>

        <div class="mb-3 form-check">
            <input
                type="checkbox"
                name="is_correct"
                value="1"
                class="form-check-input"
                id="is_correct"
            >
            <label class="form-check-label" for="is_correct">
                This is the correct answer
            </label>
        </div>

        <button type="submit" class="btn btn-primary">
            Add Answer
        </button>
    </form>
</div>
@endsection
