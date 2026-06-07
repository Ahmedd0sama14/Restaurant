@extends('layouts.layouts')

@section('title', 'Exam Result')

@section('content')

<div class="container">

    <h2>Exam Result</h2>

    <p>
        <strong>User:</strong> {{ $studentExam->user->name }} <br>
        <strong>Exam:</strong> {{ $studentExam->exam->title }} <br>
        <strong>Grade:</strong> {{ $studentExam->grade }}
    </p>

    <hr>

    @foreach($studentExam->answers as $answer)

        <div class="card mb-3">
            <div class="card-header">
                <strong>Question:</strong> {{ $answer->question->title }}
            </div>

            <div class="card-body">

                @foreach($answer->question->answers as $option)

                    <div class="p-2 mb-2 border rounded

                        {{-- اختيار الطالب --}}
                        @if($option->id == $answer->question_answer_id)
                            bg-warning
                        @endif

                        {{-- الإجابة الصحيحة --}}
                        @if($option->is_correct)
                            border-success
                        @endif
                    ">

                        {{ $option->answer }}

                        {{-- labels --}}
                        @if($option->id == $answer->question_answer_id)
                            <span class="badge bg-primary">Your Answer</span>
                        @endif

                        @if($option->is_correct)
                            <span class="badge bg-success">Correct Answer</span>
                        @endif

                    </div>

                @endforeach

            </div>
        </div>

    @endforeach

</div>

@endsection
