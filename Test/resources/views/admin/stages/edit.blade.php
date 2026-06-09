@extends('layouts.layouts')

@section('title', 'Edit Stage')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Edit Stage</h3>
            </div>
            <div class="card-body">

                <form action="{{ route('EducationTypes.Stages.update', [$EducationType, $Stage]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="education_type_id" value="{{ $EducationType->id }}">

                    {{-- Title EN --}}
                    <div class="mb-3">
                        <label class="form-label">Title (EN)</label>
                        <input type="text" name="en[title]" class="form-control"
                               value="{{ old('en.title', $Stage->translate('en')?->title ?? '') }}" required>
                    </div>

                    {{-- Title AR --}}
                    <div class="mb-3">
                        <label class="form-label">Title (AR)</label>
                        <input type="text" name="ar[title]" class="form-control"
                               value="{{ old('ar.title', $Stage->translate('ar')?->title ?? '') }}" required>
                    </div>

                    {{-- Stage Type --}}
                    <div class="mb-3">
                        <label class="form-label">Stage Type</label>
                        <input type="text" class="form-control bg-light"
                               value="{{ $Stage->type->label() }}" readonly>
                        <input type="hidden" name="type" value="{{ $Stage->type->value }}">
                    </div>

                    @if ($Stage->parent)
                        <div class="mb-3">
                            <label class="form-label">Parent Stage</label>
                            <input type="text" class="form-control bg-light"
                                   value="{{ $Stage->parent->title ?? 'بدون أب' }}" readonly>
                            <input type="hidden" name="parent_id" value="{{ $Stage->parent_id }}">
                        </div>
                    @endif

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Update Stage</button>
                        <a href="{{ route('EducationTypes.Stages.show', [$EducationType, $Stage]) }}"
                           class="btn btn-secondary">Cancel</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
