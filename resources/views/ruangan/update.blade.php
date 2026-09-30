@extends('layouts.app')

@section('title', 'Edit Ruangan')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3">
                    <h5 class="mb-0 fw-bold">Edit Data Ruangan</h5>
                    <a href="{{ route('ruangan.index') }}" class="btn btn-sm btn-light shadow-sm">Kembali</a>
                </div>

                <div class="card-body p-4">
                    {{-- Alert jika ada pesan error umum --}}
                    @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <form action="{{ route('ruangan.update', $ruangan->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Pilih Gedung --}}
                        <div class="mb-3">
                            <label for="id_gedung" class="form-label fw-semibold">Pilih Gedung <span
                                    class="text-danger">*</span></label>
                            <select class="form-select @error('id_gedung') is-invalid @enderror" id="id_gedung"
                                name="id_gedung" required>
                                <option value="" disabled>-- Pilih Gedung --</option>
                                @foreach($gedung as $g)
                                <option value="{{ $g->id }}"
                                    {{ old('id_gedung', $ruangan->id_gedung) == $g->id ? 'selected' : '' }}>
                                    {{ $g->nama_gedung }}
                                </option>
                                @endforeach
                            </select>
                            @error('id_gedung')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Nama Ruangan --}}
                        <div class="mb-3">
                            <label for="nama_ruangan" class="form-label fw-semibold">Nama Ruangan <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama_ruangan') is-invalid @enderror"
                                id="nama_ruangan" name="nama_ruangan"
                                value="{{ old('nama_ruangan', $ruangan->nama_ruangan) }}"
                                placeholder="Contoh: Lab Komputer 1" required>
                            @error('nama_ruangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Lantai --}}
                        <div class="mb-3">
                            <label for="lantai" class="form-label fw-semibold">Lantai <span
                                    class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('lantai') is-invalid @enderror" id="lantai"
                                name="lantai" value="{{ old('lantai', $ruangan->lantai) }}" min="1" required>
                            @error('lantai')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Keterangan --}}
                        <div class="mb-3">
                            <label for="keterangan" class="form-label fw-semibold">Keterangan</label>
                            <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan"
                                name="keterangan" rows="3"
                                placeholder="Tambahkan catatan atau fasilitas ruangan (opsional)">{{ old('keterangan', $ruangan->keterangan) }}</textarea>
                            @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Foto Ruangan --}}
                        <div class="mb-4">
                            <label for="foto" class="form-label fw-semibold">Foto Ruangan</label>

                            {{-- Preview Foto Lama --}}
                            @if ($ruangan->foto)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $ruangan->foto) }}" alt="{{ $ruangan->nama_ruangan }}"
                                    class="img-thumbnail rounded-3 shadow-sm" style="max-height: 150px;">
                            </div>
                            @endif

                            <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto"
                                name="foto" accept="image/*">
                            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto.</small>
                            @error('foto')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('ruangan.index') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary shadow-sm">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection