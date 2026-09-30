@extends('layouts.app')

@section('title', 'Edit Ruangan')

@section('content')
<div class="py-3">
    <!-- Tombol Kembali ke Dashboard -->
    <div class="mb-3">
        <a href="{{ route('admin.home') }}"
            class="btn btn-sm btn-outline-secondary d-inline-flex align-items-center gap-2">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali ke Dashboard
        </a>
    </div>

    <!-- Header Halaman -->
    <div class="mb-4">
        <h2 class="h4 fw-bold text-dark mb-1">Edit Data Ruangan</h2>
        <p class="text-secondary small mb-0">Perbarui informasi ruangan yang tersimpan dalam sistem.</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <!-- Card Header -->
                <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-1 fw-semibold">Informasi Ruangan</h5>
                        <small class="text-secondary">Ubah data ruangan sesuai informasi terbaru.</small>
                    </div>

                    <a href="{{ route('ruangan.index') }}" class="btn btn-sm btn-outline-secondary">
                        Kembali
                    </a>
                </div>

                <div class="card-body p-4">
                    @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                        <div class="d-flex align-items-center gap-2">
                            <svg width="18" height="18" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414-1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span>{{ session('error') }}</span>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <form action="{{ route('ruangan.update', $ruangan->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Pilih Gedung -->
                        <div class="mb-3">
                            <label for="id_gedung" class="form-label fw-semibold">
                                Pilih Gedung <span class="text-danger">*</span>
                            </label>
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

                        <!-- Nama Ruangan -->
                        <div class="mb-3">
                            <label for="nama_ruangan" class="form-label fw-semibold">
                                Nama Ruangan <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('nama_ruangan') is-invalid @enderror"
                                id="nama_ruangan" name="nama_ruangan"
                                value="{{ old('nama_ruangan', $ruangan->nama_ruangan) }}"
                                placeholder="Contoh: Lab Komputer 1" required>
                            @error('nama_ruangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Lantai -->
                        <div class="mb-3">
                            <label for="lantai" class="form-label fw-semibold">
                                Lantai <span class="text-danger">*</span>
                            </label>
                            <input type="number" class="form-control @error('lantai') is-invalid @enderror" id="lantai"
                                name="lantai" value="{{ old('lantai', $ruangan->lantai) }}" min="1"
                                placeholder="Masukkan nomor lantai" required>
                            @error('lantai')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Keterangan -->
                        <div class="mb-3">
                            <label for="keterangan" class="form-label fw-semibold">Keterangan</label>
                            <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan"
                                name="keterangan" rows="3"
                                placeholder="Tambahkan catatan atau fasilitas ruangan (opsional)">{{ old('keterangan', $ruangan->keterangan) }}</textarea>
                            @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Foto Ruangan -->
                        <div class="mb-4">
                            <label for="foto" class="form-label fw-semibold">Foto Ruangan</label>

                            @if ($ruangan->foto)
                            <div class="mb-3">
                                <div class="border rounded p-2 d-inline-block bg-light">
                                    <img src="{{ asset('storage/' . $ruangan->foto) }}"
                                        alt="{{ $ruangan->nama_ruangan }}" class="img-fluid rounded"
                                        style="max-width: 300px; max-height: 180px; object-fit: cover;">
                                </div>
                            </div>
                            @endif

                            <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto"
                                name="foto" accept="image/*">

                            <div class="form-text">
                                Biarkan kosong jika tidak ingin mengubah foto ruangan.
                            </div>

                            @error('foto')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="border-top pt-3 d-flex justify-content-end gap-2">
                            <a href="{{ route('ruangan.index') }}" class="btn btn-light border">
                                Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection