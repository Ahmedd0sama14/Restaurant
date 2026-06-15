<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Dashboard')</title>

    <link rel="icon" href="{{ asset('assets/img/favicon/favicon.ico') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}">

    @stack('styles')
</head>

<body>

<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">

        {{-- Sidebar --}}
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

            <div class="app-brand demo">
                <a href="#" class="app-brand-link">
                    <span class="app-brand-text fw-bolder">Dashboard</span>
                </a>
            </div>

            <ul class="menu-inner py-1">



                @yield('sidebar')

            </ul>

        </aside>

        {{-- Main --}}
        <div class="layout-page">

            {{-- Navbar --}}
            <nav class="layout-navbar navbar navbar-expand-xl navbar-detached bg-navbar-theme">

                <div class="navbar-nav-right d-flex align-items-center w-100">

                    <ul class="navbar-nav ms-auto">

                        <li class="nav-item dropdown">

                            <a class="nav-link dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <img src="{{ asset('assets/img/avatars/1.png') }}"
                                     class="w-px-40 h-auto rounded-circle">
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end">

                                <li class="dropdown-item">
                                    {{ Auth::user()->name ?? 'Admin' }}
                                </li>

                                <li><hr></li>

                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button class="dropdown-item">
                                            Logout
                                        </button>
                                    </form>
                                </li>

                            </ul>

                        </li>

                    </ul>

                </div>

            </nav>

            {{-- Content --}}
            <div class="content-wrapper">
                <div class="container-xxl py-4">
                    @yield('content')
                </div>
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
