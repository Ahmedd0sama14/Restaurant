@extends('admin.dashbord.layouts')

@section('title', 'Restaurant Details - ' . $restaurant->title)

@section('content')

<x-alert />

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-0">{{ $restaurant->title }}</h4>
        <p class="text-muted mb-0">Restaurant Full Details</p>
    </div>

    <div class="d-flex gap-2">
        <a href="{{ route('admin.restaurants.branch.index', $restaurant) }}"
           class="btn btn-outline-primary">
            <i class="bx bx-building"></i> View Branches
        </a>

        <a href="{{ route('admin.restaurants.menu.index', $restaurant) }}"
           class="btn btn-outline-success">
            <i class="bx bx-food-menu"></i> View Menus
        </a>

        <a href="{{ route('admin.restaurants.edit', $restaurant) }}"
           class="btn btn-warning">
            <i class="bx bx-edit"></i> Edit
        </a>

        <a href="{{ route('admin.restaurants.index') }}"
           class="btn btn-secondary">
            <i class="bx bx-arrow-back"></i> Back
        </a>
    </div>
</div>

<!-- Stats Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-primary h-100">
            <div class="card-body text-center">
                <i class="bx bx-image fs-1 text-primary mb-2"></i>
                <h3 class="mb-0">{{ $restaurant->images->count() }}</h3>
                <p class="text-muted mb-0">Images</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-info h-100">
            <div class="card-body text-center">
                <i class="bx bx-building fs-1 text-info mb-2"></i>
                <h3 class="mb-0">{{ $restaurant->branches->count() }}</h3>
                <p class="text-muted mb-0">Branches</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-success h-100">
            <div class="card-body text-center">
                <i class="bx bx-food-menu fs-1 text-success mb-2"></i>
                <h3 class="mb-0">{{ $restaurant->menus->count() }}</h3>
                <p class="text-muted mb-0">Menu Items</p>
            </div>
        </div>
    </div>
</div>

<!-- Basic Information -->
<div class="card mb-4">
    <div class="card-header bg-light">
        <h5 class="mb-0"><i class="bx bx-info-circle"></i> Basic Information</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="fw-bold text-muted">Title</label>
                <p class="mb-0 fs-5">{{ $restaurant->title }}</p>
            </div>
            <div class="col-md-6 mb-3">
                <label class="fw-bold text-muted">Email</label>
                <p class="mb-0">{{ $restaurant->email ?? 'Not provided' }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Restaurant Images -->
<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">
            <i class="bx bx-images"></i>
            Restaurant Images
            <span class="badge bg-primary rounded-pill">{{ $restaurant->images->count() }}</span>
        </h5>
    </div>
    <div class="card-body">
        @if($restaurant->images->isNotEmpty())
            <div class="row g-3">
                @foreach($restaurant->images as $image)
                    <div class="col-md-4 col-lg-3">
                        <div class="card h-100 shadow-sm overflow-hidden">
                            <img src="{{ Storage::url($image->image_path) }}"
                                 class="card-img-top"
                                 style="height: 220px; object-fit: cover;"
                                 alt="Restaurant Image">
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5 text-muted">
                <i class="bx bx-image-alt fs-1 mb-3"></i>
                <p>No images available</p>
            </div>
        @endif
    </div>
</div>

<!-- Branches -->
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="bx bx-building"></i>
            Branches
            <span class="badge bg-info rounded-pill">{{ $restaurant->branches->count() }}</span>
        </h5>
        <a href="{{ route('admin.restaurants.branch.create', $restaurant) }}"
           class="btn btn-success btn-sm">
            <i class="bx bx-plus"></i> Add Branch
        </a>
    </div>
    <div class="card-body">
        @forelse($restaurant->branches as $branch)
            <div class="card border-info mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="mb-2">Branch #{{ $loop->iteration }}</h6>
                            <p class="mb-1"><strong>Phone:</strong> {{ $branch->phone }}</p>
                            <p class="mb-0"><strong>Address:</strong> {{ $branch->address }}</p>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.restaurants.branch.edit', [$restaurant, $branch]) }}"
                               class="btn btn-sm btn-warning">
                                <i class="bx bx-edit"></i>
                            </a>
                            <form action="{{ route('admin.restaurants.branch.destroy', [$restaurant, $branch]) }}"
                                  method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this branch?')">
                                    <i class="bx bx-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-5 text-muted">
                <i class="bx bx-building-house fs-1 mb-3"></i>
                <p>No branches added yet.</p>
            </div>
        @endforelse
    </div>
</div>

<!-- Menu Items -->
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="bx bx-food-menu"></i>
            Menu Items
            <span class="badge bg-success rounded-pill">{{ $restaurant->menus->count() }}</span>
        </h5>
        <a href="{{ route('admin.restaurants.menu.create', $restaurant) }}"
           class="btn btn-success btn-sm">
            <i class="bx bx-plus"></i> Add Menu Item
        </a>
    </div>
    <div class="card-body">
        @if($restaurant->menus->isNotEmpty())
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Item</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($restaurant->menus as $menu)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="fw-medium">{{ $menu->item }}</td>
                                <td class="fw-bold text-success">
                                    {{ number_format($menu->price, 2) }} EGP
                                </td>
                                <td>
                                    @if($menu->image)
                                        <img src="{{ Storage::url($menu->image) }}"
                                             width="55" height="55"
                                             class="rounded border"
                                             style="object-fit: cover;"
                                             alt="{{ $menu->item }}">
                                    @else
                                        <span class="text-muted small">No image</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <div class="d-flex gap-2 justify-content-end">
                                        <a href="{{ route('admin.restaurants.menu.edit', [$restaurant, $menu]) }}"
                                           class="btn btn-sm btn-warning">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.restaurants.menu.destroy', [$restaurant, $menu]) }}"
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this item?')">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-5 text-muted">
                <i class="bx bx-food-menu fs-1 mb-3"></i>
                <p>No menu items added yet.</p>
            </div>
        @endif
    </div>
</div>

@endsection
