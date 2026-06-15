@extends('admin.dashbord.layouts')

@section('title', 'Dashboard')

@section('content')

<div class="container-xxl py-4">

    <!-- Welcome -->
    <div class="card border-0 shadow-sm bg-gradient-primary text-white mb-5 overflow-hidden">
        <div class="card-body d-flex justify-content-between align-items-center p-4">
            <div>
                <h3 class="mb-1 fw-semibold">
                    Welcome Back, {{ auth('admin')->user()->name }} 👋
                </h3>
                <p class="mb-0 opacity-75">
                    Here's what's happening in your system today.
                </p>
            </div>
            <i class="bx bx-grid-alt display-1 opacity-25"></i>
        </div>
    </div>

    <!-- Stats -->
    <div class="row g-4 mb-5">
        @php
            $stats = [
                ['title' => 'Restaurants', 'count' => $restaurantsCount ?? 0, 'icon' => 'bx-store-alt', 'color' => 'primary'],
                ['title' => 'Branches', 'count' => $branchesCount ?? 0, 'icon' => 'bx-git-branch', 'color' => 'success'],
                ['title' => 'Admins', 'count' => $adminsCount ?? 0, 'icon' => 'bx-user', 'color' => 'danger'],
            ];
        @endphp

        @foreach($stats as $stat)
            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow-sm h-100 stat-card">
                    <div class="card-body d-flex align-items-center">
                        <div class="avatar me-4">
                            <span class="avatar-initial rounded bg-label-{{ $stat['color'] }} p-3">
                                <i class="bx {{ $stat['icon'] }} fs-1"></i>
                            </span>
                        </div>
                        <div>
                            <small class="text-muted text-uppercase fw-medium">{{ $stat['title'] }}</small>
                            <h3 class="mb-0 mt-1 count">{{ $stat['count'] }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Latest Section -->
    <div class="row g-4">
        <!-- Latest Restaurants -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center py-3">
                    <h5 class="mb-0 fw-semibold">Latest Restaurants</h5>
                    <i class="bx bx-store text-primary fs-3"></i>
                </div>
                <div class="card-body p-0">
                    @forelse($latestRestaurants as $restaurant)
                        <div class="latest-item p-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="mb-1">{{ $restaurant->title }}</h6>
                                    <small class="text-muted">{{ $restaurant->email }}</small>
                                </div>
                                <span class="badge bg-light text-dark">{{ $restaurant->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        @if(!$loop->last)
                            <hr class="m-0">
                        @endif
                    @empty
                        <div class="p-5 text-center text-muted">
                            <i class="bx bx-store-alt display-6 mb-3"></i>
                            <p>No restaurants found</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Latest Branches -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center py-3">
                    <h5 class="mb-0 fw-semibold">Latest Branches</h5>
                    <i class="bx bx-git-branch text-success fs-3"></i>
                </div>
                <div class="card-body p-0">
                    @forelse($latestBranches as $branch)
                        <div class="latest-item p-3">
                            <h6 class="mb-1">{{ $branch->restaurant->title ?? 'Unknown Restaurant' }}</h6>
                            <small class="text-muted d-block">{{ $branch->phone }}</small>
                            <small class="text-muted d-block">{{ $branch->address }}</small>
                            <span class="badge bg-light text-dark mt-2">{{ $branch->created_at->diffForHumans() }}</span>
                        </div>
                        @if(!$loop->last)
                            <hr class="m-0">
                        @endif
                    @empty
                        <div class="p-5 text-center text-muted">
                            <i class="bx bx-git-branch display-6 mb-3"></i>
                            <p>No branches found</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
<script>
    // Simple counter animation
    document.addEventListener('DOMContentLoaded', () => {
        const counts = document.querySelectorAll('.count');

        counts.forEach(count => {
            const target = parseInt(count.textContent);
            let current = 0;
            const increment = Math.ceil(target / 30);

            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                count.textContent = current;
            }, 40);
        });

        // Hover effect
        document.querySelectorAll('.stat-card').forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'translateY(-5px)';
            });
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(0)';
            });
        });
    });
</script>
@endpush
