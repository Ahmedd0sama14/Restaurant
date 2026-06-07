@extends('layouts.layouts')

@section('title', 'Exam Questions')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Bank Questions</h2>

        <a href="{{ route('bank-questions.create') }}" class="btn btn-primary">
            + Add New Question
        </a>
    </div>

    @forelse($questions as $question)

        <div class="card shadow-sm mb-4">

            {{-- Header --}}
            <div class="card-header d-flex justify-content-between align-items-center">

                <h5 class="mb-0">
                    Question {{ $loop->iteration }}
                </h5>

                <span class="badge bg-primary">
                    {{ $question->degree }} Marks
                </span>

            </div>

            {{-- Body --}}
            <div class="card-body">

                <h4 class="fw-bold mb-3">
                    {{ $question->title }}
                </h4>

                @if($question->answers->count())

                    <div class="list-group">

                        @foreach($question->answers as $answer)

                            <div class="list-group-item d-flex justify-content-between align-items-center
                                {{ $answer->is_correct ? 'list-group-item-success' : '' }}">

                                <div>
                                    @if($answer->is_correct)
                                        <span class="me-1">✅</span>
                                    @endif

                                    {{ $answer->answer }}
                                </div>

                                @if($answer->is_correct)
                                    <span class="badge bg-success">
                                        Correct
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

            {{-- Footer (FIXED LOCATION) --}}
        <div class="card-footer d-flex gap-2">

    @if(!$question->exam_id)

        <a href="{{ route('bank-questions.edit', $question->id) }}"
           class="btn btn-warning btn-sm">
            Edit
        </a>

        <form action="{{ route('bank-questions.destroy', $question->id) }}"
              method="POST"
              onsubmit="return confirm('Are you sure you want to delete this question?')">

            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-danger btn-sm">
                Delete
            </button>

        </form>

    @else

        <span class="badge bg-danger">
            Locked (In Exam)
        </span>

    @endif

</div>

        </div>

    @empty

        <div class="alert alert-info">
            No questions found.
        </div>

    @endforelse

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $questions->links('pagination::bootstrap-4') }}
    </div>

</div>
@endsection
