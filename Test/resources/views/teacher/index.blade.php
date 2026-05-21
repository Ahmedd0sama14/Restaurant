@extends('layouts.layouts')
@title('Teachers List')
@section('content')
    <x-alert type="success" />
    <x-alert type="error" />
    <div class="container mt-5">
        <h1>Teachers List</h1>
        <a href="{{ route('teachers.create') }}" class="btn btn-primary mb-3">Add New Teacher</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($teachers as $teacher)
                    <tr>
                        <td>{{ $teacher->id }}</td>
                        <td>{{ $teacher->name }}</td>
                        <td>{{ $teacher->email }}</td>
                        <td>{{ $teacher->phone }}</td>
                        <td>
                            <a href="{{ route('teachers.show', $teacher) }}" class="btn btn-info">View</a>
                            <a href="{{ route('teachers.edit', $teacher) }}" class="btn btn-warning">Edit</a>

                            <form action="{{ route('teachers.destroy', $teacher) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $teachers->links('pagination::bootstrap-5') }}
    </div>
@endsection
