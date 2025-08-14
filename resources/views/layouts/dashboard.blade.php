<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Dashboard CSS -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        /* Optional tambahan styling sidebar link */
        .sidebar a {
            color: white;
            padding: 10px;
            display: block;
            text-decoration: none;
        }

        .sidebar a:hover,
        .sidebar .nav-link.active {
            background-color: #495057;
        }

        .sidebar-title {
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            padding-bottom: 10px;
        }

        .sidebar-title h2 {
            letter-spacing: 1px;
            text-transform: uppercase;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar bg-dark text-white">
        <div class="d-flex flex-column p-3 h-100">
            <div class="sidebar-title text-center mb-4">
                <img src="{{ asset('images/Logo.png') }}" alt="InfoNet Logo">
                {{-- <h2 class="m-0 text-white" style="font-weight: 700; font-size: 1.8rem;">InfoNet</h2>
                <hr class="border-light opacity-50 mt-2" /> --}}
            </div>
            <ul class="nav nav-pills flex-column mb-auto">
<<<<<<< HEAD
                <li class="nav-item mb-2">
=======
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard.*') ? 'active' : '' }} text-white">
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
>>>>>>> origin/syahid/LastUpdate
                    <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }} text-white">
                        Account
                    </a>
                </li>
                <li>
                    <a href="{{ route('comments.index') }}" class="nav-link {{ request()->routeIs('comments.*') ? 'active' : '' }} text-white">
                        Comment
                    </a>
                </li>
            </ul>
            <hr />
            <form action="/logout" method="POST" class="mt-auto">
                @csrf
                <button type="submit" class="btn btn-danger btn-outline-light btn-sm w-100">
                    <i class="fas fa-sign-out-alt me-1"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm px-4">
            <div class="container-fluid">
                <button class="btn btn-outline-secondary d-lg-none me-2" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#sidebar" aria-controls="sidebar">
                ☰
                </button>
                <div class="ms-auto">
                    <span class="navbar-text">
                        Welcome, {{ Auth::user()?->username }}
                    </span>
                </div>
            </div>
        </nav>

    <!-- Main content -->
    <div class="main-content">
        <!-- Dynamic content -->
        <main class="p-4 mt-3">
            @yield('content')
        </main>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
