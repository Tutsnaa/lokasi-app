@extends('layouts.app') {{-- Sesuaikan nama layout utama Anda --}}

@section('title', 'Tambah Data Gedung')

@push('styles')
<style>
#map {
    height: 380px;
    width: 100%;
    border-radius: 8px;
    border: 1px solid #dee2e6;
}
</style>
@endpush

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-xl-10">

            <!-- Header Halaman -->
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h1 class="h3 mb-1 text-gray-800 fw-bold">Tambah Gedung Baru</h1>
                    <p class="text-muted mb-0">Isi formulir dan masukkan titik koordinat gedung.</p>
                </div>
                <a href="{{ route('gedung.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>

            <!-- Card Form Utama -->
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-4 p-md-5">

                    {{-- Alert jika terdapat Error Validasi --}}
                    @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                        <strong>Terjadi Kesalahan!</strong>
                        <ul class="mb-0 mt-1 ps-3">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <form action="{{ route('gedung.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-4">
                            <!-- Kolom Kiri: Input Teks & Upload Foto -->
                            <div class="col-lg-6 d-flex flex-column gap-3">

                                <!-- Nama Gedung -->
                                <div>
                                    <label for="nama_gedung" class="form-label fw-semibold">Nama Gedung <span
                                            class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control form-control-lg @error('nama_gedung') is-invalid @enderror"
                                        id="nama_gedung" name="nama_gedung" value="{{ old('nama_gedung') }}"
                                        placeholder="Contoh: Gedung Rektorat / Gedung A" required>
                                    @error('nama_gedung')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Keterangan / Deskripsi -->
                                <div>
                                    <label for="keterangan" class="form-label fw-semibold">Keterangan /
                                        Deskripsi</label>
                                    <textarea class="form-control @error('keterangan') is-invalid @enderror"
                                        id="keterangan" name="keterangan" rows="4"
                                        placeholder="Tuliskan fasilitas, jumlah lantai, atau informasi relevan lainnya (opsional)...">{{ old('keterangan') }}</textarea>
                                    @error('keterangan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Upload Foto Gedung -->
                                <div>
                                    <label for="foto" class="form-label fw-semibold">Foto Gedung</label>
                                    <input class="form-control @error('foto') is-invalid @enderror" type="file"
                                        id="foto" name="foto" accept="image/jpeg,image/png,image/jpg,image/webp"
                                        onchange="previewImage(event)">
                                    <div class="form-text">Format: JPG, JPEG, PNG, WEBP. Maksimal ukuran 2MB.</div>
                                    @error('foto')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                    <!-- Container Preview Foto -->
                                    <div id="preview-wrapper" class="mt-3 d-none">
                                        <p class="small text-muted mb-1 fw-semibold">Preview Foto:</p>
                                        <img id="img-preview" src="#" alt="Preview"
                                            class="img-fluid rounded border shadow-sm"
                                            style="max-height: 220px; object-fit: cover;">
                                    </div>
                                </div>

                            </div>

                            <!-- Kolom Kanan: Single Input Titik Koordinat & Preview Peta -->
                            <div class="col-lg-6 d-flex flex-column gap-3">

                                <!-- Single Input Titik Koordinat -->
                                <div>
                                    <label for="koordinat" class="form-label fw-semibold">Titik Koordinat <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('koordinat') is-invalid @enderror"
                                        id="koordinat" name="koordinat" placeholder="Contoh: -8.613462, 115.186353"
                                        oninput="updateMapFromInput()" required>
                                    <div class="form-text">Format: <code>Latitude, Longitude</code> (Salin langsung dari
                                        Google Maps).</div>
                                    @error('koordinat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Container Preview Peta Google Maps & Link Cek -->
                                <div>
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <label class="form-label fw-semibold mb-0">Preview Lokasi Peta</label>

                                        <!-- Tombol Link Cek Google Maps -->
                                        <a id="btn-gmaps"
                                            href="https://www.google.com/maps/search/?api=1&query=-8.613462165489894,115.18635309462111"
                                            target="_blank" class="btn btn-sm btn-outline-primary">
                                            📍 Cek di Google Maps
                                        </a>
                                    </div>

                                    <div id="map"></div>
                                    <div class="form-text mt-1">
                                        Peta akan otomatis menampilkan marker sesuai nilai koordinat di atas.
                                    </div>
                                </div>

                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Tombol Aksi -->
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('gedung.index') }}" class="btn btn-light px-4">Batal</a>
                            <button type="submit" class="btn btn-primary px-4 fw-semibold">
                                Simpan Data Gedung
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Google Maps JS API -->
<!-- GANTI YOUR_API_KEY DENGAN API KEY GOOGLE MAPS ANDA -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap" async defer></script>

<script>
let map, marker;

// Fungsi untuk memisahkan string "lat, lng"
function parseCoordinates(coordString) {
    if (!coordString) return null;
    const parts = coordString.split(',');
    if (parts.length === 2) {
        const lat = parseFloat(parts[0].trim());
        const lng = parseFloat(parts[1].trim());
        if (!isNaN(lat) && !isNaN(lng) && lat >= -90 && lat <= 90 && lng >= -180 && lng <= 180) {
            return {
                lat: lat,
                lng: lng
            };
        }
    }
    return null;
}

function initMap() {
    const coordValue = document.getElementById("koordinat").value;
    const parsedLocation = parseCoordinates(coordValue) || {
        lat: -8.613462165489894,
        lng: 115.18635309462111
    };

    // 1. Inisialisasi Peta
    map = new google.maps.Map(document.getElementById("map"), {
        center: parsedLocation,
        zoom: 16,
        mapTypeControl: false,
        streetViewControl: false,
    });

    // 2. Marker Statis
    marker = new google.maps.Marker({
        position: parsedLocation,
        map: map,
        draggable: false,
        title: "Lokasi Gedung"
    });
}

// Fungsi update lokasi peta dari 1 input koordinat
function updateMapFromInput() {
    const coordValue = document.getElementById("koordinat").value.trim();
    const btnGmaps = document.getElementById("btn-gmaps");
    const location = parseCoordinates(coordValue);

    // 1. Perbarui Link Google Maps
    if (coordValue && btnGmaps) {
        btnGmaps.href = `https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(coordValue)}`;
        btnGmaps.classList.remove('disabled');
    } else if (btnGmaps) {
        btnGmaps.classList.add('disabled');
    }

    // 2. Perbarui Marker Peta Preview
    if (location && map && marker) {
        marker.setPosition(location);
        map.setCenter(location);
    }
}

// Fungsi Preview Foto
function previewImage(event) {
    const input = event.target;
    const previewWrapper = document.getElementById('preview-wrapper');
    const previewImg = document.getElementById('img-preview');

    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            previewWrapper.classList.remove('d-none');
        }
        reader.readAsDataURL(input.files[0]);
    } else {
        previewImg.src = '#';
        previewWrapper.classList.add('d-none');
    }
}
</script>
@endpush