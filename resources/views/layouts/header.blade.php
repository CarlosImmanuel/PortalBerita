<nav class="navbar navbar-expand-lg navbar-light bg-light px-4">
  {{-- Kiri: Logo + Brand --}}
  <div class="d-flex align-items-center">
    <a class="navbar-brand d-flex align-items-center me-3" href="#">
      <img src="https://cdn-icons-png.flaticon.com/512/25/25694.png" alt="Home Icon" class="me-2" style="width: 30px; height: 30px;">
    </a>

    {{-- Search Bar --}}
    <form class="d-flex" role="search">
      <input class="form-control" type="search" placeholder="Search..." aria-label="Search" style="width: 250px;">
    </form>
  </div>

  {{-- Tengah: Logo gambar (misal logo kampus, misalnya ya) --}}
  <div class="d-flex align-items-center mx-auto footer-logo">
    <img src="{{ asset('images/Logo.png') }}" alt="InfoNet Logo">
  </div>

  {{-- Kanan: Auth menu --}}
  <div class="d-flex align-items-center ms-auto">
    @auth
      <li style="list-style: none;" class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
          Welcome, {{ auth()->user()->email }}
        </a>
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
      <a href="/register" class="regis">Register</a>
    @endauth
  </div>
</nav>
