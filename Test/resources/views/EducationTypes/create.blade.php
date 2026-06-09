@extends('layouts.layouts')
@section('title', 'Create Education Type')
@section('content')
    <h1>Create Education Type</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('education-types.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Type</label>
            <select name="type" class="form-control">
                <option value="">Select Type</option>
                <option value="1">Basic Education</option>
                <option value="2">University Education</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">English Title</label>
            <input type="text" class="form-control" name="en[title]" value="{{ old('en.title') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Arabic Title</label>
            <input type="text" class="form-control" name="ar[title]" value="{{ old('ar.title') }}">
        </div>

        <button type="submit" class="btn btn-primary">
            Create
        </button>
    </form>
@endsection
