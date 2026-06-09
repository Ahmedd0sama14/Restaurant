@extends('layouts.layouts')

@section('title', 'Student Exam')

@section('content')
    <div class="container mt-4">

        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between">
                <h4>{{ $studentExam->exam->title }}</h4>

                <span class="badge bg-primary">
                    Total Exam Grade:
                   {{  $studentExam->exam->questions->sum('degree')}}
                </span>
                <span class="badge bg-primary">
                    Total user Grade:
                   {{  $studentExam->grade}}
                </span>
            </div>
        </div>

        @foreach ($studentExam->answers as $studentAnswer)
            <div class="card mb-4">

                <div class="card-header">
                    <strong>{{ $studentAnswer->question->title }}</strong>

                    <span class="float-end">
                        Degree:
                        {{ $studentAnswer->question->degree }}
                    </span>
                </div>

                <div class="card-body">

                    @foreach ($studentAnswer->question->answers as $option)
                        @php
                            $isCorrect = $option->is_correct;
                            $isStudentAnswer = $option->id == $studentAnswer->question_answer_id;
                        @endphp

                        <div
                            class="border rounded p-2 mb-2
                        @if ($isCorrect) border-success bg-light @endif
                    ">

                            <input type="radio" disabled @checked($isStudentAnswer)>

                            {{ $option->answer }}

                            @if ($isCorrect)
                                <span class="badge bg-success">
                                    Correct Answer
                                </span>
                            @endif

                            @if ($isStudentAnswer)
                                <span class="badge bg-primary">
                                    Student Answer
                                </span>
                            @endif

                        </div>
                    @endforeach

                    <hr>

                    <div>
                        @if ($studentAnswer->is_correct)
                            <span class="badge bg-success">
                                Correct
                            </span>
                        @else
                            <span class="badge bg-danger">
                                Wrong
                            </span>
                        @endif

                        <span class="badge bg-secondary">
                            Score: {{ $studentAnswer->grade }}
                        </span>
                    </div>

                </div>
            </div>
        @endforeach

    </div>
@endsection
