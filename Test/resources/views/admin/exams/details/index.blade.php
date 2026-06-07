@extends('layouts.layouts')

@section('title', 'Exam Details')

@section('content')
<div class="container mt-4">

    <h1 class="mb-4">Exam Details</h1>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Student Name</th>
                <th>Exam Title</th>
                <th>Score</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @forelse($studentExams as $studentExam)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $studentExam->user->name ?? 'N/A' }}</td>
                    <td>{{ $studentExam->exam->title ?? 'N/A' }}</td>
                    <td>{{ $studentExam->grade ?? 0 }}</td>
                    <td>{{ $studentExam->created_at->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('exams.userExams', ['user' => $studentExam->user, 'exam' => $studentExam->exam]) }}" class="btn btn-sm btn-info">View</a>

                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No exams found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
