<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use App\Models\Gedung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RuanganController extends Controller
{
    /**
     * Menampilkan daftar semua ruangan
     */
    public function index()
    {
        $ruangan = Ruangan::with('gedung')->latest()->get();
        return view('ruangan.index', compact('ruangan'));
    }

    /**
     * Menampilkan form untuk membuat ruangan baru
     */
    public function create()
    {
        $gedung = Gedung::all();
        return view('ruangan.create', compact('gedung'));
    }

    /**
     * Menyimpan data ruangan baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_gedung'    => 'required|exists:gedung,id',
            'nama_ruangan' => 'required|string|max:225',
            'lantai'       => 'required|integer|min:1',
            'keterangan'   => 'nullable|string',
            'foto'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->only(['id_gedung', 'nama_ruangan', 'lantai', 'keterangan']);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('ruangan', 'public');
        }

        Ruangan::create($data);

        return redirect()->route('ruangan.index')
                         ->with('success', 'Ruangan berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail ruangan tertentu
     */
    public function show($id)
    {
        $ruangan = Ruangan::with('gedung')->findOrFail($id);
        return view('ruangan.show', compact('ruangan'));
    }

    /**
     * Menampilkan form edit ruangan
     */
    public function edit($id)
    {
        $ruangan = Ruangan::findOrFail($id);
        $gedung = Gedung::all();
        return view('ruangan.update', compact('ruangan', 'gedung'));
    }

    /**
     * Memperbarui data ruangan di database
     */
    public function update(Request $request, $id)
    {
        $ruangan = Ruangan::findOrFail($id);

        $request->validate([
            'id_gedung'    => 'required|exists:gedung,id',
            'nama_ruangan' => 'required|string|max:225',
            'lantai'       => 'required|integer|min:1',
            'keterangan'   => 'nullable|string',
            'foto'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->only(['id_gedung', 'nama_ruangan', 'lantai', 'keterangan']);

        if ($request->hasFile('foto')) {
            if ($ruangan->foto && Storage::disk('public')->exists($ruangan->foto)) {
                Storage::disk('public')->delete($ruangan->foto);
            }
            $data['foto'] = $request->file('foto')->store('ruangan', 'public');
        }

        $ruangan->update($data);

        return redirect()->route('ruangan.index')
                         ->with('success', 'Data ruangan berhasil diperbarui.');
    }

    /**
     * Menghapus ruangan dari database beserta fotonya
     */
    public function destroy($id)
    {
        $ruangan = Ruangan::findOrFail($id);

        if ($ruangan->foto && Storage::disk('public')->exists($ruangan->foto)) {
            Storage::disk('public')->delete($ruangan->foto);
        }

        $ruangan->delete();

        return redirect()->route('ruangan.index')
                         ->with('success', 'Ruangan berhasil dihapus.');
    }
}