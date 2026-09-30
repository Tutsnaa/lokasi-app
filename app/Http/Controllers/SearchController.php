<?php

namespace App\Http\Controllers;

use App\Models\Gedung;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $keyword = trim($request->input('q', ''));

        if ($keyword === '') {
            return view('search', [
                'gedung' => collect(),
                'ruangan' => collect(),
                'keyword' => ''
            ]);
        }

        $gedung = Gedung::where('nama_gedung', 'LIKE', "%{$keyword}%")
            ->get();

        $ruangan = Ruangan::with('gedung')
            ->where('nama_ruangan', 'LIKE', "%{$keyword}%")
            ->get();

        return view('search', compact('gedung', 'ruangan', 'keyword'));
    }
}