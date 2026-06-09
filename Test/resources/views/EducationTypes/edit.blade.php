@extends('layouts.layouts')

@section('title', 'Edit Education Type')

@section('content')

<h1>Edit Education Type</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('education-types.update', $education_type) }}" method="POST">
    @csrf
    @method('PUT')

    {{-- Type --}}
    <div class="mb-3">
        <label class="form-label">Type</label>
        <select name="type" class="form-control">
            <option value="1" {{ $education_type->type->value == 1 ? 'selected' : '' }}>
                Basic Education
            </option>

            <option value="2" {{ $education_type->type->value == 2 ? 'selected' : '' }}>
                University Education
            </option>
        </select>
    </div>

    {{-- English Title --}}
    <div class="mb-3">
        <label class="form-label">English Title</label>
        <input type="text"
               class="form-control"
               name="en[title]"
               value="{{ old('en.title', $education_type->translate('en')?->title) }}">
    </div>

    {{-- Arabic Title --}}
    <div class="mb-3">
        <label class="form-label">Arabic Title</label>
        <input type="text"
               class="form-control"
               name="ar[title]"
               value="{{ old('ar.title', $education_type->translate('ar')?->title) }}">
    </div>

    <button type="submit" class="btn btn-primary">
        Update
    </button>
</form>

@endsection
