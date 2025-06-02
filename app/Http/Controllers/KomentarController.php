<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use Illuminate\Http\Request;

class KomentarController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'berita_id' => 'required',
            'nama' => 'required|string',
            'isi' => 'required|string',
        ]);

        Komentar::create([
            'berita_id' => $request->berita_id,
            'nama' => $request->nama,
            'isi' => $request->isi,
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil disimpan');
    }

    public function getByBerita($beritaId)
    {
        $komentar = Komentar::where('berita_id', $beritaId)->latest()->get();
        return response()->json($komentar);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'isi' => 'required|string|max:1000',
        ]);

        $komentar = Komentar::findOrFail($id);
        $komentar->isi = $request->isi;
        $komentar->save();

        return redirect()->back()->with('success', 'Komentar berhasil diperbarui');
    }

    public function destroy($id)
    {
        $komentar = Komentar::find($id);
        if (!$komentar) {
            return response()->json(['message' => 'Komentar tidak ditemukan'], 404);
        }

        $komentar->delete();

        return redirect()->back()->with('success', 'Komentar berhasil dihapus');
    }
}

