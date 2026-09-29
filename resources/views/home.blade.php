@extends('layouts.app')

@section('title', 'Halaman Utama')

@section('content')
<style>
/* Mengatur container agar persis di tengah layar (vertikal & horizontal) */
.hero-container {
    min-height: 80vh;
    /* Mengisi tinggi layar tanpa scrollbar berlebih */
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

/* Style kotak pencarian bergaya Google */
.search-box {
    width: 100%;
    max-width: 580px;
    /* Lebar maksimal mirip Google */
    position: relative;
}

.search-input {
    width: 100%;
    padding: 14px 20px 14px 45px;
    /* Space di kiri untuk ikon kaca pembesar */
    font-size: 16px;
    border: 1px solid #dfe1e5;
    border-radius: 24px;
    /* Sudut melengkung halus */
    outline: none;
    transition: all 0.2s ease-in-out;
    box-shadow: 0 1px 6px rgba(32, 33, 36, 0.1);
}

/* Efek hover & focus saat diklik */
.search-input:hover,
.search-input:focus {
    box-shadow: 0 1px 12px rgba(32, 33, 36, 0.2);
    border-color: transparent;
}

/* Ikon Kaca Pembesar di dalam Input */
.search-icon {
    position: absolute;
    left: 16px;
    top: 50%;
    transform: translateY(-50%);
    color: #9aa0a6;
    width: 18px;
    height: 18px;
}

/* Tombol Cari di Bawah Input */
.search-buttons {
    margin-top: 25px;
    display: flex;
    gap: 12px;
}

.btn-search {
    background-color: #f8f9fa;
    border: 1px solid #f8f9fa;
    border-radius: 4px;
    color: #3c4043;
    font-size: 14px;
    padding: 10px 20px;
    cursor: pointer;
    transition: all 0.15s ease;
}

.btn-search:hover {
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
    background-color: #f1f3f4;
    border-color: #dadce0;
    color: #202124;
}
</style>

<div class="hero-container">
    <!-- Judul / Logo Utama -->
    <h1 class="fw-bold mb-4 display-4 text-dark">Pencarian<span class="text-primary">Lokasi</span></h1>

    <!-- Form Pencarian -->
    <form action="{{ url('/gedung/search') }}" method="GET" class="search-box">
        <input type="text" name="q" class="search-input" placeholder="Cari nama gedung..." required>
        <div class="search-buttons justify-content-center">
            <button type="submit" class="btn-search">Cari Gedung</button>
        </div>
    </form>

    {{-- Pesan jika gedung tidak ditemukan --}}
    @if(session('error'))
    <div class="alert alert-danger mt-3 text-center">
        {{ session('error') }}
    </div>
    @endif
</div>
@endsection