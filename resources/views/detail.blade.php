@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-3xl font-bold mb-2">{{ $berita->title }}</h1>
    <p class="text-gray-500">1 hari lalu - <strong>Pembuat</strong></p>
    <div class="my-4">
        <img src="{{ $berita->image_url }}" class="w-full rounded-lg" alt="">
    </div>
    <p class="text-lg leading-relaxed text-justify">{{ $berita->content }}</p>

    {{-- Artikel Terkait --}}
    <h2 class="mt-10 text-xl font-semibold">Artikel terkait</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-2">
        @foreach ($related as $r)
            <a href="{{ route('berita.detail', $r->slug) }}" class="border rounded shadow hover:shadow-md">
                <img src="{{ $r->image_url }}" alt="" class="rounded-t w-full h-32 object-cover">
                <div class="p-2">
                    <span class="text-xs text-white bg-blue-600 px-2 py-1 rounded">{{ $r->category }}</span>
                    <p class="text-sm mt-1 font-semibold">{{ Str::limit($r->title, 50) }}</p>
                </div>
            </a>
        @endforeach
    </div>

    {{-- Komentar --}}
    <h2 class="mt-10 text-xl font-semibold">Kirim Komentar</h2>
    <form action="#" method="POST" class="mt-2">
        @csrf
        <textarea name="komentar" rows="4" placeholder="Tulis komentar..." class="w-full border p-2 rounded"></textarea>
        <button type="submit" class="mt-2 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Send</button>
    </form>
</div>
@endsection
