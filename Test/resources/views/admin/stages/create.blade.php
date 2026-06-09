@extends('layouts.layouts')

@section('title', 'Add Stage')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Add New Stage</h3>
            </div>

            <div class="card-body">

                <form action="{{ route('EducationTypes.Stages.store', $EducationType) }}" method="POST">
                    @csrf

                    <input type="hidden" name="education_type_id" value="{{ $EducationType->id }}">

                    {{-- EN Title --}}
                    <div class="mb-3">
                        <label class="form-label">Title (EN)</label>
                        <input type="text" name="en[title]" class="form-control @error('en.title') is-invalid @enderror"
                            value="{{ old('en.title') }}" required>
                        @error('en.title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- AR Title --}}
                    <div class="mb-3">
                        <label class="form-label">Title (AR)</label>
                        <input type="text" name="ar[title]" class="form-control @error('ar.title') is-invalid @enderror"
                            value="{{ old('ar.title') }}" required>
                        @error('ar.title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Stage Type --}}
                    @if (!empty($parentId) && $next)
                        {{-- تحت Parent --}}
                        <input type="hidden" name="parent_id" value="{{ $parentId }}">
                        <input type="hidden" name="type" value="{{ $next->value }}">

                        <div class="alert alert-info">
                            <strong>Parent Stage:</strong> {{ $parent->title ?? 'N/A' }}
                            <br>
                            <strong>New Stage Type:</strong> {{ $next->label() }}
                        </div>

                    @else
                        {{-- Root Stage (أول مرحلة) --}}
                        @php
                            $defaultType = null;
                            if ($EducationType->type->value == 1) { // PRIMARY
                                $defaultType = \App\Enums\Stages\StagesTypeEnum::PHASE;
                            } elseif ($EducationType->type->value == 2) { // ACADEMIC
                                $defaultType = \App\Enums\Stages\StagesTypeEnum::COLLEGE;
                            }
                        @endphp

                        <input type="hidden" name="type" value="{{ $defaultType?->value }}">

                        <div class="alert alert-info">
                            <strong>New Stage Type:</strong> {{ $defaultType?->label() ?? 'غير محدد' }}
                            <br>
                            <small class="text-muted">This is the starting type for this education level</small>
                        </div>
                    @endif

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Save Stage</button>
                        <a href="{{ route('EducationTypes.Stages.index', $EducationType) }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
