<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

```
<title>@yield('title', 'Dashboard')</title>

<link rel="icon" href="{{ asset('assets/img/favicon/favicon.ico') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}">

<style>
    body {
        background: #f8f9fc;
    }

    .card {
        border: none;
        border-radius: 16px;
    }

    .btn {
        border-radius: 10px;
    }

    .table {
        vertical-align: middle;
    }

    .content-wrapper {
        min-height: 100vh;
        background: #f8f9fc;
    }

    .navbar {
        box-shadow: 0 2px 10px rgba(0, 0, 0, .05);
    }

    .menu-item.active>.menu-link {
        background: rgba(105, 108, 255, .12);
        border-radius: 8px;
    }

    .app-brand {
        padding: 20px;
    }

    .app-brand-text {
        font-size: 18px;
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
    }

    .footer {
        border-top: 1px solid #e5e7eb;
    }
    /* تلوين الخيارات المعطلة داخل السيلكت */
    select option:disabled {
        color: #a94442 !important; /* لون نص أحمر داكن */
        background-color: #f2dede !important; /* خلفية حمراء خفيفة */
        font-style: italic; /* جعل الخط مائل */
    }

</style>

@stack('styles')

</head>
<body>
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">

        <!-- Sidebar -->
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

            <div class="app-brand demo">

                <a href="{{ route('admin.dashboard') }}" class="app-brand-link">

                    <div class="d-flex align-items-center gap-2">
                        <i class="bx bx-food-menu fs-3 text-primary"></i>

                        <span class="app-brand-text fw-bold">
                            Restaurant Admin
                        </span>
                    </div>

                </a>

            </div>

            <ul class="menu-inner py-1">

                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">
                        Management
                    </span>
                </li>

                @if(auth('admin')->user()->role->value == 3)

                    <li class="menu-item {{ request()->routeIs('admin.alladmin*') ? 'active' : '' }}">
                        <a href="{{ route('admin.alladmin') }}" class="menu-link">
                            <i class="menu-icon bx bx-shield-quarter"></i>
                            <div>Admins Control</div>
                        </a>
                    </li>

                    <li class="menu-item {{ request()->routeIs('admin.members.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.members.index') }}" class="menu-link">
                            <i class="menu-icon bx bx-group"></i>
                            <div>Members</div>
                        </a>
                    </li>

                @endif

                <li class="menu-item {{ request()->routeIs('admin.restaurants.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.restaurants.index') }}" class="menu-link">
                        <i class="menu-icon bx bx-store"></i>
                        <div>Restaurants</div>
                    </a>
                </li>
                 <li class="menu-item {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.orders.index') }}" class="menu-link">
                        <i class="menu-icon bx bx-store"></i>
                        <div>Orders</div>
                    </a>
                </li>
                @yield('sidebar')
            </ul>

        </aside>

        <!-- Main -->
        <div class="layout-page">

            <!-- Navbar -->
            <nav class="layout-navbar navbar navbar-expand-xl navbar-detached bg-navbar-theme">

                <div class="navbar-nav align-items-center">

                    <div class="nav-item">
                        <span class="fw-semibold">
                            Welcome,
                            {{ auth('admin')->user()->name }}
                        </span>
                    </div>

                </div>

                <div class="navbar-nav-right d-flex align-items-center ms-auto">

                    <ul class="navbar-nav">

                        <li class="nav-item dropdown">

                            <a class="nav-link dropdown-toggle hide-arrow"
                               href="javascript:void(0);"
                               data-bs-toggle="dropdown">

                                <img src="{{ asset('assets/img/avatars/1.png') }}"
                                     class="user-avatar">
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end">

                                <li>
                                    <div class="dropdown-item-text">

                                        <div class="fw-semibold">
                                            {{ auth('admin')->user()->name }}
                                        </div>

                                        <small class="text-muted">
                                            Administrator
                                        </small>

                                    </div>
                                </li>

                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                <li>
                                    <form action="{{ route('admin.logout') }}" method="POST">
                                        @csrf

                                        <button class="dropdown-item">
                                            <i class="bx bx-log-out me-2"></i>
                                            Logout
                                        </button>
                                    </form>
                                </li>

                            </ul>

                        </li>

                    </ul>

                </div>

            </nav>

            <!-- Content -->
            <div class="content-wrapper">

                <div class="container-xxl py-4">
                    @yield('content')
                </div>

                <!-- Footer -->
                <footer class="footer bg-white mt-4">

                    <div class="container-xxl py-3 text-center">

                        <small class="text-muted">
                            © {{ date('Y') }} Restaurant Management System
                        </small>
                    </div>

                </footer>

            </div>

        </div>

    </div>
</div>

<script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
@stack('scripts')
</body>

</html>
