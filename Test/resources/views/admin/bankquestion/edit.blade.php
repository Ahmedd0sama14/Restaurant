@extends('layouts.layouts')

@section('title', 'Edit Question')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Edit Question</h3>
        </div>

        <div class="card-body">

            <form action="{{ route('bank-questions.update', $question->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Exam --}}
                <div class="mb-3">
                    <label>Exam (Optional)</label>

                    <select name="exam_id" class="form-control">
                        <option value="">Without Exam</option>

                        @foreach($exams as $exam)
                            <option value="{{ $exam->id }}"
                                {{ old('exam_id', $question->exam_id) == $exam->id ? 'selected' : '' }}>
                                {{ $exam->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Title --}}
                <div class="mb-3">
                    <label>Question Title</label>
                    <input type="text" name="title" class="form-control"
                           value="{{ old('title', $question->title) }}">
                </div>

                {{-- Degree --}}
                <div class="mb-3">
                    <label>Degree</label>
                    <input type="number" name="degree" class="form-control"
                           value="{{ old('degree', $question->degree) }}">
                </div>

                <hr>

                <h5>Answers</h5>

                <div id="answers-wrapper">

                    @foreach($question->answers->values() as $index => $answer)
                        <div class="answer-item mb-2 d-flex gap-2 align-items-center">

                            <input type="text"
                                   name="answers[{{ $index }}]"
                                   class="form-control"
                                   value="{{ $answer->answer }}">

                            <input type="radio"
                                   name="correct_answer"
                                   value="{{ $index }}"
                                   {{ $answer->is_correct ? 'checked' : '' }}>

                            <button type="button" class="btn btn-danger btn-sm remove-answer">
                                X
                            </button>
                        </div>
                    @endforeach

                </div>

                <button type="button" id="add-answer" class="btn btn-success btn-sm mt-2">
                    + Add Answer
                </button>

                <br><br>

                <button type="submit" class="btn btn-primary">
                    Update Question
                </button>

            </form>

        </div>
    </div>
</div>

{{-- JS --}}
<script>
let index = {{ $question->answers->count() }};

// Add answer
document.getElementById('add-answer').addEventListener('click', function () {

    let wrapper = document.getElementById('answers-wrapper');

    let html = `
        <div class="answer-item mb-2 d-flex gap-2 align-items-center">

            <input type="text" name="answers[${index}]" class="form-control">

            <input type="radio" name="correct_answer" value="${index}">

            <button type="button" class="btn btn-danger btn-sm remove-answer">X</button>
        </div>
    `;

    wrapper.insertAdjacentHTML('beforeend', html);

    index++;
});

// Remove answer
document.addEventListener('click', function (e) {
    if (e.target.classList.contains('remove-answer')) {
        e.target.closest('.answer-item').remove();
    }
});
</script>

@endsection
