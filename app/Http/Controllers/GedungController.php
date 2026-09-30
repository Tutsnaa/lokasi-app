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
        $gedung = Gedung::all();
        return view('gedung.index', compact('gedung'));
    }

    /**
     * Detail gedung berdasarkan ID.
     */
    public function show($id)
    {
        $gedung = Gedung::findOrFail($id);
        return view('gedung.show', compact('gedung'));
    }

    /**
     * Form tambah gedung.
     */
    public function create()
    {
        return view('gedung.create');
    }

    /**
     * Simpan data gedung baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_gedung' => 'required|string|max:225',
            'koordinat'   => ['required', 'string', 'regex:/^[-+]?[0-9]*\.?[0-9]+,\s*[-+]?[0-9]*\.?[0-9]+$/'],
            'keterangan'  => 'nullable|string',
            'foto'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'koordinat.regex' => 'Format koordinat tidak valid. Gunakan format: Latitude, Longitude (contoh: -8.613462, 115.186353)',
        ]);

        $coords = explode(',', $request->koordinat);
        $latitude = trim($coords[0] ?? '');
        $longitude = trim($coords[1] ?? '');

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

        $data = [
            'nama_gedung' => $request->nama_gedung,
            'latitude'    => $latitude,
            'longitude'   => $longitude,
            'keterangan'  => $request->keterangan,
        ];

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('gedung', 'public');
        }

        Gedung::create($data);

        return redirect()->route('gedung.index')->with('success', 'Data gedung berhasil ditambahkan!');
    }

    /**
     * Tampilkan form edit data gedung.
     */
    public function edit($id)
    {
        $gedung = Gedung::findOrFail($id);
        return view('gedung.update', compact('gedung'));
    }

    /**
     * Update data gedung.
     */
    public function update(Request $request, $id)
    {
        $gedung = Gedung::findOrFail($id);

        // Validasi input
        $request->validate([
            'nama_gedung' => 'required|string|max:225',
            'koordinat'   => ['required', 'string', 'regex:/^[-+]?[0-9]*\.?[0-9]+,\s*[-+]?[0-9]*\.?[0-9]+$/'],
            'keterangan'  => 'nullable|string',
            'foto'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'koordinat.regex' => 'Format koordinat tidak valid. Gunakan format: Latitude, Longitude (contoh: -8.613462, 115.186353)',
        ]);

        // Pecah koordinat
        $coords = explode(',', $request->koordinat);
        $latitude = trim($coords[0] ?? '');
        $longitude = trim($coords[1] ?? '');

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

        $data = [
            'nama_gedung' => $request->nama_gedung,
            'latitude'    => $latitude,
            'longitude'   => $longitude,
            'keterangan'  => $request->keterangan,
        ];

        // Upload foto baru jika ada dan hapus foto lama
        if ($request->hasFile('foto')) {
            if ($gedung->foto && Storage::disk('public')->exists($gedung->foto)) {
                Storage::disk('public')->delete($gedung->foto);
            }
            $data['foto'] = $request->file('foto')->store('gedung', 'public');
        }

        $gedung->update($data);

        return redirect()->route('gedung.index')->with('success', 'Data gedung berhasil diperbarui!');
    }

    /**
     * Hapus data gedung.
     */
    public function destroy($id)
    {
        $gedung = Gedung::findOrFail($id);

        if ($gedung->foto && Storage::disk('public')->exists($gedung->foto)) {
            Storage::disk('public')->delete($gedung->foto);
        }

        $gedung->delete();

        return redirect()->route('gedung.index')->with('success', 'Data gedung berhasil dihapus!');
    }
}