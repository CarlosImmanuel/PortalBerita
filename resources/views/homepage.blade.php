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
                <li class="mt-1 kategori-item">
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
            <a href="{{ route('detail', ['id' => $headline['id']]) }}" class="text-decoration-none text-dark">
            <div class="position-relative top-news">
                <img
                src="https://lh3.googleusercontent.com/d/{{ $headline['gambar'] ?? '' }}"
                alt="Gambar Berita Utama"
                class="main-news"
                >
                <div class="overlay"></div>
                    <div class="headline-text">
                    {{ $headline['judul'] }}
                    </div>
            </div>
            </a>
        @endif
        </div>

    @foreach ($groupedNews as $kategori => $beritaList)
        <div class="mt-5 animasi kategori-block" id="block-{{ \Illuminate\Support\Str::slug($kategori, '-') }}">
        <h5 class="section-title" id="kategori-{{ \Illuminate\Support\Str::slug($kategori, '-') }}">
            {{ $kategori }}
        </h5>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($beritaList as $item)
            <div class="col">
                <a href="{{ route('detail', ['id' => $item['id']]) }}" class="text-decoration-none text-dark">
                    <div class="card news-card h-100" data-judul="{{ strtolower($item['judul']) }}">
                        <img
                            src="https://lh3.googleusercontent.com/d/{{ $item['gambar'] ?? '' }}"
                            alt="Gambar Berita"
                            class="main-news"
                        >
                        <div class="card-body">
                            <span class="badge-news">{{ $item['kategori'] }}</span>
                            <div class="card-text">
                                {{ $item['judul'] }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
    @endforeach
    <div id="no-results-alert" class="alert alert-warning mt-4 text-center" style="display: none;">
        <i class="bi bi-exclamation-circle"></i> Tidak ada berita ditemukan.
    </div>


    <!-- Footer -->
    @include('layouts.footer')
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
  const searchInput = document.getElementById('searchInput');
  const kategoriBlocks = document.querySelectorAll('.kategori-block');
  const noResultsAlert = document.getElementById('no-results-alert');

  // Ambil headline elemen dan judulnya, langsung normalize (lowercase + trim + collapse spasi)
  const headlineBlock = document.querySelector('.top-news');
  const headlineTextElem = headlineBlock ? headlineBlock.querySelector('.headline-text') : null;
  const headlineJudul = headlineTextElem
    ? headlineTextElem.textContent.toLowerCase().trim().replace(/\s+/g, ' ')
    : '';

  searchInput.addEventListener('input', function () {
    // Normalize query juga (lowercase + trim + collapse spasi)
    const query = this.value.toLowerCase().trim().replace(/\s+/g, ' ');

    let totalVisibleCards = 0;

    // Filter berita di kategori
    kategoriBlocks.forEach(block => {
      let visibleCards = 0;
      const cardsInBlock = block.querySelectorAll('.news-card');

      cardsInBlock.forEach(card => {
        // Normalize judul juga
        const rawJudul = card.getAttribute('data-judul');
        const judul = rawJudul.toLowerCase().trim().replace(/\s+/g, ' ');
        const col = card.closest('.col');

        if (judul.includes(query)) {
          col.style.display = 'block';
          visibleCards++;
          totalVisibleCards++;
        } else {
          col.style.display = 'none';
        }
      });

      block.style.display = visibleCards === 0 ? 'none' : 'block';
    });

    // Cek headline match
    const isHeadlineMatch = headlineJudul.includes(query);

    // Tampilkan alert sesuai kondisi
    if (query.length > 0 && totalVisibleCards === 0) {
      if (isHeadlineMatch) {
        noResultsAlert.style.display = 'block';
        noResultsAlert.innerHTML = '<i class="bi bi-info-circle"></i> Berita ada pada headline.';
      } else {
        noResultsAlert.style.display = 'block';
        noResultsAlert.innerHTML = '<i class="bi bi-exclamation-circle"></i> Tidak ada berita ditemukan.';
      }
    } else {
      noResultsAlert.style.display = 'none';
    }
  });
</script>


</body>
</html>
