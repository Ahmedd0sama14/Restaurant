@extends('layouts.layouts')

@section('title', 'Headers')

@section('content')

    <x-alert type="success" />

    <h1>Headers</h1>

    <table class="table table-bordered">
        <tr>
            <th>Title</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>

        @forelse ($headers as $header)
            <tr>
                <td>{{ $header->title }}</td>

                <td>
                    <img src="{{ asset('storage/' . $header->image) }}" alt="{{ $header->title }}" width="100">
                </td>

                <td>
                    <a href="{{ route('headers.show', $header->id) }}" class="btn btn-primary">
                        View
                    </a>

                    <a href="{{ route('headers.edit', $header->id) }}" class="btn btn-info">
                        Edit
                    </a>

                    <form action="{{ route('headers.destroy', $header->id) }}" method="POST" style="display: inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3">No headers found.</td>
            </tr>
        @endforelse
    </table>
    <div class="mt-4 d-flex justify-content-center">
        {{ $headers->links('pagination::bootstrap-4') }}
    </div>

@endsection
