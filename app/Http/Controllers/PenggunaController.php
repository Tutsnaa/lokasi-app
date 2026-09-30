<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PenggunaController extends Controller
{
    // =========================================================
    // INDEX
    // =========================================================
    public function index()
    {
        $pengguna = Pengguna::orderBy('id', 'desc')->get();

        return view('pengguna.index', compact('pengguna'));
    }


    // =========================================================
    // CREATE
    // =========================================================
    public function create()
    {
        return view('pengguna.create');
    }


    // =========================================================
    // STORE
    // =========================================================
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:pengguna,email',
            ],

            'no_telepon' => [
                'nullable',
                'string',
                'max:20',
            ],

            'alamat' => [
                'nullable',
                'string',
            ],

            'nama_pengguna' => [
                'required',
                'string',
                'max:100',
                'unique:pengguna,nama_pengguna',
            ],

            'kata_sandi' => [
                'required',
                'string',
                'min:6',
            ],

            'role' => [
                'required',
                Rule::in([
                    'admin',
                    'karyawan',
                ]),
            ],

            'status' => [
                'required',
                Rule::in([
                    'aktif',
                    'nonaktif',
                ]),
            ],

            'foto' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);


        // =====================================================
        // UPLOAD FOTO
        // =====================================================
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request
                ->file('foto')
                ->store('pengguna', 'public');
        }


        // =====================================================
        // HASH PASSWORD
        // =====================================================
        $validated['kata_sandi'] = Hash::make(
            $validated['kata_sandi']
        );


        // =====================================================
        // TIMESTAMP
        // =====================================================
        $validated['tanggal_dibuat'] = now();
        $validated['tanggal_diubah'] = now();


        // =====================================================
        // SIMPAN DATA
        // =====================================================
        Pengguna::create($validated);


        return redirect()
            ->route('pengguna.index')
            ->with(
                'success',
                'Data pengguna berhasil ditambahkan.'
            );
    }


    // =========================================================
    // SHOW
    // =========================================================
    public function show(Pengguna $pengguna)
    {
        return view(
            'pengguna.show',
            compact('pengguna')
        );
    }


    // =========================================================
    // EDIT
    // =========================================================
    public function edit(Pengguna $pengguna)
    {
        return view(
            'pengguna.edit',
            compact('pengguna')
        );
    }


    // =========================================================
    // UPDATE
    // =========================================================
    public function update(
        Request $request,
        Pengguna $pengguna
    ) {
        $validated = $request->validate([
            'nama' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('pengguna', 'email')
                    ->ignore($pengguna->id),
            ],

            'no_telepon' => [
                'nullable',
                'string',
                'max:20',
            ],

            'alamat' => [
                'nullable',
                'string',
            ],

            'nama_pengguna' => [
                'required',
                'string',
                'max:100',
                Rule::unique('pengguna', 'nama_pengguna')
                    ->ignore($pengguna->id),
            ],

            'kata_sandi' => [
                'nullable',
                'string',
                'min:6',
            ],

            'role' => [
                'required',
                Rule::in([
                    'admin',
                    'karyawan',
                ]),
            ],

            'status' => [
                'required',
                Rule::in([
                    'aktif',
                    'nonaktif',
                ]),
            ],

            'foto' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);


        // =====================================================
        // UPLOAD FOTO BARU
        // =====================================================
        if ($request->hasFile('foto')) {

            // Hapus foto lama
            if (
                !empty($pengguna->foto) &&
                Storage::disk('public')->exists($pengguna->foto)
            ) {
                Storage::disk('public')->delete($pengguna->foto);
            }

            // Simpan foto baru
            $validated['foto'] = $request
                ->file('foto')
                ->store('pengguna', 'public');
        }


        // =====================================================
        // PASSWORD
        // =====================================================
        if (
            isset($validated['kata_sandi']) &&
            $validated['kata_sandi'] !== ''
        ) {
            $validated['kata_sandi'] = Hash::make(
                $validated['kata_sandi']
            );
        } else {
            unset($validated['kata_sandi']);
        }


        // =====================================================
        // TIMESTAMP
        // =====================================================
        $validated['tanggal_diubah'] = now();


        // =====================================================
        // UPDATE DATA
        // =====================================================
        $pengguna->update($validated);


        return redirect()
            ->route('pengguna.index')
            ->with(
                'success',
                'Data pengguna berhasil diperbarui.'
            );
    }


    // =========================================================
    // DESTROY
    // =========================================================
    public function destroy(Pengguna $pengguna)
    {
        // Hapus foto pengguna
        if (
            !empty($pengguna->foto) &&
            Storage::disk('public')->exists($pengguna->foto)
        ) {
            Storage::disk('public')->delete($pengguna->foto);
        }


        // Hapus data pengguna
        $pengguna->delete();


        return redirect()
            ->route('pengguna.index')
            ->with(
                'success',
                'Data pengguna berhasil dihapus.'
            );
    }
}