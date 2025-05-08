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
          <li>Umum</li>
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
        @if (count($topHeadlines) > 0)
          <div class="position-relative top-news">
            <img src="{{ $topHeadlines[0]['urlToImage'] ?? asset('images/latar.jpg') }}" alt="BeritaUtama" class="main-news">
            <div class="headline-text">
              {{ $topHeadlines[0]['title'] }}
            </div>
          </div>
        @endif
      </div>
      <div class="mt-5">
        <h5 class="section-title mt-5">Umum</h5>
        <div id="general-news" class="row row-cols-1 row-cols-md-3 g-4">
        @foreach ($umum as $item)
        <div class="col">
            <div class="card news-card h-100">
            <img src="{{ $item['urlToImage'] ?? asset('images/default.jpg') }}" class="card-img-top" alt="News Image">
            <div class="card-body">
                <span class="badge-news">Umum</span>
                <a href="{{ route('detail', ['title' => urlencode($item['title'])]) }}" class="card-text d-block text-decoration-none text-dark">
                    {{ $item['title'] }}
                  </a>
            </div>
            </div>
        </div>
        @endforeach
        </div>
        <button class="btn btn-primary load-more-btn mt-3" data-kategori="general" data-loaded="false" id="toggle-umum">
            Lihat Semua
        </button>

        <h5 class="section-title mt-5">Kesehatan</h5>
        <div id="health-news" class="row row-cols-1 row-cols-md-3 g-4">
        @foreach ($kesehatan as $item)
        <div class="col">
            <div class="card news-card h-100">
            <img src="{{ $item['urlToImage'] ?? asset('images/default.jpg') }}" class="card-img-top" alt="News Image">
            <div class="card-body">
                <span class="badge-news">Kesehatan</span>
                <a href="{{ route('detail', ['title' => urlencode($item['title'])]) }}" class="card-text d-block text-decoration-none text-dark">
                    {{ $item['title'] }}
                  </a>
            </div>
            </div>
        </div>
        @endforeach
        </div>
        <button class="btn btn-primary load-more-btn mt-3" data-kategori="health" data-loaded="false" id="toggle-kesehatan">
            Lihat Semua
        </button>

        <h5 class="section-title mt-5">Ekonomi</h5>
        <div id="business-news" class="row row-cols-1 row-cols-md-3 g-4">
        @foreach ($ekonomi as $item)
        <div class="col">
            <div class="card news-card h-100">
            <img src="{{ $item['urlToImage'] ?? asset('images/default.jpg') }}" class="card-img-top" alt="News Image">
            <div class="card-body">
                <span class="badge-news">Ekonomi</span>
                <a href="{{ route('detail', ['title' => urlencode($item['title'])]) }}" class="card-text d-block text-decoration-none text-dark">
                    {{ $item['title'] }}
                  </a>
            </div>
            </div>
        </div>
        @endforeach
        </div>
        <button class="btn btn-primary load-more-btn mt-3" data-kategori="business" data-loaded="false" id="toggle-ekonomi">
            Lihat Semua
        </button>

        <h5 class="section-title mt-5">Teknologi</h5>
        <div id="technology-news" class="row row-cols-1 row-cols-md-3 g-4">
        @foreach ($teknologi as $item)
        <div class="col">
            <div class="card news-card h-100">
            <img src="{{ $item['urlToImage'] ?? asset('images/default.jpg') }}" class="card-img-top" alt="News Image">
            <div class="card-body">
                <span class="badge-news">Teknologi</span>
                <a href="{{ route('detail', ['title' => urlencode($item['title'])]) }}" class="card-text d-block text-decoration-none text-dark">
                    {{ $item['title'] }}
                  </a>
            </div>
            </div>
        </div>
        @endforeach
        </div>
        <button class="btn btn-primary load-more-btn mt-3" data-kategori="technology" data-loaded="false" id="toggle-teknologi">
            Lihat Semua
        </button>

        <h5 class="section-title mt-5">Hiburan</h5>
        <div id="entertainment-news" class="row row-cols-1 row-cols-md-3 g-4">
        @foreach ($hiburan as $item)
        <div class="col">
            <div class="card news-card h-100">
            <img src="{{ $item['urlToImage'] ?? asset('images/default.jpg') }}" class="card-img-top" alt="News Image">
            <div class="card-body">
                <span class="badge-news">Hiburan</span>
                <a href="{{ route('detail', ['title' => urlencode($item['title'])]) }}" class="card-text d-block text-decoration-none text-dark">
                    {{ $item['title'] }}
                  </a>
            </div>
            </div>
        </div>
        @endforeach
        </div>
        <button class="btn btn-primary load-more-btn mt-3" data-kategori="entertainment" data-loaded="false" id="toggle-hiburan">
            Lihat Semua
        </button>

        <h5 class="section-title mt-5">Olahraga</h5>
        <div id="sports-news" class="row row-cols-1 row-cols-md-3 g-4">
        @foreach ($olahraga as $item)
        <div class="col">
            <div class="card news-card h-100">
            <img src="{{ $item['urlToImage'] ?? asset('images/default.jpg') }}" class="card-img-top" alt="News Image">
            <div class="card-body">
                <span class="badge-news">Olahraga</span>
                <a href="{{ route('detail', ['title' => urlencode($item['title'])]) }}" class="card-text d-block text-decoration-none text-dark">
                    {{ $item['title'] }}
                  </a>
            </div>
            </div>
        </div>
        @endforeach
        </div>
        <button class="btn btn-primary load-more-btn mt-3" data-kategori="sports" data-loaded="false" id="toggle-olahraga">
            Lihat Semua
        </button>

        <h5 class="section-title mt-5">Sains</h5>
        <div id="science-news" class="row row-cols-1 row-cols-md-3 g-4">
        @foreach ($sains as $item)
        <div class="col">
            <div class="card news-card h-100">
            <img src="{{ $item['urlToImage'] ?? asset('images/default.jpg') }}" class="card-img-top" alt="News Image">
            <div class="card-body">
                <span class="badge-news">Sains</span>
                <a href="{{ route('detail', ['title' => urlencode($item['title'])]) }}" class="card-text d-block text-decoration-none text-dark">
                    {{ $item['title'] }}
                  </a>
            </div>
            </div>
        </div>
        @endforeach
        </div>
        <button class="btn btn-primary load-more-btn mt-3" data-kategori="science" data-loaded="false" id="toggle-sains">
            Lihat Semua
        </button>

      </div>
    </div>
  </div>

    <!-- Footer -->
    @include('layouts.footer')
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.querySelectorAll('.load-more-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        const kategori = this.dataset.kategori;
        const container = document.getElementById(`${kategori}-news`);

        const isLoaded = this.dataset.loaded === 'true';

        if (!isLoaded) {
        // Simpan yang awal dulu
        const originalItems = Array.from(container.children).slice(0, 6);
        this.dataset.original = container.innerHTML;

        // Fetch data baru
        const existingTitles = originalItems.map(el => el.querySelector('.card-text')?.textContent.trim());

        fetch(`/load-news/${kategori}`)
            .then(res => res.json())
            .then(data => {
            data.forEach(news => {
                if (!existingTitles.includes(news.title?.trim())) {
                const div = document.createElement('div');
                div.classList.add('col');
                div.innerHTML = `
                    <div class="card news-card h-100">
                    <img src="${news.urlToImage || '/images/default.jpg'}" class="card-img-top" alt="News Image">
                    <div class="card-body">
                        <span class="badge-news">${kategori}</span>
                        <p class="card-text">${news.title}</p>
                    </div>
                    </div>
                `;
                container.appendChild(div);
                }
            });
            this.textContent = 'Hide';
            this.dataset.loaded = 'true';
            });
        } else {
        // Reset ke 6 item awal
        container.innerHTML = this.dataset.original;
        this.textContent = 'Lihat Semua';
        this.dataset.loaded = 'false';
        }
    });
    });

    console.log('%c📊 NewsAPI Rate Info:', 'color: #00aaff; font-weight: bold;');
    console.log('🔢 Limit:', '{{ $limit ?? "N/A" }}');
    console.log('✅ Sisa:', '{{ $remaining ?? "N/A" }}');
    console.log('⏰ Reset jam:', '{{ $reset ? date("H:i:s", $reset) : "N/A" }}');
    </script>

</body>
</html>
