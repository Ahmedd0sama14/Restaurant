@extends('layouts.layouts')

@section('title', 'Stage Details')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <h1 class="fw-bold text-primary">
        Stage Details
    </h1>

    <div class="d-flex gap-2">

        <a href="{{ route('EducationTypes.Stages.index', [
            'EducationType' => $Stage->educationType
        ]) }}"
           class="btn btn-primary rounded-pill px-4">
            Back
        </a>

        {{-- الزر المعدل --}}
        @if ($next)
            <a href="{{ route('EducationTypes.Stages.create', [
                'EducationType' => $Stage->educationType,
                'parent_id' => $Stage->id,
            ]) }}"
               class="btn btn-success rounded-pill px-4">
                Add Child Stage
            </a>
        @endif

        <a href="{{ route('EducationTypes.Stages.edit', [
            'EducationType' => $Stage->educationType,
            'Stage' => $Stage,
        ]) }}"
           class="btn btn-warning rounded-pill px-4">
            Edit
        </a>

        <form action="{{ route('EducationTypes.Stages.destroy', [
                'EducationType' => $Stage->educationType,
                'Stage' => $Stage,
            ]) }}"
              method="POST"
              onsubmit="return confirm('Are you sure you want to delete this stage?')">

            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-danger rounded-pill px-4">
                Delete
            </button>
        </form>

    </div>

</div>

<div class="card mb-4">

    <div class="card-header">
        <h3 class="mb-0">Stage Information</h3>
    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-6 mb-3">
                <strong>Name:</strong>
                <br>
                {{ $Stage->title }}
            </div>

            <div class="col-md-6 mb-3">
                <strong>Type:</strong>
                <br>
                {{ $Stage->type->label() }}
            </div>

            @if ($Stage->parent)
                <div class="col-md-6 mb-3">
                    <strong>Parent Stage:</strong>
                    <br>
                    <a href="{{ route('EducationTypes.Stages.show', [
                        'EducationType' => $Stage->educationType,
                        'Stage' => $Stage->parent,
                    ]) }}">
                        {{ $Stage->parent->title }}
                    </a>
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Parent Type:</strong>
                    <br>
                    {{ $Stage->parent->type->label() }}
                </div>
            @endif

            <div class="col-md-6 mb-3">
                <strong>Children Count:</strong>
                <br>
                {{ $Stage->children->count() }}
            </div>

        </div>

    </div>

</div>

<div class="card">

    <div class="card-header">
        <h3 class="mb-0">
            Child Stages
            <span class="badge bg-primary">
                {{ $Stage->children->count() }}
            </span>
        </h3>
    </div>

    <div class="card-body">

        @if($Stage->children->count())

            <div class="list-group">

                @foreach ($Stage->children as $childStage)

                    <a href="{{ route('EducationTypes.Stages.show', [
                        'EducationType' => $Stage->educationType,
                        'Stage' => $childStage,
                    ]) }}"
                       class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">

                        <div>
                            <strong>{{ $childStage->title }}</strong>
                            <br>
                            <small class="text-muted">
                                {{ $childStage->type->label() }}
                            </small>
                        </div>

                        <span class="badge bg-secondary">
                            View
                        </span>

                    </a>

                @endforeach

            </div>

        @else

            <div class="alert alert-info mb-0">
                No child stages found.
            </div>

        @endif

    </div>

</div>

@endsection
