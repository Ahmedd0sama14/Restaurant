<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

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


            </div>
        </nav>

        <!-- Sidebar -->
        <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">



            <!-- Sidebar Menu -->
            <div class="sidebar-wrapper">

                <nav class="mt-2">

                    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation"
                        data-accordion="false">

                        <li class="nav-item">

                            <a href="{{ route('headers.create') }}" class="nav-link active">

                                <i class="nav-icon bi bi-speedometer"></i>

                                <p>Add header</p>

                            </a>

                        </li>
                        <li class="nav-item">

                            <a href="{{ route('contacts') }}" class="nav-link active">

                                <i class="nav-icon bi bi-speedometer"></i>

                                <p>Messages</p>

                            </a>

                        </li>
                        <li class="nav-item">

                            <a href="{{ route('abouts.index') }}" class="nav-link active">

                                <i class="nav-icon bi bi-speedometer"></i>

                                <p>About us</p>

                            </a>

                        </li>
                         <li class="nav-item">

                            <a href="{{ route('courses.index') }}" class="nav-link active">

                                <i class="nav-icon bi bi-speedometer"></i>

                                <p>Courses</p>

                            </a>

                        </li>

                    </ul>

                </nav>

            </div>

        </aside>

        <!-- Main Content -->
        <main class="app-main">

            <div class="container py-4">

                @yield('content')

            </div>

        </main>

        <!-- Footer -->
        <footer class="info-footer bg-body-secondary shadow p-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-md-end">
                        links:
                        <a href="#" class="text-decoration-none">facebook</a>
                        <a href="#" class="text-decoration-none">Instagram</a>
                        <a href="#" class="text-decoration-none">Linkedin</a>
                    </div>
                </div>

            </div>

        </footer>

    </div>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"></script>

    <!-- AdminLTE -->
    <script src="{{ asset('Adminassets/js/adminlte.min.js') }}"></script>

</body>

</html>
