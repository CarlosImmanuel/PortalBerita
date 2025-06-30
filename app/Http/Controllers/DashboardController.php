<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
{
    // Step 1: Login ke API untuk dapatkan api_key
    $loginResponse = Http::post('https://winnicode.com/api/login', [
        'email' => 'dummy@dummy.com',
        'password' => 'dummy'
    ]);

    if ($loginResponse->successful()) {
        $apiKey = $loginResponse->json()['api_key'] ?? null;

        if ($apiKey) {
            // Step 2: Ambil berita pakai Bearer Token
            $newsResponse = Http::withToken($apiKey)->get('https://winnicode.com/api/publikasi-berita');

            if ($newsResponse->successful()) {
                $news = $newsResponse->json();

                // Convert ke collection
                $newsCollection = collect($news);

                // Ambil 1 berita utama
                $headline = $newsCollection->first();

                // Sisanya dikelompokkan per kategori
                $groupedNews = $newsCollection->slice(1)->groupBy('kategori');

                // Kirim data ke view dashboard
                return view('dashboard.index', [
                    'headline' => $headline,
                    'groupedNews' => $groupedNews
                ]);
            } else {
                return view('dashboard.index', [
                    'headline' => null,
                    'groupedNews' => collect()
                ]);
            }
        } else {
            return response()->json(['error' => 'Gagal mendapatkan API Key'], 500);
        }
    } else {
        return response()->json(['error' => 'Login gagal'], 500);
    }
}
}
