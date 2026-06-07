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

    <style>
        body {
            background: #f4f6f9;
        }

        .sidebar-brand {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, .1);
        }

        .brand-link {
            color: white;
            font-size: 1.2rem;
        }

        .sidebar-user-panel {
            background: rgba(255, 255, 255, .05);
        }

        .nav-sidebar .nav-link {
            border-radius: 8px;
            margin: 4px 8px;
            transition: all .3s ease;
        }

        .nav-sidebar .nav-link:hover {
            background: #0d6efd;
            color: white;
        }

        .nav-sidebar .nav-link.active {
            background: #0d6efd;
            color: white;
        }

        .card {
            border-radius: 15px;
        }

        .app-main {
            background: #f4f6f9;
            min-height: calc(100vh - 120px);
        }

        .main-footer {
            background: #212529;
            color: white;
        }
    </style>

</head>

<body class="layout-fixed sidebar-expand-lg">

    <div class="app-wrapper">

        <!-- Header -->
        <nav class="app-header navbar navbar-expand navbar-dark bg-primary shadow-sm">
            <div class="container-fluid">

                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-white" data-lte-toggle="sidebar" href="#">
                            <i class="bi bi-list fs-4"></i>
                        </a>
                    </li>
                </ul>

                <div class="ms-auto text-white fw-bold">
                    Education Dashboard
                </div>

            </div>
        </nav>

        <!-- Sidebar -->
        <aside class="app-sidebar bg-dark shadow" data-bs-theme="dark">

            <!-- Logo -->
            <div class="sidebar-brand">
                <a href="#" class="brand-link text-decoration-none">
                    <i class="bi bi-mortarboard-fill text-warning fs-2"></i>
                    <span class="fw-bold ms-2">Edu Admin</span>
                </a>
            </div>

            <!-- User -->
            <div class="sidebar-user-panel d-flex align-items-center p-3">
                <div class="image">
                    <img src="https://ui-avatars.com/api/?name=Admin"
                        class="rounded-circle"
                        width="45">
                </div>

                <div class="info ms-2">
                    <span class="text-white fw-semibold">
                        Administrator
                    </span>
                </div>
            </div>

            <!-- Menu -->
            <div class="sidebar-wrapper">

                <nav class="mt-3">

                    <ul class="nav sidebar-menu flex-column"
                        data-lte-toggle="treeview"
                        role="navigation"
                        data-accordion="false">

                        <li class="nav-item">
                            <a href="{{ route('headers.create') }}" class="nav-link">
                                <i class="nav-icon bi bi-window-stack"></i>
                                <p>Add Header</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('contacts') }}" class="nav-link">
                                <i class="nav-icon bi bi-envelope-fill"></i>
                                <p>Messages</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('bank-questions.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-people-fill"></i>
                                <p>Quetions</p>
                            </a>
                        </li>
                         <li class="nav-item">
                            <a href="{{ route('teachers.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-people-fill"></i>
                                <p>Teachers</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('students.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-people-fill"></i>
                                <p>Students</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('subscriptions.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-people-fill"></i>
                                <p>Subscriptions</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('exams.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-file-earmark-text-fill"></i>
                                <p>Exams</p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="{{ route('sessions.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-calendar-event-fill"></i>
                                <p>Sessions</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('abouts.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-info-circle-fill"></i>
                                <p>About Us</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('courses.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-book-fill"></i>
                                <p>Courses</p>
                            </a>
                        </li>

                    </ul>

                </nav>

            </div>

        </aside>

        <!-- Main Content -->
        <main class="app-main">

            <div class="container-fluid p-4">

                <div class="card shadow border-0">

                    <div class="card-body">

                        @yield('content')

                    </div>

                </div>

            </div>

        </main>

        <!-- Footer -->
        <footer class="main-footer text-center py-3">

            <strong>
                © {{ date('Y') }} Education Management System
            </strong>

            <div class="mt-2">

                <a href="#"
                    class="text-decoration-none text-light mx-2">
                    <i class="bi bi-facebook"></i>
                    Facebook
                </a>

                <a href="#"
                    class="text-decoration-none text-light mx-2">
                    <i class="bi bi-instagram"></i>
                    Instagram
                </a>

                <a href="#"
                    class="text-decoration-none text-light mx-2">
                    <i class="bi bi-linkedin"></i>
                    LinkedIn
                </a>

            </div>

        </footer>

    </div>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

    <!-- AdminLTE -->
    <script src="{{ asset('Adminassets/js/adminlte.min.js') }}"></script>

</body>
</html>
