<?php

namespace App\Http\Controllers;

use App\Models\Gedung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class GedungController extends Controller
{
    /**
     * Tampilkan semua data gedung.
     */
    public function index()
{
    // Mengambil semua data gedung
    $gedung = Gedung::all();

    // Mengembalikan tampilan file blade di resources/views/gedung/index.blade.php
    return view('gedung.index', compact('gedung'));
}

    // Detail gedung berdasarkan ID
    public function show($id)
    {
        $gedung = Gedung::findOrFail($id);
        return view('gedung.show', compact('gedung'));
    }
    

    public function create()
{
    return view('gedung.create');
}

    /**
     * Simpan data gedung baru.
     */
  public function store(Request $request)
{
    // 1. Validasi input awal (memastikan koordinat diisi dan formatnya mengandung koma)
    $request->validate([
        'nama_gedung' => 'required|string|max:225',
        'koordinat'   => ['required', 'string', 'regex:/^[-+]?[0-9]*\.?[0-9]+,\s*[-+]?[0-9]*\.?[0-9]+$/'],
        'keterangan'  => 'nullable|string',
        'foto'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
    ], [
        'koordinat.regex' => 'Format koordinat tidak valid. Gunakan format: Latitude, Longitude (contoh: -8.613462, 115.186353)',
    ]);

    // 2. Pecah string koordinat menjadi latitude dan longitude
    $coords = explode(',', $request->koordinat);
    $latitude = trim($coords[0] ?? '');
    $longitude = trim($coords[1] ?? '');

    // 3. Validasi range angka latitude & longitude
    $validator = Validator::make([
        'latitude'  => $latitude,
        'longitude' => $longitude,
    ], [
        'latitude'  => 'required|numeric|between:-90,90',
        'longitude' => 'required|numeric|between:-180,180',
    ]);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    // 4. Siapkan data untuk disimpan ke database
    $data = [
        'nama_gedung' => $request->nama_gedung,
        'latitude'    => $latitude,
        'longitude'   => $longitude,
        'keterangan'  => $request->keterangan,
    ];

    // 5. Upload foto jika ada
    if ($request->hasFile('foto')) {
        $data['foto'] = $request->file('foto')->store('gedung', 'public');
    }

    // 6. Simpan ke database
    Gedung::create($data);

    // 7. Redirect ke halaman index dengan pesan sukses
    return redirect()->route('gedung.index')->with('success', 'Data gedung berhasil ditambahkan!');
}
    /**
     * Tampilkan detail satu gedung.
     */
//     public function show($id)
// {
//     $gedung = Gedung::find($id);

//     if (!$gedung) {
//         return response()->json([
//             'success' => false,
//             'message' => 'Data gedung dengan ID ' . $id . ' tidak ditemukan'
//         ], 404);
//     }

//     return response()->json([
//         'success' => true,
//         'data'    => $gedung
//     ], 200);
// }

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