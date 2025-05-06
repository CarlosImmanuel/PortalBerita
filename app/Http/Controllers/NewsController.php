<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NewsController extends Controller
{
    public function index()
    {
        $apiKey = '53ccf02bccb34a33afbe2f167c20e8f0';
        $baseUrl = 'https://newsapi.org/v2/top-headlines';

        $topHeadlines = Http::get($baseUrl, [
            'country' => 'us',
            'apiKey' => $apiKey
        ])->json()['articles'];

        $ekonomi = array_slice(
            Http::get($baseUrl, [
                'country' => 'us',
                'category' => 'business',
                'apiKey' => $apiKey
            ])->json()['articles'],
            0, 6
        );

        $hiburan = array_slice(
            Http::get($baseUrl, [
                'country' => 'us',
                'category' => 'entertainment',
                'apiKey' => $apiKey
            ])->json()['articles'],
            0, 6
        );

        $umum = array_slice(
            Http::get($baseUrl, [
                'country' => 'us',
                'category' => 'general',
                'apiKey' => $apiKey
            ])->json()['articles'],
            0, 6
        );

        $teknologi = array_slice(
            Http::get($baseUrl, [
                'country' => 'us',
                'category' => 'technology',
                'apiKey' => $apiKey
            ])->json()['articles'],
            0, 6
        );

        $olahraga = array_slice(
            Http::get($baseUrl, [
                'country' => 'us',
                'category' => 'sports',
                'apiKey' => $apiKey
            ])->json()['articles'],
            0, 6
        );

        $sains = array_slice(
            Http::get($baseUrl, [
                'country' => 'us',
                'category' => 'science',
                'apiKey' => $apiKey
            ])->json()['articles'],
            0, 6
        );

        $kesehatan = array_slice(
            Http::get($baseUrl, [
                'country' => 'us',
                'category' => 'health',
                'apiKey' => $apiKey
            ])->json()['articles'],
            0, 6
        );

        return view('homepage', compact('topHeadlines', 'ekonomi', 'teknologi', 'olahraga', 'hiburan', 'umum', 'sains', 'kesehatan'));
    }

    public function loadMoreNews($kategori)
    {
        $apiKey = '53ccf02bccb34a33afbe2f167c20e8f0';
        $baseUrl = 'https://newsapi.org/v2/top-headlines';

        $response = Http::get($baseUrl, [
            'country' => 'us',
            'category' => $kategori,
            'apiKey' => $apiKey
        ]);

        if ($response->successful()) {
            return response()->json($response->json()['articles']);
        } else {
            return response()->json(['error' => 'Gagal ambil berita'], 500);
        }
    }
}
