<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NewsController extends Controller
{
    public function index()
    {
        $apiKey = '53ccf02bccb34a33afbe2f167c20e8f0'; // Ganti dengan API Key NewsAPI
        $response = Http::get("https://newsapi.org/v2/everything", [
            'q' => 'Apple',
            'from' => now()->format('Y-m-d'),
            'sortBy' => 'popularity',
            'apiKey' => $apiKey
        ]);

        $newsData = $response->json();

        return view('homepage', ['news' => $newsData['articles'] ?? []]);
    }
}
