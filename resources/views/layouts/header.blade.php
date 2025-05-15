<nav class="navbar navbar-expand-lg navbar-light bg-light px-4">
    <a class="navbar-brand d-flex align-items-center" href="#">
      <img src="https://cdn-icons-png.flaticon.com/512/25/25694.png" alt="Home Icon" class="me-2">
      <span>INFONET</span>
    </a>
    <form class="d-flex ms-auto me-3">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
    </form>


        @auth
            <li style="list-style: none;" class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Welcome, {{ auth()->user()->email }}</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Dashboard</a></li>
                    <li><hr class="dropdown-divider"></li>

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
            {{-- <button href="/login" class="sign">Sign In</button> --}}
            <a href="/register" class="regis">Register</a>
        @endauth


  </nav>
