<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <title>Detail</title>
</head>
<body>
    {{-- Header --}}
    @include('layouts.header')

    {{-- Main Content --}}
    <div class="container mt-5">
        {{-- Judul dan Metadata --}}
        <div class="mb-3">
          <h1 class="fw-bold">{{ $news['judul'] }}</h1>
          <small class="text-muted"><span class="text-primary">{{ $news['penulis'] }}</span></small>
          <div class="float-end">
            <a href="#" class="text-dark">Bagikan <i class="bi bi-share-fill mx-2"></i></a>
          </div>
        </div>

        {{-- Gambar utama --}}
        @if (!empty($news['gambar']))
          <img
            src="https://lh3.googleusercontent.com/d/{{ $news['gambar'] ?? '' }}"
            alt="Gambar Berita Utama"
            class="main-news"
        >
        @endif

        {{-- Konten --}}
        <div class="fs-5 mt-5" style="text-align: justify;">
          {!! $news['deskripsi'] !!}
        </div>

        {{-- Berita lainnya --}}
        {{-- <h4 class="mt-5">Berita lainnya</h4>
        <div class="row row-cols-1 row-cols-md-4 g-3">
        @foreach ($otherNews as $item)
        <div class="col">
            <div class="card news-card h-100">
                <img
                src="https://lh3.googleusercontent.com/d/{{ $headline['gambar'] ?? '' }}"
                alt="Gambar Berita Utama"
                class="main-news"
                >
            <div class="card-body">
                <a href="{{ route('detail', ['judul' => urlencode($item['judul'])]) }}" class="card-title d-block mt-2 text-decoration-none text-dark fw-semibold">
                {{ Str::limit($item['judul'], 60) }}
                </a>
            </div>
            </div>
        </div>
        @endforeach
        </div> --}}


        {{-- Komentar --}}
        <div class="mt-5">
          <h5>Kirim Komentar</h5>
          <form {{-- action="{{ route('comment.store') }}" --}} method="POST">
            @csrf
            <div class="mb-3">
              <textarea name="content" rows="4" class="form-control" maxlength="1000" placeholder="Tuliskan komentar anda...(Max 1000 karakter)"></textarea>
            </div>
            <button class="btn btn-primary">Send</button>
          </form>
          <div class="mt-3">
            <strong>0 komentar</strong>
          </div>
        </div>
      </div>

    {{-- Footer --}}
    @include('layouts.footer')
</body>
</html>
