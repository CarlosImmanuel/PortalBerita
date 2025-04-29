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
        <ul>
          <li>Berita Terbaru</li>
          <li>Politik</li>
          <li>Ekonomi</li>
          <li>Teknologi</li>
          <li>Hiburan</li>
          <li>Olahraga</li>
          <li>Bisnis</li>
        </ul>
      </div>

      <!-- Headline -->
      <div class="col-md-10">
        <div class="news-title">Berita utama hari ini</div>
        <div class="position-relative top-news">
            <img src="{{ asset('images/latar.jpg') }}" alt="BeritaUtama" class="main-news">
          <div class="headline-text">
            Gedung Putih Bocorkan Momen Trump Usir Zelensky
          </div>
        </div>
      </div>
      <div class="mt-5">
        <h5 class="section-title">Berita terbaru</h5>
        <div class="row row-cols-1 row-cols-md-3 g-4">
          @for ($i = 0; $i < 6; $i++)
          <div class="col">
            <div class="card news-card h-100">
              <img src="{{ asset('images/coba.jpeg') }}" class="card-img-top" alt="News Image">
              <div class="card-body">
                <span class="badge-news">Ekonomi</span>
                <p class="card-text">Antrean SPBU Shell Mengular, Mendadak Ramai Usai Isu BBM Oplosan</p>
              </div>
            </div>
          </div>
          @endfor
        </div>

        <h5 class="section-title mt-5">Ekonomi</h5>
        <div class="row row-cols-1 row-cols-md-3 g-4">
          @for ($i = 0; $i < 6; $i++)
          <div class="col">
            <div class="card news-card h-100">
              <img src="{{ asset('images/berita.jpg') }}" class="card-img-top" alt="News Image">
              <div class="card-body">
                <span class="badge-news">Ekonomi</span>
                <p class="card-text">Shell Sampai BP Kompak Naikkan Harga BBM Per Hari Ini 1 Maret 2025</p>
              </div>
            </div>
          </div>
          @endfor
        </div>
      </div>
    </div>
  </div>

    <!-- Footer -->
    @include('layouts.footer')
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
