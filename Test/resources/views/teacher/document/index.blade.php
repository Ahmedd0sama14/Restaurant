@extends('layouts.layouts')

@section('title', 'Documents')

@section('content')
    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Those are your documents for {{ $teacher->name }}</h2>
            <a href="{{ route('documents.create', ['teacher' => $teacher]) }}" class="btn btn-primary">
                Create Document
            </a>
        </div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>File</th>
                    <th>Price</th>
                    <th width="200">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($documents as $document)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $document->name }}</td>
                        <td>
                            <a href="{{ asset('storage/' . $document->path) }}" target="_blank"
                                class="btn btn-secondary btn-sm">
                                View File
                            </a>
                        </td>
                        <td>{{ $document->price }}</td>


                        <td>
                            <a href="{{ route('documents.edit', [
                                'teacher' => $teacher,
                                'document' => $document,
                            ]) }}"
                                class="btn btn-info btn-sm">
                                Edit
                            </a>

                            <form
                                action="{{ route('documents.destroy', [
                                    'teacher' => $teacher,
                                    'document' => $document,
                                ]) }}"
                                method="POST" style="display:inline-block">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">
                            No Documents Found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {{ $documents->links('pagination::bootstrap-5') }}
        </div>

    </div>
@endsection
