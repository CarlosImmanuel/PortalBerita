<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index()
    {
        $apiKey = '53ccf02bccb34a33afbe2f167c20e8f0';
        $baseUrl = 'https://newsapi.org/v2/top-headlines';

        $categories = [
            'ekonomi'     => 'business',
            'hiburan'     => 'entertainment',
            'umum'        => 'general',
            'teknologi'   => 'technology',
            'olahraga'    => 'sports',
            'sains'       => 'science',
            'kesehatan'   => 'health',
        ];

        $topHeadlinesResponse = Http::get($baseUrl, [
            'country' => 'us',
            'apiKey' => $apiKey
        ]);

        $topHeadlines = Cache::remember('top_headlines', 3600, function () use ($topHeadlinesResponse) {
            return $topHeadlinesResponse->json()['articles'] ?? [];
        });

        $limit = $topHeadlinesResponse->header('X-RateLimit-Limit');
        $remaining = $topHeadlinesResponse->header('X-RateLimit-Remaining');
        $reset = $topHeadlinesResponse->header('X-RateLimit-Reset');

        $data = [];
        foreach ($categories as $key => $apiCategory) {
            $data[$key] = Cache::remember("news_$key", 3600, function () use ($baseUrl, $apiKey, $apiCategory) {
                $response = Http::get($baseUrl, [
                    'country' => 'us',
                    'category' => $apiCategory,
                    'apiKey' => $apiKey
                ]);
                return array_slice($response->json()['articles'] ?? [], 0, 6);
            });
        }

        return view('homepage', array_merge(
            ['topHeadlines' => $topHeadlines],
            $data,
            ['limit' => $limit, 'remaining' => $remaining, 'reset' => $reset]
        ));
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
            return response()->json($response->json()['articles'] ?? []);
        } else {
            return response()->json(['error' => 'Gagal ambil berita'], 500);
        }
    }

    public function show(Request $request)
    {
        $title = urldecode($request->query('title'));

        $apiKey = '53ccf02bccb34a33afbe2f167c20e8f0';
        $baseUrl = 'https://newsapi.org/v2/top-headlines';

        $response = Http::get($baseUrl, [
            'country' => 'us',
            'apiKey' => $apiKey
        ]);

        $articles = $response->json()['articles'] ?? [];

        $selected = collect($articles)->firstWhere('title', $title);

        if (!$selected) {
            return abort(404);
        }

        // Filter artikel lain yang berbeda dari yang sedang dibuka
        $otherNews = collect($articles)
            ->where('title', '!=', $selected['title'])
            ->take(4)
            ->values()
            ->toArray();

        // Cari related news berdasarkan kategori
        $category = $selected['category'] ?? 'general';
        $relatedResponse = Http::get($baseUrl, [
            'country' => 'us',
            'category' => $category,
            'apiKey' => $apiKey
        ]);

        $relatedArticles = $relatedResponse->json()['articles'] ?? [];

        $relatedNews = collect($relatedArticles)
            ->where('title', '!=', $selected['title'])
            ->take(4)
            ->map(function ($item) use ($category) {
                $item['category'] = $category;
                return $item;
            })
            ->values()
            ->toArray();

        return view('detail', [
            'news' => $selected,
            'relatedNews' => $relatedNews,
            'otherNews' => $otherNews
        ]);
    }
}
