<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .sidebar a {
            color: white;
            padding: 10px;
            display: block;
            text-decoration: none;
        }

        .sidebar a:hover, .sidebar .nav-link.active {
            background-color: #495057;
        }

        @media (min-width: 992px) {
            .offcanvas-lg {
                position: static;
                transform: none;
                visibility: visible !important;
                background-color: #343a40;
                color: white;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <!-- Sidebar -->
            <div class="col-auto col-lg-3 px-sm-2 px-0 bg-dark offcanvas-lg offcanvas-start" tabindex="-1" id="sidebar" aria-labelledby="sidebarLabel">
                <div class="d-flex flex-column p-3 min-vh-100">
                    <h4 class="mb-4 text-center text-white">Dashboard</h4>
                    <ul class="nav nav-pills flex-column mb-auto">
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }} text-white">
                                Kelola Akun
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('comments.index') }}" class="nav-link {{ request()->routeIs('comments.*') ? 'active' : '' }} text-white">
                                Kelola Komentar
                            </a>
                        </li>
                    </ul>
                    <hr class="text-white">
                    <form action="/logout" method="POST" class="mt-auto">
                        @csrf
                        <button type="submit" class="btn btn-danger w-100">Logout</button>
                    </form>
                </div>
            </div>

            <!-- Main content -->
            <div class="col py-0">
                <!-- Navbar -->
                <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm px-4">
                    <div class="container-fluid">
                        <button class="btn btn-outline-secondary d-lg-none me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar">
                            ☰
                        </button>
                        <div class="ms-auto">
                            <span class="navbar-text">
                                Welcome {{ Auth::user()?->username }}
                            </span>
                        </div>
                    </div>
                </nav>

                <!-- Dynamic Content -->
                <main class="p-4 mt-3">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
