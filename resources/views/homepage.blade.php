<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>INFONET - Berita Utama</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
  <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
  <link rel="stylesheet" href="{{ asset('css/header.css') }}">
</head>
<body>
  <!-- Navbar -->
  @include('layouts.header')

  <!-- Main Content -->
  <div class="container mt-4">
    <div class="row main-content-news">
      <!-- Sidebar -->
      <div class="col-md-2 sidebar">
        <h5>Kategori</h5>
        <div class="kategori-scroll" style="max-height: 297px; overflow-y: auto;">
            <ul class="list-unstyled">
            @foreach ($groupedNews->keys() as $kategori)
                <li class="mb-1">
                <a href="#kategori-{{ \Illuminate\Support\Str::slug($kategori, '-') }}" class="text-decoration-none text-dark">
                    {{ $kategori }}
                </a>
                </li>
            @endforeach
            </ul>
        </div>
        </div>


      <!-- Headline -->
      <div class="col-md-10">
    <div class="news-title">Berita utama hari ini</div>

    @if ($headline)
        <div class="position-relative top-news">
        <img
            src="https://lh3.googleusercontent.com/d/{{ $headline['gambar'] ?? '' }}"
            alt="Gambar Berita Utama"
            class="main-news"
        >
        <div class="headline-text">
            {{ $headline['judul'] }}
        </div>
        </div>
    @endif
    </div>

    @foreach ($groupedNews as $kategori => $beritaList)
        <div class="mt-5">
        <h5 class="section-title" id="kategori-{{ \Illuminate\Support\Str::slug($kategori, '-') }}">
            {{ $kategori }}
        </h5>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($beritaList as $item)
            <div class="col">
                <div class="card news-card h-100">
                <img
                    src="https://lh3.googleusercontent.com/d/{{ $item['gambar'] ?? '' }}"
                    alt="Gambar Berita"
                    class="main-news"
                >
                <div class="card-body">
                    <span class="badge-news">{{ $item['kategori'] }}</span>
                    <a href="{{ route('detail', ['id' => $item['id']]) }}" class="card-text d-block text-decoration-none text-dark">
                    {{ $item['judul'] }}
                    </a>
                </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endforeach


    <!-- Footer -->
    @include('layouts.footer')
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
