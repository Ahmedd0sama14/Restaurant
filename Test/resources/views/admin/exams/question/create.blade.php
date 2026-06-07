@extends('layouts.layouts')

@section('title', 'Add Question')

@section('content')

<div class="container">

    <h1 class="mb-4">
        Add Question To {{ $exam->title }}
    </h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('questions.store', $exam->id) }}" method="POST">

        @csrf

            <div class="mb-3">
                <label class="form-label">Question Title</label>

                <input
                    type="text"
                    name="title"
                    class="form-control"
                    required
                >
            </div>

            <div class="mb-3">
                <label class="form-label">Degree</label>

                <input
                    type="number"
                    name="degree"
                    class="form-control"
                    required
                >
            </div>

            <hr>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>Answers</h4>

                <button
                    type="button"
                    class="btn btn-success"
                    id="add-answer"
                >
                    + Add Answer
                </button>
            </div>

            <div id="answers-container">

                <div class="answer-item card p-3 mb-3">

                    <div class="row align-items-center">

                        <div class="col-md-1 text-center">

                            <input
                                type="radio"
                                name="correct_answer"
                                value="0"
                                class="form-check-input"
                                checked
                            >

                        </div>

                        <div class="col-md-9">

                            <input
                                type="text"
                                name="answers[]"
                                class="form-control"
                                placeholder="Enter answer"
                                required
                            >

                        </div>

                        <div class="col-md-2 text-end">

                            <button
                                type="button"
                                class="btn btn-danger remove-answer"
                            >
                                X
                            </button>

                        </div>

                    </div>

                </div>

            </div>

        <button type="submit" class="btn btn-primary">
            Save Question
        </button>

    </form>

</div>

<script>

    let answerIndex = 1;

    document
        .getElementById('add-answer')
        .addEventListener('click', function () {

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
                                placeholder="Enter answer"
                                required
                            >

                        </div>

                        <div class="col-md-2 text-end">

                            <button
                                type="button"
                                class="btn btn-danger remove-answer"
                            >
                                X
                            </button>

                        </div>

                    </div>

                </div>
            `;

            container.insertAdjacentHTML('beforeend', html);

            answerIndex++;
        });

    document.addEventListener('click', function (e) {

        if (e.target.classList.contains('remove-answer')) {

            e.target.closest('.answer-item').remove();
        }

    });

</script>

@endsection
