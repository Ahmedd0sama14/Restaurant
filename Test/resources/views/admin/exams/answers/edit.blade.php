@extends('layouts.layouts')
@section('title', 'edit answer')
@section('content')
    <div class="container">
        <h1>Edit Answer</h1>
        <form action="{{ route('answers.update', [$exam->id, $question->id, $answer->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="question_id" value="{{ $question->id }}">
            <div class="mb-3">
                <label class="form-label">Answer</label>
                <input type="text" name="answer" class="form-control" value="{{ $answer->answer }}" required>
            </div>
            <button type="submit" class="btn btn-primary">
                Update Answer
            </button>
        </form>
    </div>
@endsection
