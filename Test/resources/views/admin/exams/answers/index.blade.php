@extends('layouts.layouts')

@section('title', 'Answers Management')
@section('content')
    <a href="{{ route('answers.create', [$exam->id, $question->id]) }}" class="btn btn-primary btn-sm">
        + Add Answer
    </a>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="mb-0">Answers</h4>
                <small class="text-muted">
                    Exam: <strong>{{ $exam->title ?? '---' }}</strong> |
                    Question: <strong>{{ $question->title ?? '---' }}</strong>
                </small>
            </div>

            <a href="{{ route('questions.index', $exam->id) }}" class="btn btn-secondary btn-sm">
                ← Back to Questions
            </a>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-header bg-dark text-white">
                <strong>Answers List</strong>
            </div>

            <div class="card-body p-0">

                @if ($answers->count() > 0)
                    <table class="table table-hover mb-0 text-center align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Answer</th>
                                <th>Is Correct</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($answers as $answer)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td class="text-start">
                                        {{ $answer->answer }}
                                    </td>

                                    <td>
                                        @if ($answer->is_correct)
                                            <span class="badge bg-success">Correct</span>
                                        @else
                                            <span class="badge bg-danger">Wrong</span>
                                        @endif
                                    </td>

                                    <td>
                                        <a href="{{ route('answers.edit', [$exam, $question, $answer]) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('answers.destroy', [$exam, $question, $answer]) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm"
                                                onclick="return confirm('Delete this answer?')">
                                                Delete
                                            </button>
                                        </form>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-center p-4 text-muted">
                        No answers found for this question.
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
