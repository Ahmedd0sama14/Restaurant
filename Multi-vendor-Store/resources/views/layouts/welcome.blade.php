<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="{{ asset('Adminassets/css/adminlte.css') }}">
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">

    <!-- App Wrapper -->
    <div class="app-wrapper">

        <!-- Header -->
        <nav class="app-header navbar navbar-expand bg-body">
            <div class="container-fluid">

                <!-- Left Navbar -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-lte-toggle="sidebar" href="#">
                            <i class="bi bi-list"></i>
                        </a>
                    </li>
                </ul>

                <!-- Right Navbar -->
                <ul class="navbar-nav ms-auto">

                    <!-- Fullscreen -->
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                            <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                            <i data-lte-icon="minimize" class="bi bi-fullscreen-exit"
                                style="display: none"></i>
                        </a>
                    </li>

                    <!-- User Dropdown -->
                    <li class="nav-item dropdown user-menu">

                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">

                            <img src="{{ asset('Adminassets/img/user2-160x160.jpg') }}"
                                class="user-image rounded-circle shadow"
                                alt="User Image">

                            <span class="d-none d-md-inline">
                                {{ auth()->user()->name ?? 'Admin' }}
                            </span>

                        </a>

                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">

                            <!-- User Info -->
                            <li class="user-header text-bg-primary">

                                <img src="{{ asset('Adminassets/img/user2-160x160.jpg') }}"
                                    class="rounded-circle shadow"
                                    alt="User Image">

                                <p>
                                    {{ auth()->user()->name ?? 'Admin' }}

                                    <small>
                                        Member since {{ auth()->user()?->created_at?->format('Y') }}
                                    </small>
                                </p>

                            </li>

                            <!-- Footer -->
                            <li class="user-footer">

                                <a href="#" class="btn btn-outline-secondary">
                                    Profile
                                </a>

                                <form action="#"
                                    method="POST"
                                    class="d-inline">

                                    @csrf

                                    <button type="submit"
                                        class="btn btn-outline-danger float-end">
                                        Logout
                                    </button>

                                </form>

                            </li>

                        </ul>
                    </li>

                </ul>
            </div>
        </nav>

        <!-- Sidebar -->
        @include('layouts.partials.sidebar')

        <!-- Main Content -->
        <main class="app-main">

            <div class="container py-4">

                @yield('content')

            </div>

        </main>

        <!-- Footer -->
        <footer class="app-footer">

            <div class="float-end d-none d-sm-inline">
                Laravel Admin Panel
            </div>

            <strong>
                Copyright &copy; {{ date('Y') }}
            </strong>

        </footer>

    </div>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"></script>

    <!-- AdminLTE -->
    <script src="{{ asset('Adminassets/js/adminlte.min.js') }}"></script>

</body>

</html>
