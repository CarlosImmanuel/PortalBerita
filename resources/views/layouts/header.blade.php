<nav class="navbar navbar-expand-lg navbar-light bg-light px-4 position-sticky top-0">
    <div class="d-flex align-items-center">
        <a class="navbar-brand d-flex align-items-center me-3" href="#">
            <img src="https://cdn-icons-png.flaticon.com/512/25/25694.png" alt="Home Icon" class="me-2" style="width: 30px; height: 30px;">
        </a>

        <form class="d-flex" role="search">
            <input class="form-control" id="searchInput" type="search" placeholder="Search..." aria-label="Search" style="width: 250px;">
        </form>
    </div>

    <div class="d-flex align-items-center mx-auto footer-logo">
        <img src="https://i.postimg.cc/BbWMj95G/image-1.png" alt="InfoNet Logo">
    </div>

    <div class="d-flex align-items-center ms-auto">
        @auth
        <li style="list-style: none;" class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
            Welcome, {{ auth()->user()->username }}
            </a>
            <ul class="dropdown-menu">
            <li>
                <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="dropdown-item">Logout</button>
                </form>
            </li>
            </ul>
        </li>
        @else
            <form action="/login" method="GET">
            @csrf
            <button type="submit" class="sign">Sign In</button>
            </form>
            <a href="/register" class="regis">Register</a>
        @endauth
    </div>
</nav>
