@extends('admin.dashbord.layouts')

@section('title', 'Branches - ' . $restaurant->title)

@section('content')

<x-alert />

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-0">Branches</h4>
        <p class="text-muted mb-0">{{ $restaurant->title }}</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.restaurants.show', $restaurant) }}"
           class="btn btn-secondary">
            <i class="bx bx-arrow-back"></i> Back to Restaurant
        </a>

        <a href="{{ route('admin.restaurants.branch.create', $restaurant) }}"
           class="btn btn-success">
            <i class="bx bx-plus"></i> Add New Branch
        </a>
    </div>
</div>

<!-- Restaurant Info Quick Card -->
<div class="card mb-4">
    <div class="card-body">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h5 class="mb-1">{{ $restaurant->title }}</h5>
            </div>
            <div class="col-md-4 text-md-end">
                <span class="badge bg-info fs-6">
                    {{ $restaurant->branches->count() }} Branches
                </span>
            </div>
        </div>
    </div>
</div>

<!-- Branches List -->
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">
            <i class="bx bx-building"></i>
            All Branches
            <span class="badge bg-primary rounded-pill">{{ $restaurant->branches->count() }}</span>
        </h5>
    </div>
    <div class="card-body">
        @if($restaurant->branches->isNotEmpty())
            <div class="row g-3">
                @foreach($restaurant->branches as $branch)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-info shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <h6 class="mb-0">Branch #{{ $loop->iteration }}</h6>
                                    <span class="badge bg-light text-dark">Active</span>
                                </div>

                                <div class="mb-3">
                                    <p class="mb-1">
                                        <i class="bx bx-phone"></i>
                                        <strong>Phone:</strong> {{ $branch->phone }}
                                    </p>
                                    <p class="mb-0">
                                        <i class="bx bx-map"></i>
                                        <strong>Address:</strong> {{ $branch->address }}
                                    </p>
                                </div>

                                <div class="d-flex gap-2 mt-3">
                                    <a href="{{ route('admin.restaurants.branch.edit', [$restaurant, $branch]) }}"
                                       class="btn btn-sm btn-warning flex-grow-1">
                                        <i class="bx bx-edit"></i> Edit
                                    </a>

                                    <form action="{{ route('admin.restaurants.branch.destroy', [$restaurant, $branch]) }}"
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger flex-grow-1"
                                                onclick="return confirm('Are you sure you want to delete this branch?')">
                                            <i class="bx bx-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <i class="bx bx-building-house fs-1 text-muted mb-3"></i>
                <h5 class="text-muted">No branches yet</h5>
                <p class="text-muted">Add your first branch using the button above.</p>
            </div>
        @endif
    </div>
</div>

@endsection
