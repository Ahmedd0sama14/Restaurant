@extends('admin.dashbord.layouts')

@section('title', 'Menu Items - ' . $restaurant->title)

@section('content')

<x-alert />

<div class="container-xxl py-4">

```
<!-- Header -->
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">

    <div>
        <h4 class="fw-bold mb-1">Menu Management</h4>
        <p class="text-muted mb-0">{{ $restaurant->title }}</p>
    </div>

    <div class="d-flex gap-2">

        <div class="input-group" style="width:280px;">
            <span class="input-group-text bg-white border-end-0">
                <i class="bx bx-search"></i>
            </span>

            <input
                type="text"
                id="searchMenu"
                class="form-control border-start-0"
                placeholder="Search menu items...">
        </div>

        <a href="{{ route('admin.restaurants.menu.create', $restaurant) }}"
           class="btn btn-success">
            <i class="bx bx-plus"></i>
            Add Item
        </a>

    </div>

</div>

<!-- Stats -->
<div class="row mb-4">

    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <small class="text-muted">Total Items</small>
                <h3 class="fw-bold mb-0">
                    {{ $restaurant->menus->count() }}
                </h3>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <small class="text-muted">Average Price</small>
                <h3 class="fw-bold mb-0">
                    {{ number_format($restaurant->menus->avg('price') ?? 0, 0) }} EGP
                </h3>
            </div>
        </div>
    </div>

</div>

<!-- Menu Cards -->
<div class="row g-4" id="menuContainer">

    @forelse($restaurant->menus as $menu)

        <div class="col-lg-4 col-md-6 menu-card">

            <div class="card h-100 border-0 menu-card-item">

                <div class="position-relative">

                    @if($menu->image)

                        <img
                            src="{{ Storage::url($menu->image) }}"
                            class="card-img-top menu-image"
                            alt="{{ $menu->item ?? $menu->title }}">

                    @else

                        <div class="bg-light d-flex align-items-center justify-content-center"
                             style="height:220px;">
                            <i class="bx bx-food-menu display-5 text-muted"></i>
                        </div>

                    @endif

                    <span class="badge bg-success position-absolute top-0 end-0 m-3">
                        {{ number_format($menu->price, 0) }} EGP
                    </span>

                </div>

                <div class="card-body d-flex flex-column">

                    <h5 class="menu-title mb-2">
                        {{ $menu->item ?? $menu->title }}
                    </h5>

                    <p class="text-muted small mb-4">
                        Delicious menu item available in the restaurant menu.
                    </p>

                    <div class="mt-auto d-flex gap-2">

                        <a href="{{ route('admin.restaurants.menu.edit', [$restaurant, $menu]) }}"
                           class="btn btn-warning flex-grow-1">
                            <i class="bx bx-edit"></i>
                            Edit
                        </a>

                        <form action="{{ route('admin.restaurants.menu.destroy', [$restaurant, $menu]) }}"
                              method="POST"
                              class="flex-grow-1">

                            @csrf
                            @method('DELETE')

                            <button type="button"
                                    class="btn btn-danger w-100"
                                    onclick="if(confirm('Are you sure you want to delete this item?')) this.closest('form').submit()">
                                <i class="bx bx-trash"></i>
                                Delete
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    @empty

        <div class="col-12">

            <div class="card border-0 shadow-sm">

                <div class="card-body text-center py-5">

                    <i class="bx bx-food-menu display-1 text-success"></i>

                    <h4 class="mt-3">
                        No Menu Items Yet
                    </h4>

                    <p class="text-muted">
                        Add your first menu item and start building your restaurant menu.
                    </p>

                    <a href="{{ route('admin.restaurants.menu.create', $restaurant) }}"
                       class="btn btn-success">
                        <i class="bx bx-plus"></i>
                        Add First Item
                    </a>

                </div>

            </div>

        </div>

    @endforelse

</div>
```

</div>

@endsection

@push('styles')

<style>

.menu-card-item{
    border-radius:18px;
    overflow:hidden;
    transition:all .3s ease;
}

.menu-card-item:hover{
    transform:translateY(-8px);
    box-shadow:0 15px 35px rgba(0,0,0,.12);
}

.menu-image{
    height:220px;
    object-fit:cover;
    transition:transform .5s ease;
}

.menu-card-item:hover .menu-image{
    transform:scale(1.08);
}

.menu-title{
    font-weight:700;
    font-size:1.1rem;
}

.menu-card{
    transition:all .25s ease;
}

</style>

@endpush

@push('scripts')

<script>

const searchInput = document.getElementById('searchMenu');

searchInput.addEventListener('keyup', function () {

    const value = this.value.toLowerCase().trim();

    document.querySelectorAll('.menu-card').forEach(card => {

        const title = card.querySelector('.menu-title')
            .innerText
            .toLowerCase();

        if (title.includes(value)) {

            card.style.display = 'block';

            setTimeout(() => {
                card.style.opacity = '1';
            }, 10);

        } else {

            card.style.opacity = '0';

            setTimeout(() => {
                card.style.display = 'none';
            }, 200);
        }
    });

});

</script>

@endpush
