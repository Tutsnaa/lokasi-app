<?php

namespace App\Http\Controllers;

use App\Models\Gedung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GedungController extends Controller
{
    /**
     * Tampilkan semua data gedung.
     */
    public function index()
    {
        $gedung = Gedung::latest()->get();
        return response()->json($gedung); // Ubah ke view('gedung.index', compact('gedung')) jika menggunakan Blade
    }

    /**
     * Simpan data gedung baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_gedung' => 'required|string|max:225',
            'latitude'    => 'required|numeric|between:-90,90',
            'longitude'   => 'required|numeric|between:-180,180',
            'keterangan'  => 'nullable|string',
            'foto'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('gedung', 'public');
        }

        $gedung = Gedung::create($validated);

        return response()->json([
            'message' => 'Data gedung berhasil ditambahkan',
            'data'    => $gedung,
        ], 201);
    }

    /**
     * Tampilkan detail satu gedung.
     */
    public function show($id)
{
    $gedung = Gedung::find($id);

    if (!$gedung) {
        return response()->json([
            'success' => false,
            'message' => 'Data gedung dengan ID ' . $id . ' tidak ditemukan'
        ], 404);
    }

    return response()->json([
        'success' => true,
        'data'    => $gedung
    ], 200);
}

    /**
     * Update data gedung.
     */
    public function update(Request $request, Gedung $gedung)
    {
        $validated = $request->validate([
            'nama_gedung' => 'sometimes|required|string|max:225',
            'latitude'    => 'sometimes|required|numeric|between:-90,90',
            'longitude'   => 'sometimes|required|numeric|between:-180,180',
            'keterangan'  => 'nullable|string',
            'foto'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($gedung->foto && Storage::disk('public')->exists($gedung->foto)) {
                Storage::disk('public')->delete($gedung->foto);
            }
            $validated['foto'] = $request->file('foto')->store('gedung', 'public');
        }

        $gedung->update($validated);

        return response()->json([
            'message' => 'Data gedung berhasil diperbarui',
            'data'    => $gedung,
        ]);
    }

    /**
     * Hapus data gedung.
     */
    public function destroy(Gedung $gedung)
    {
        if ($gedung->foto && Storage::disk('public')->exists($gedung->foto)) {
            Storage::disk('public')->delete($gedung->foto);
        }

        $gedung->delete();

        return response()->json([
            'message' => 'Data gedung berhasil dihapus',
        ]);
    }
}