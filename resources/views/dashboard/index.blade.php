@extends('layouts.dashboard')

@section('content')

@extends('layouts.dashboard')

@section('content')

    <!-- Headline -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h4 class="news-title mb-4">Berita Utama Hari Ini</h4>

                @if ($headline)
                    <a href="{{ route('detail', ['id' => $headline['id']]) }}" class="text-decoration-none text-dark">
                        <div class="position-relative top-news mb-4">
                            <img
                                src="https://lh3.googleusercontent.com/d/{{ $headline['gambar'] ?? '' }}"
                                alt="Gambar Berita Utama"
                                class="img-fluid rounded w-100 main-news"
                            >
                            <div class="overlay"></div>
                            <div class="headline-text position-absolute bottom-0 text-white p-3 bg-dark bg-opacity-50 w-100">
                                {{ $headline['judul'] }}
                            </div>
                        </div>
                    </a>
                @endif
            </div>
        </div>

        {{-- Berita per kategori --}}
        @foreach ($groupedNews as $kategori => $beritaList)
            <div class="mt-5 animasi kategori-block" id="block-{{ \Illuminate\Support\Str::slug($kategori, '-') }}">
                <h5 class="section-title mb-3" id="kategori-{{ \Illuminate\Support\Str::slug($kategori, '-') }}">
                    {{ $kategori }}
                </h5>
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach ($beritaList as $item)
                        <div class="col">
                            <a href="{{ route('detail', ['id' => $item['id']]) }}" class="text-decoration-none text-dark">
                                <div class="card news-card h-100 shadow-sm" data-judul="{{ strtolower($item['judul']) }}">
                                    <img
                                        src="https://lh3.googleusercontent.com/d/{{ $item['gambar'] ?? '' }}"
                                        alt="Gambar Berita"
                                        class="card-img-top main-news"
                                    >
                                    <div class="card-body">
                                        <span class="badge bg-primary mb-2">{{ $item['kategori'] }}</span>
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
    </div>

@endsection


@endsection
