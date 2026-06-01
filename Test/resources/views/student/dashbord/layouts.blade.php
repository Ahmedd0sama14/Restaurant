<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Dashboard')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}">

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}">

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}">

    @stack('styles')

    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>
</head>

<body>

<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">

        {{-- Sidebar --}}
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

            <div class="app-brand demo">
                <a href="#" class="app-brand-link">
                    <span class="app-brand-text fw-bolder">Sneat</span>
                </a>
            </div>

            <ul class="menu-inner py-1">

                <li class="menu-item">
                    <a href="" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-home-circle"></i>
                        <div>Dashboard</div>
                    </a>
                </li>

                @yield('sidebar')

            </ul>

        </aside>

        {{-- Main Content --}}
        <div class="layout-page">

            {{-- Navbar --}}
            <nav class="layout-navbar navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme">

                <div class="navbar-nav-right d-flex align-items-center w-100">

                    <ul class="navbar-nav flex-row align-items-center ms-auto">

                        <li class="nav-item navbar-dropdown dropdown-user dropdown">
                            <a class="nav-link dropdown-toggle hide-arrow"
                               href="javascript:void(0);"
                               data-bs-toggle="dropdown">

                                <div class="avatar avatar-online">
                                    <img src="{{ asset('assets/img/avatars/1.png') }}"
                                         class="w-px-40 h-auto rounded-circle">
                                </div>

                            </a>

                            <ul class="dropdown-menu dropdown-menu-end">

                                <li>
                                    <div class="dropdown-item">
                                        {{ Auth::user()->name ?? 'Guest' }}
                                    </div>
                                </li>

                                <li><hr class="dropdown-divider"></li>

                                <li>
                                    <form action="{{ route('student.logout') }}" method="POST">
                                        @csrf

                                        <button type="submit" class="dropdown-item">
                                            <i class="bx bx-power-off me-2"></i>
                                            Logout
                                        </button>
                                    </form>
                                </li>

                            </ul>
                        </li>

                    </ul>

                </div>

            </nav>

            {{-- Page Content --}}
            <div class="content-wrapper">

                <div class="container-xxl flex-grow-1 container-p-y">

                    @yield('content')

                </div>

            </div>

        </div>

    </div>
</div>

<!-- Core JS -->
<script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('assets/vendor/js/menu.js') }}"></script>

<!-- Main JS -->
<script src="{{ asset('assets/js/main.js') }}"></script>

@stack('scripts')

</body>
</html>
