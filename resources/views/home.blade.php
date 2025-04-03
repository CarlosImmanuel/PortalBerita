@extends('layouts.app')

@section('content')
<div class="container-fluid my-4">
    <h4 class="fw-bold mb-3">Berita Terbaru</h4>
    <div class="row">
        @foreach ($news as $item)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img src="{{ $item['urlToImage'] ?? 'https://via.placeholder.com/400' }}" class="card-img-top" alt="News">
                    <div class="card-body">
                        <h6 class="card-title">{{ $item['title'] }}</h6>
                        <p class="text-muted">By {{ $item['author'] ?? 'Unknown' }}</p>
                        <p class="card-text">{{ Str::limit($item['description'], 100, '...') }}</p>
                        <a href="{{ $item['url'] }}" class="btn btn-primary btn-sm" target="_blank">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
