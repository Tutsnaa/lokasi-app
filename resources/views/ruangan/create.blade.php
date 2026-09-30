@extends('layouts.app')

@section('title', 'Tambah Ruangan Baru')

@section('content')
<div class="container my-5">
    <!-- Tombol Kembali di Pojok Kiri Atas -->
    <div class="mb-3">
        <a href="{{ route('ruangan.index') }}" class="btn btn-outline-secondary">&larr; Kembali ke Daftar Ruangan</a>
    </div>

    <!-- Judul Halaman -->
    <h2 class="fw-bold text-dark mb-4">Tambah Ruangan Baru</h2>

    <div class="row">
        <div class="col-lg-8">
            <form action="{{ route('ruangan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Pilihan Gedung (Dropdown) -->
                <div class="mb-3">
                    <label for="id_gedung" class="form-label fw-semibold">Pilih Gedung <span
                            class="text-danger">*</span></label>
                    <select class="form-select @error('id_gedung') is-invalid @enderror" id="id_gedung" name="id_gedung"
                        required>
                        <option value="" disabled selected>-- Pilih Gedung --</option>
                        @foreach($gedung as $item)
                        <option value="{{ $item->id }}" {{ old('id_gedung') == $item->id ? 'selected' : '' }}>
                            {{ $item->nama_gedung }}
                        </option>
                        @endforeach
                    </select>
                    @error('id_gedung')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Nama Ruangan -->
                <div class="mb-3">
                    <label for="nama_ruangan" class="form-label fw-semibold">Nama Ruangan <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nama_ruangan') is-invalid @enderror"
                        id="nama_ruangan" name="nama_ruangan" value="{{ old('nama_ruangan') }}"
                        placeholder="Masukkan nama ruangan (contoh: Ruang Rapat A)" required>
                    @error('nama_ruangan')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Lantai -->
                <div class="mb-3">
                    <label for="lantai" class="form-label fw-semibold">Lantai <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('lantai') is-invalid @enderror" id="lantai"
                        name="lantai" value="{{ old('lantai', 1) }}" placeholder="Contoh: 1, 2, 3" min="0" required>
                    @error('lantai')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Keterangan -->
                <div class="mb-3">
                    <label for="keterangan" class="form-label fw-semibold">Keterangan</label>
                    <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan"
                        name="keterangan" rows="3"
                        placeholder="Keterangan tambahan atau fasilitas ruangan (opsional)">{{ old('keterangan') }}</textarea>
                    @error('keterangan')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Upload Foto -->
                <div class="mb-4">
                    <label for="foto" class="form-label fw-semibold">Foto Ruangan</label>
                    <input class="form-control @error('foto') is-invalid @enderror" type="file" id="foto" name="foto"
                        accept="image/*" onchange="previewImage(event)">
                    <small class="text-muted">Format yang didukung: JPG, JPEG, PNG, GIF (Maks. 2MB)</small>
                    @error('foto')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror

                    <!-- Preview Foto -->
                    <div class="mt-3">
                        <img id="image-preview" src="#" alt="Preview Foto" class="img-fluid rounded-3 shadow-sm d-none"
                            style="max-height: 250px; object-fit: cover;">
                    </div>
                </div>

                <!-- Tombol Submit & Batal -->
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-4">Simpan Ruangan</button>
                    <a href="{{ route('ruangan.index') }}" class="btn btn-outline-secondary px-4">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Fungsi JavaScript untuk Preview Image sebelum diupload
function previewImage(event) {
    const input = event.target;
    const preview = document.getElementById('image-preview');

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('d-none');
        }

        reader.readAsDataURL(input.files[0]);
    } else {
        preview.src = '#';
        preview.classList.add('d-none');
    }
}
</script>
@endpush