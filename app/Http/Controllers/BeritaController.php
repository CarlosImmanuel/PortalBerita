<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Models\Komentar;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    private function getApiKey()
    {
        // Step login untuk ambil token
        $loginResponse = Http::post('https://winnicode.com/api/login', [
            'email' => 'dummy@dummy.com',
            'password' => 'dummy',
        ]);

        if ($loginResponse->successful()) {
            return $loginResponse->json()['api_key'] ?? null;
        }

        return null;
    }

    public function detail($id)
    {
        $apiKey = $this->getApiKey();
        if (!$apiKey) {
            abort(500, 'Gagal login ke API');
        }

        $response = Http::withToken($apiKey)->get('https://winnicode.com/api/publikasi-berita');
        if (!$response->successful()) {
            abort(500, 'Gagal mengambil data berita dari API');
        }

        $data = $response->json();
        $news = collect($data)->firstWhere('id', $id);

        if (!$news) {
            abort(404, 'Berita tidak ditemukan');
        }

        $otherNews = collect($data)->where('id', '!=', $id)->take(4);

        // Langsung ambil komen dari DB, bypass HTTP call lokal
        $komentars = Komentar::where('berita_id', $id)->latest()->get();

        return view('detail', compact('news', 'otherNews', 'komentars'));
    }
}
