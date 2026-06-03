@extends('layouts.layouts')

@section('title', 'Exam Questions')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>{{ $exam->title }}</h1>

        <a href="{{ route('questions.create', $exam) }}"
            class="btn btn-primary">
            Add New Question
        </a>
    </div>

    @forelse($questions as $question)

        <div class="card shadow-sm mb-4">

            <div class="card-header d-flex justify-content-between align-items-center">

                <h5 class="mb-0">
                    Question {{ $loop->iteration }}
                </h5>

                <span class="badge bg-primary">
                    {{ $question->degree }} Marks
                </span>

            </div>

            <div class="card-body">

                <h4 class="fw-bold mb-3">
                    {{ $question->title }}
                </h4>

                <div class="mb-3">
                    <a href="{{ route('answers.create', [$exam->id, $question->id]) }}"
                        class="btn btn-success btn-sm">
                        + Add Answer
                    </a>
                </div>

                @if($question->answers->count())

                    <div class="list-group">

                        @foreach($question->answers as $answer)

                            <div
                                class="list-group-item d-flex justify-content-between align-items-center
                                {{ $answer->is_correct ? 'list-group-item-success border-success' : '' }}">

                                <div>

                                    @if($answer->is_correct)
                                        ✅
                                    @endif

                                    {{ $answer->answer }}

                                </div>

                                @if($answer->is_correct)
                                    <span class="badge bg-success">
                                        Correct Answer
                                    </span>
                                @endif

                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="alert alert-warning">
                        No answers found for this question.
                    </div>

                @endif

            </div>

            <div class="card-footer">

                <a href="{{ route('questions.edit', [$exam->id, $question->id]) }}"
                    class="btn btn-warning btn-sm">
                    Edit
                </a>

                <form action="{{ route('questions.destroy', [$exam->id, $question->id]) }}"
                    method="POST"
                    class="d-inline">

                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="btn btn-danger btn-sm"
                        onclick="return confirm('Are you sure?')">
                        Delete
                    </button>

                </form>

            </div>

        </div>

    @empty

        <div class="alert alert-info">
            No questions found.
        </div>

    @endforelse

    <div class="d-flex justify-content-center mt-4">
        {{ $questions->links('pagination::bootstrap-4') }}
    </div>

</div>
@endsection
