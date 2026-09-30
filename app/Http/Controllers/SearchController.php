<?php

namespace App\Http\Controllers;

use App\Models\Gedung;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('q');

        // Jika keyword kosong, kembalikan ke halaman sebelumnya
        if (!$keyword) {
            return redirect()->back();
        }

        // 1. Cari Gedung berdasarkan nama gedung
        $gedung = Gedung::where('nama_gedung', 'LIKE', "%{$keyword}%")->get();

        // 2. Cari Ruangan berdasarkan nama ruangan (include data gedung tempat ruangan tersebut berada)
        $ruangan = Ruangan::with('gedung')
            ->where('nama_ruangan', 'LIKE', "%{$keyword}%")
            ->get();

        // Jika tidak ada data gedung maupun ruangan yang cocok
        if ($gedung->isEmpty() && $ruangan->isEmpty()) {
            return redirect()->back()->with('error', 'Gedung atau ruangan "' . $keyword . '" tidak ditemukan.');
        }

        // Tampilkan ke view pencarian
        return view('search', compact('gedung', 'ruangan', 'keyword'));
    }
}