@php
    use Carbon\Carbon;
@endphp

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
    {{-- Bagian Header --}}
    @include('layouts.header')

    {{-- Main Content --}}
    <div class="container mt-5">
        {{-- Judul dan Metadata --}}
        <div class="mb-3">
            <h1 class="fw-bold">{{ $news['judul'] }}</h1>
            <small class="text-muted">
                {{ Carbon::parse($news['created_at'])->locale('id')->diffForHumans() }} <br>
                <span style="font-size:15px; font-weight: bold;">{{ $news['penulis'] }}</span>
            </small>
            <div class="float-end">
                <a href="#" class="text-dark">Bagikan <i class="bi bi-share-fill mx-2"></i></a>
            </div>
        </div>

        {{-- Gambar utama --}}
        @if (!empty($news['gambar']))
            <img
                src="https://lh3.googleusercontent.com/d/{{ $news['gambar'] }}"
                alt="Gambar Berita Utama"
                class="main-news"
            >
        @endif

        {{-- Konten --}}
        <div class="fs-5 mt-5" style="text-align: justify;">
            {!! $news['deskripsi'] !!}
        </div>

        {{-- Berita lainnya --}}
        <div class="animasi">
            <h4 class="mt-5">Berita lainnya</h4>
            @if (count($otherNews) > 0)
                <div class="row row-cols-1 row-cols-md-4 g-3">
                    @foreach ($otherNews as $item)
            <div class="col">
                <div class="card news-card h-100 position-relative">
                            @if (!empty($item['gambar']))
                                <img
                                    src="https://lh3.googleusercontent.com/d/{{ $item['gambar'] }}"
                                    alt="Gambar Berita"
                                    class="main-news"
                                >
                            @else
                                <img
                                    src="https://via.placeholder.com/600x400?text=No+Image"
                                    alt="No Image"
                                    class="main-news"
                                >
                            @endif
                            <div class="card-body">
                                <div class="card-text">
                                    {{ Str::limit($item['judul'], 60) }}
                                </div>
                            </div>

                            {{-- Bikin overlay link full card clickable --}}
                            <a href="{{ route('detail', ['id' => $item['id']]) }}" class="stretched-link"></a>
                        </div>
                    </div>
                    @endforeach
                        </div>
                    @else
                        <div class="alert alert-warning mt-3">
                            <i class="bi bi-exclamation-circle me-2"></i>
                            Berita pada kategori ini sudah tidak ada lagi.
                        </div>
                    @endif
        </div>


        {{-- Komentar --}}
        <div class="mt-5">
            <h5>Kirim Komentar</h5>
            <form action="{{ route('comment.store') }}" method="POST">
                @csrf
                <input type="hidden" name="berita_id" value="{{ $news['id'] }}">
                <div class="mb-3">
                    <input type="text" name="nama" class="form-control" placeholder="Nama Anda" required>
                </div>
                <div class="mb-3">
                    <textarea name="isi" rows="4" class="form-control" maxlength="1000" placeholder="Tuliskan komentar anda...(Max 1000 karakter)" required></textarea>
                </div>
                <button class="btn btn-primary">Kirim</button>
            </form>

            <div class="mt-4">
                <strong>{{ isset($komentars) ? $komentars->count() : 0 }} komentar</strong>
                <ul class="list-group mt-2">
                    @forelse ($komentars ?? [] as $komen)
                        <li class="list-group-item">
                            <strong>{{ $komen->nama }}</strong> <br>
                            <small class="text-muted">{{ $komen->created_at->diffForHumans() }}</small>
                            <p id="isi-komentar-{{ $komen->id }}">{{ $komen->isi }}</p>

                            {{-- Tombol aksi --}}
                            <button class="btn btn-sm btn-warning" onclick="showEditForm({{ $komen->id }}, '{{ addslashes($komen->isi) }}')">Edit</button>

                            <form action="{{ route('comment.destroy', $komen->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin mau hapus komentar ini?')">Hapus</button>
                            </form>

                            {{-- Form edit (hidden dulu) --}}
                            <form id="edit-form-{{ $komen->id }}" action="{{ route('comment.update', $komen->id) }}" method="POST" style="display:none;" class="mt-2">
                                @csrf
                                @method('PUT')
                                <textarea name="isi" class="form-control" rows="3">{{ $komen->isi }}</textarea>
                                <button class="btn btn-sm btn-success mt-2">Update</button>
                                <button type="button" class="btn btn-sm btn-secondary mt-2" onclick="hideEditForm({{ $komen->id }})">Batal</button>
                            </form>
                        </li>
                    @empty
                        <li class="list-group-item">Belum ada komentar 😶</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

    {{-- Footer --}}
    @include('layouts.footer')
    <script>
        function showEditForm(id, isi) {
        document.getElementById('edit-form-' + id).style.display = 'block';
        document.getElementById('isi-komentar-' + id).style.display = 'none';
    }

    function hideEditForm(id) {
        document.getElementById('edit-form-' + id).style.display = 'none';
        document.getElementById('isi-komentar-' + id).style.display = 'block';
    }
    </script>
</body>
</html>
