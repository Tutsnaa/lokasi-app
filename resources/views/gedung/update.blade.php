@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Edit Data Gedung</h5>
                    <a href="{{ route('gedung.index') }}" class="btn btn-sm btn-light">Kembali</a>
                </div>

                <div class="card-body">
                    @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <form action="{{ route('gedung.update', $gedung->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Nama Gedung --}}
                        <div class="mb-3">
                            <label for="nama_gedung" class="form-label">Nama Gedung <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama_gedung') is-invalid @enderror"
                                id="nama_gedung" name="nama_gedung"
                                value="{{ old('nama_gedung', $gedung->nama_gedung) }}" required>
                            @error('nama_gedung')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Koordinat (Latitude, Longitude) --}}
                        <div class="mb-3">
                            <label for="koordinat" class="form-label">Koordinat (Latitude, Longitude) <span
                                    class="text-danger">*</span></label>
                            <input type="text"
                                class="form-control @error('koordinat') is-invalid @enderror @error('latitude') is-invalid @enderror @error('longitude') is-invalid @enderror"
                                id="koordinat" name="koordinat" placeholder="Contoh: -8.613462, 115.186353"
                                value="{{ old('koordinat', $gedung->latitude && $gedung->longitude ? $gedung->latitude . ', ' . $gedung->longitude : '') }}"
                                required>
                            @error('koordinat')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @error('latitude')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @error('longitude')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Keterangan --}}
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan"
                                name="keterangan" rows="3">{{ old('keterangan', $gedung->keterangan) }}</textarea>
                            @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Foto Gedung --}}
                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto Gedung</label>

                            @if ($gedung->foto)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $gedung->foto) }}" alt="Foto Gedung"
                                    class="img-thumbnail" style="max-height: 150px;">
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
                            <a href="{{ route('gedung.index') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection