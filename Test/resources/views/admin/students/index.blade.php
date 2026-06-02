
@extends('layouts.layouts')

@section('title', 'Students List')

@section('content')

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Students Management</h2>

        <a href="{{ route('students.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i>
            Add Student
        </a>
    </div>

    <div class="row mb-4">

        <div class="col-md-4">
            <div class="card bg-primary text-white shadow border-0">
                <div class="card-body">
                    <h6>Total Students</h6>
                    <h2>{{ $students_count }}</h2>
                </div>
            </div>
        </div>

    </div>

    <div class="card shadow border-0">

        <div class="card-header bg-white">
            <h5 class="mb-0">Students List</h5>
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Course</th>
                            <th width="220">Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($students as $student)

                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    <strong>{{ $student->name }}</strong>
                                </td>

                                <td>{{ $student->email }}</td>

                                <td>
                                    <span class="badge bg-info">
                                        {{ $student->course?->name ?? 'N/A' }}
                                    </span>
                                </td>

                                <td>

                                    <a href="{{ route('students.show', $student) }}"
                                        class="btn btn-info btn-sm">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <a href="{{ route('students.edit', $student) }}"
                                        class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <form action="{{ route('students.destroy', $student) }}"
                                        method="POST"
                                        class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this student?')">
                                            <i class="bi bi-trash"></i>
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    No students found
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-3">
                {{ $students->links('pagination::bootstrap-5') }}
            </div>

        </div>

    </div>

</div>

@endsection
