<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua komentar
        $comments = Komentar::orderBy('created_at', 'desc')->get();

        // Login ke API untuk dapatkan token
        $loginResponse = Http::post('https://winnicode.com/api/login', [
            'email' => 'dummy@dummy.com',
            'password' => 'dummy'
        ]);

        $beritaMap = collect();

        if ($loginResponse->successful()) {
            $apiKey = $loginResponse->json()['api_key'] ?? null;

            if ($apiKey) {
                $newsResponse = Http::withToken($apiKey)->get('https://winnicode.com/api/publikasi-berita');

                if ($newsResponse->successful()) {
                    $beritaMap = collect($newsResponse->json())
                        ->pluck('judul', 'id'); // key = id, value = judul
                }
            }
        }

        // Tambahin judul ke setiap komentar
        $comments->transform(function ($comment) use ($beritaMap) {
            $comment->judul_berita = $beritaMap[$comment->berita_id] ?? null;
            return $comment;
        });

        return view('dashboard.comments.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $komentar = Komentar::findOrFail($id);
        $komentar->delete();

        return redirect()->back()->with('success', 'Komentar berhasil dihapus');
    }
}
