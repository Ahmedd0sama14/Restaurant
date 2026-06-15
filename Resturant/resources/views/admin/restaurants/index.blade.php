@extends('admin.dashbord.layouts')

@section('title', 'Restaurants List')

@section('content')
<x-alert />
<div class="container-xxl py-4">

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
            <div>
                <h4 class="mb-1 fw-semibold">
                    <i class="bx bx-store text-primary"></i>
                    Restaurants
                </h4>
                <small class="text-muted">Manage all restaurants and their branches</small>
            </div>

            <a href="{{ route('admin.restaurants.create') }}"
               class="btn btn-primary d-flex align-items-center gap-2">
                <i class="bx bx-plus"></i>
                Create Restaurant
            </a>
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <table id="restaurantsTable" class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Restaurant</th>
                            <th>Hotline</th>
                            <th>Branches</th>
                            <th>Menu Items</th>
                            <th width="280">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($restaurants as $restaurant)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    @if($restaurant->images->first())
                                        <img src="{{ Storage::url($restaurant->images->first()->image_path) }}"
                                             class="rounded-circle border shadow-sm"
                                             width="55" height="55"
                                             style="object-fit: cover;"
                                             alt="{{ $restaurant->title }}">
                                    @else
                                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center"
                                             style="width:55px; height:55px;">
                                            <i class="bx bx-image fs-3 text-muted"></i>
                                        </div>
                                    @endif
                                </td>

                                <td>
                                    <strong>{{ $restaurant->title }}</strong>
                                </td>

                                <td>
                                    <span class="badge bg-primary">{{ $restaurant->hotline }}</span>
                                </td>

                                <td>
                                    <span class="badge bg-info">
                                        <a href="{{ route('admin.restaurants.branch.index', $restaurant) }}">
                                        {{ $restaurant->branches->count() }} Branches
                                    </span>
                                </td>

                                <td>
                                    <span class="badge bg-success">
                                        <a href="{{ route('admin.restaurants.menu.index', $restaurant) }}">
                                        {{ $restaurant->menus->count() }} Items
                                    </span>
                                </td>

                                <td>
                                    <div class="d-flex flex-wrap gap-1">
                                        <a href="{{ route('admin.restaurants.show', $restaurant) }}"
                                           class="btn btn-info btn-sm" title="View">
                                            <i class="bx bx-show"></i>
                                        </a>

                                        <a href="{{ route('admin.restaurants.edit', $restaurant) }}"
                                           class="btn btn-warning btn-sm" title="Edit">
                                            <i class="bx bx-edit"></i>
                                        </a>

                                        <a href="{{ route('admin.restaurants.branch.create', $restaurant) }}"
                                           class="btn btn-success btn-sm" title="Add Branch">
                                            <i class="bx bx-git-branch"></i>
                                        </a>

                                        <a href="{{ route('admin.restaurants.menu.create', $restaurant) }}"
                                           class="btn btn-primary btn-sm" title="Add Menu">
                                            <i class="bx bx-food-menu"></i>
                                        </a>

                                        <form action="{{ route('admin.restaurants.destroy', $restaurant) }}"
                                              method="POST" class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-danger btn-sm"
                                                    title="Delete">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <i class="bx bx-store-alt display-1 text-muted mb-3"></i>
                                    <h5 class="text-muted">No restaurants found</h5>
                                    <p class="text-muted mb-4">Start by creating your first restaurant</p>
                                    <a href="{{ route('admin.restaurants.create') }}"
                                       class="btn btn-primary">
                                        <i class="bx bx-plus"></i> Create First Restaurant
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

@endsection

@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">

<style>
    #restaurantsTable tbody tr {
        transition: all 0.2s ease;
    }
    #restaurantsTable tbody tr:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }
    .table td, .table th {
        vertical-align: middle;
    }
    .badge {
        font-size: 0.85rem;
        padding: 6px 10px;
    }
</style>
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

<script>

    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!confirm('Are you sure you want to delete this restaurant and all its data?')) {
                e.preventDefault();
            }
        });
    });
</script>
@endpush
