@extends('layouts.layouts')

@section('title', 'Edit Question')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Question</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('questions.update', [$exam->id, $question->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Question Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $question->title) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Degree</label>
            <input type="number" name="degree" class="form-control" value="{{ old('degree', $question->degree) }}" required>
        </div>

        <hr>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Answers</h4>
            <button type="button" class="btn btn-success" id="add-answer">
                + Add Answer
            </button>
        </div>

        <div id="answers-container">
            @foreach ($question->answers as $index => $answer)
                <div class="answer-item card p-3 mb-3">
                    <div class="row align-items-center">
                        <div class="col-md-1 text-center">
                            <input
                                type="radio"
                                name="correct_answer"
                                value="{{ $index }}"
                                {{ $answer->is_correct ? 'checked' : '' }}
                                class="form-check-input"
                            >
                        </div>
                        <div class="col-md-9">
                            <input
                                type="text"
                                name="answers[]"
                                class="form-control"
                                value="{{ old('answers.' . $index, $answer->answer) }}"
                                required
                            >
                        </div>
                        <div class="col-md-2 text-end">
                            <button type="button" class="btn btn-danger remove-answer">X</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update Question</button>
    </form>
</div>

<script>
    let answerIndex = {{ $question->answers->count() }};   // نبدأ من بعد آخر إجابة موجودة

    // إضافة إجابة جديدة
    document.getElementById('add-answer').addEventListener('click', function () {
        let container = document.getElementById('answers-container');

        let html = `
            <div class="answer-item card p-3 mb-3">
                <div class="row align-items-center">
                    <div class="col-md-1 text-center">
                        <input
                            type="radio"
                            name="correct_answer"
                            value="${answerIndex}"
                            class="form-check-input"
                        >
                    </div>
                    <div class="col-md-9">
                        <input
                            type="text"
                            name="answers[]"
                            class="form-control"
                            placeholder="Enter new answer"
                            required
                        >
                    </div>
                    <div class="col-md-2 text-end">
                        <button type="button" class="btn btn-danger remove-answer">X</button>
                    </div>
                </div>
            </div>
        `;

        container.insertAdjacentHTML('beforeend', html);
        answerIndex++;
    });

    // حذف إجابة
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-answer')) {
            e.target.closest('.answer-item').remove();
        }
    });
</script>

@endsection
