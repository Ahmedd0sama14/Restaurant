@extends('layouts.layouts')

@section('title', 'Exams')

@section('content')
    <h1>Exams</h1>
    <a href="{{ route('exams.create') }}" class="btn btn-primary mb-3">Add New Exam</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Image</th>
                <th>Status</th>
                <th>questions</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($exams as $exam)
                <tr>
                    <td>{{ $exam->id }}</td>
                    <td>{{ $exam->title }}</td>
                    <td><img src="{{ asset('storage/' . $exam->image) }}" alt="{{ $exam->title }}" width="100"></td>
                    <td>{{ $exam->is_active ? 'Active' : 'Inactive' }}
                        <a href="{{ route('exams.toggle', ['exam' => $exam]) }}" class="btn btn-sm btn-{{ $exam->is_active ? 'danger' : 'success' }}">{{ $exam->is_active ? 'Inactive' : 'Active'  }}</a>
                    </td>
                    <td>
                        <a href="{{ route('questions.index', ['exam' => $exam]) }}" class="btn btn-sm btn-info">Manage Questions</a>
                    </td>
                    <td>
                        <a href="{{ route('exams.show', ['exam'=> $exam]) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('exams.edit', ['exam' => $exam]) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('exams.destroy', ['exam' => $exam]) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
@endsection
