@extends('admin.dashbord.layouts')

@section('title', 'Restaurant Details - ' . $restaurant->title)

@section('content')
<x-alert />

<div class="container-xxl py-4">
    <!-- العنوان والأزرار العلوية -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h4 class="mb-0 fw-semibold">{{ $restaurant->title }}</h4>
            <p class="text-muted mb-0">Restaurant Full Details</p>
        </div>

        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('admin.restaurants.branch.index', $restaurant) }}" class="btn btn-outline-primary">
                <i class="bx bx-building"></i> View Branches
            </a>
            <a href="{{ route('admin.restaurants.menu.index', $restaurant) }}" class="btn btn-outline-success">
                <i class="bx bx-food-menu"></i> View Menus
            </a>
            <a href="{{ route('admin.restaurants.edit', $restaurant) }}" class="btn btn-warning">
                <i class="bx bx-edit"></i> Edit
            </a>
            <a href="{{ route('admin.restaurants.index') }}" class="btn btn-secondary">
                <i class="bx bx-arrow-back"></i> Back
            </a>
        </div>
    </div>

    <!-- كروت الإحصائيات السريعة -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 border-start border-primary border-3">
                <div class="card-body text-center py-4">
                    <i class="bx bx-image fs-1 text-primary mb-2"></i>
                    <h3 class="mb-0 fw-bold">{{ $restaurant->images->count() }}</h3>
                    <p class="text-muted mb-0">Images</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 border-start border-info border-3">
                <div class="card-body text-center py-4">
                    <i class="bx bx-building fs-1 text-info mb-2"></i>
                    <h3 class="mb-0 fw-bold">{{ $restaurant->branches_count }}</h3>
                    <p class="text-muted mb-0">Branches</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 border-start border-success border-3">
                <div class="card-body text-center py-4">
                    <i class="bx bx-food-menu fs-1 text-success mb-2"></i>
                    <h3 class="mb-0 fw-bold">{{ $restaurant->menus_count }}</h3>
                    <p class="text-muted mb-0">Menu Items</p>
                </div>
            </div>
        </div>
    </div>

    <!-- المعلومات الأساسية -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-semibold"><i class="bx bx-info-circle text-primary me-1"></i> Basic Information</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="fw-bold text-muted small text-uppercase">Restaurant Name </label>
                    <p class="mb-0 fs-5 fw-medium text-dark">{{ $restaurant->title }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="fw-bold text-muted small text-uppercase">HotLine</label>
                    <p class="mb-0 fs-5 text-dark">{{ $restaurant->hotline ?? 'Not provided' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- صور المطعم -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-semibold">
                <i class="bx bx-images text-primary me-1"></i> Restaurant Images
                <span class="badge bg-primary rounded-pill ms-1">{{ $restaurant->images->count() }}</span>
            </h5>
        </div>
        <div class="card-body">
            @if($restaurant->images->isNotEmpty())
                <div class="row g-3">
                    @foreach($restaurant->images as $image)
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="card h-100 shadow-sm border-0 overflow-hidden img-hover-card">
                                <img src="{{ Storage::url($image->image_path) }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Restaurant Image">
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5 text-muted">
                    <i class="bx bx-image-alt display-4 mb-2 text-black-50"></i>
                    <p class="mb-0">No images available</p>
                </div>
            @endif
        </div>
    </div>

    <!-- الفروع -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
            <h5 class="mb-0 fw-semibold">
                <i class="bx bx-building text-info me-1"></i> Branches
                <span class="badge bg-info text-white rounded-pill ms-1">{{ $restaurant->branches_count }}</span>
            </h5>
            <a href="{{ route('admin.restaurants.branch.create', $restaurant) }}" class="btn btn-success btn-sm">
                <i class="bx bx-plus"></i> Add Branch
            </a>
        </div>
        <div class="card-body">
            @forelse($restaurant->branches as $branch)
                <div class="card border-light shadow-sm mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="mb-2 fw-semibold text-primary">Branch #{{ $loop->iteration }}</h6>
                                <p class="mb-1 text-secondary"><strong>Phone:</strong> {{ $branch->phone }}</p>
                                <p class="mb-0 text-secondary"><strong>Address:</strong> {{ $branch->address }}</p>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.restaurants.branch.edit', [$restaurant, $branch]) }}" class="btn btn-sm btn-warning">
                                    <i class="bx bx-edit"></i>
                                </a>
                                <form action="{{ route('admin.restaurants.branch.destroy', [$restaurant, $branch]) }}" method="POST" class="d-inline delete-item-form">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" title="Delete Branch">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-5 text-muted">
                    <i class="bx bx-building-house display-4 mb-2 text-black-50"></i>
                    <p class="mb-0">No branches added yet.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- وجبات المنيو (تم تعديل الهيدر هنا لإضافة زر الإكسيل) -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
            <h5 class="mb-0 fw-semibold">
                <i class="bx bx-food-menu text-success me-1"></i> Menu Items
                <span class="badge bg-success rounded-pill ms-1">{{ $restaurant->menus_count }}</span>
            </h5>
            <div class="d-flex gap-2">
                <!-- زر رفع الإكسيل الجديد -->
                <button type="button" class="btn btn-outline-success btn-sm d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#excelImportModal">
                    <i class="bx bx-file"></i> Import via Excel
                </button>
                <a href="{{ route('admin.restaurants.menu.create', $restaurant) }}" class="btn btn-success btn-sm">
                    <i class="bx bx-plus"></i> Add Menu Item
                </a>
            </div>
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
                                    <td class="fw-semibold text-dark">{{ $menu->item }}</td>
                                    <td class="fw-bold text-success">{{ number_format($menu->price, 2) }} EGP</td>
                                    <td>
                                        @if($menu->image)
                                            <img src="{{ Storage::url($menu->image) }}" width="50" height="50" class="rounded border" style="object-fit: cover;" alt="{{ $menu->item }}">
                                        @else
                                            <span class="text-muted small">No image</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <div class="d-flex gap-2 justify-content-end">
                                            <a href="{{ route('admin.restaurants.menu.edit', [$restaurant, $menu]) }}" class="btn btn-sm btn-warning">
                                                <i class="bx bx-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.restaurants.menu.destroy', [$restaurant, $menu]) }}" method="POST" class="d-inline delete-item-form">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger" title="Delete Item">
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
                    <i class="bx bx-food-menu display-4 mb-2 text-black-50"></i>
                    <p class="mb-0">No menu items added yet.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- النافذة المنبثقة لرفع الإكسيل (Excel Import Modal) -->
<div class="modal fade" id="excelImportModal" tabindex="-1" aria-labelledby="excelImportModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="excelImportModalLabel"><i class="bx bx-file me-1"></i> Import Menu via Excel</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.menu.importmenu', $restaurant) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body py-4">
                    <div class="mb-3">
                        <label for="excel_file" class="form-label fw-semibold text-secondary">Choose Excel File</label>
                        <input class="form-control" type="file" id="excel_file" name="excel_file" accept=".xlsx, .xls, .csv" required>
                        <div class="form-text text-muted mt-1">Supported extensions: .xlsx, .xls, .csv</div>
                    </div>
                    <div class="alert alert-warning d-flex align-items-center gap-2 mb-0" role="alert">
                        <i class="bx bx-info-circle fs-4"></i>
                        <small>Please make sure the columns inside the file follow the required template format (Item name, Price).</small>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success px-4">Upload & Import</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('css')
<style>
    .img-hover-card { transition: transform 0.2s; }
    .img-hover-card:hover { transform: scale(1.03); }
    .table td, .table th { vertical-align: middle; }
</style>
@endpush

@push('scripts')
<script>
    // كود الجافاسكريبت الموحد لتأكيد الحذف لأي عنصر داخل الصفحة منعاً للأخطاء
    document.querySelectorAll('.delete-item-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!confirm('Are you sure you want to delete this item?')) {
                e.preventDefault();
            }
        });
    });
</script>
@endpush
