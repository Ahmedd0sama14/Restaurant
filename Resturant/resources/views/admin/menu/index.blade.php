@extends('admin.dashbord.layouts')

@section('title', 'Menu Items - ' . $restaurant->title)

@section('content')

<x-alert />

<div class="menu-page">

    {{-- Header --}}
    <div class="menu-header">
        <div class="menu-header-left">
            <div class="restaurant-icon">
                <i class="bx bx-building"></i>
            </div>
            <div>
                <h4 class="page-title">إدارة المنيو</h4>
                <p class="page-sub">{{ $restaurant->title }}</p>
            </div>
        </div>
        <div class="menu-header-right">
            <div class="search-box">
                <i class="bx bx-search"></i>
                <input type="text" id="searchMenu" placeholder="ابحث في الأصناف...">
            </div>
            <a href="{{ route('admin.restaurants.menu.create', $restaurant) }}" class="btn-add-item">
                <i class="bx bx-plus"></i>
                إضافة صنف
            </a>
        </div>
    </div>

    {{-- Stats --}}
    <div class="stats-row">
        <div class="stat-box">
            <i class="bx bx-list-ul stat-icon"></i>
            <div>
                <span class="stat-label">إجمالي الأصناف</span>
                <span class="stat-value">{{ $restaurant->menus->count() }}</span>
            </div>
        </div>
        <div class="stat-box">
            <i class="bx bx-trending-up stat-icon"></i>
            <div>
                <span class="stat-label">متوسط السعر</span>
                <span class="stat-value">{{ number_format($menus->avg('price') ?? 0, 0) }} <small>EGP</small></span>
            </div>
        </div>
        <div class="stat-box">
            <i class="bx bx-dollar-circle stat-icon"></i>
            <div>
                <span class="stat-label">أعلى سعر</span>
                <span class="stat-value">{{ number_format($menus->max('price') ?? 0, 0) }} <small>EGP</small></span>
            </div>
        </div>
    </div>

    {{-- Grid --}}
    <div class="menu-grid" id="menuContainer">

        @forelse($menus as $menu)

            <div class="menu-card" data-title="{{ strtolower($menu->item) }}">

                {{-- Image --}}
                <div class="card-img-wrap">
                    @if($menu->image)
                        <img src="{{ Storage::url($menu->image) }}" alt="{{ $menu->item }}" class="card-img">
                    @else
                        <div class="card-img-placeholder">
                            <i class="bx bx-bowl-hot"></i>
                        </div>
                    @endif
                    <span class="price-tag">{{ number_format($menu->price, 0) }} EGP</span>
                </div>

                {{-- Body --}}
                <div class="card-body">
                    <h5 class="item-name">{{ $menu->item }}</h5>
                    <p class="item-desc">صنف متاح في قائمة المطعم</p>
                </div>

                {{-- Actions --}}
                <div class="card-actions">
                    <a href="{{ route('admin.restaurants.menu.edit', [$restaurant, $menu]) }}" class="btn-edit">
                        <i class="bx bx-edit-alt"></i>
                        تعديل
                    </a>
                    <form action="{{ route('admin.restaurants.menu.destroy', [$restaurant, $menu]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn-delete"
                            onclick="if(confirm('هل أنت متأكد من حذف هذا الصنف؟')) this.closest('form').submit()">
                            <i class="bx bx-trash"></i>
                            حذف
                        </button>
                    </form>
                </div>

            </div>

        @empty

            <div class="empty-state">
                <div class="empty-icon">
                    <i class="bx bx-bowl-hot"></i>
                </div>
                <h5>لا توجد أصناف بعد</h5>
                <p>ابدأ ببناء قائمة المطعم بإضافة أول صنف</p>
                <a href="{{ route('admin.restaurants.menu.create', $restaurant) }}" class="btn-add-item">
                    <i class="bx bx-plus"></i>
                    إضافة أول صنف
                </a>
            </div>

        @endforelse

    </div>

    {{ $menus->links('pagination::bootstrap-5') }}
</div>

@endsection
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/menu.css') }}">
@endpush

@push('scripts')
<script>
document.getElementById('searchMenu').addEventListener('keyup', function () {
    const val = this.value.toLowerCase().trim();
    document.querySelectorAll('.menu-card').forEach(card => {
        const match = card.dataset.title.includes(val);
        card.style.opacity = match ? '1' : '0';
        card.style.transform = match ? '' : 'scale(0.97)';
        setTimeout(() => card.style.display = match ? 'flex' : 'none', match ? 0 : 180);
    });
});
</script>
@endpush
