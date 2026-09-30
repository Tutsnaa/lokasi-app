@extends('layouts.app')

@section('title', 'Detail Ruangan - ' . $ruangan->nama_ruangan)

@section('content')
<div class="container my-5">
    <!-- Tombol Kembali di Pojok Kiri Atas -->
    <div class="mb-3">
        <a href="{{ route('ruangan.index') }}" class="btn btn-outline-secondary">&larr; Kembali ke Daftar Ruangan</a>
    </div>

    <!-- Judul Halaman -->
    <h2 class="fw-bold text-dark mb-4">{{ $ruangan->nama_ruangan }}</h2>

    <!-- Content Halaman Langsung Tanpa Card -->
    <div class="row">
        <!-- Kolom Foto Ruangan -->
        <div class="col-md-5 mb-4 mb-md-0">
            @if($ruangan->foto)
            <img src="{{ asset('storage/' . $ruangan->foto) }}" alt="{{ $ruangan->nama_ruangan }}"
                class="img-fluid rounded-3 shadow-sm w-100 object-fit-cover" style="max-height: 400px;">
            @else
            <div class="bg-light rounded-3 border d-flex align-items-center justify-content-center text-muted"
                style="height: 300px;">
                <span>Tidak ada foto ruangan tersedia</span>
            </div>
            @endif
        </div>

        <!-- Kolom Detail Informasi -->
        <div class="col-md-7">
            <!-- 1. Informasi Ruangan -->
            <h4 class="mb-3 text-primary fw-bold">Detail Ruangan</h4>

            <table class="table table-borderless fs-6 mb-4">
                <tbody>
                    <tr>
                        <td class="fw-semibold text-secondary" style="width: 160px;">Nama Ruangan</td>
                        <td>: {{ $ruangan->nama_ruangan }}</td>
                    </tr>
                    <tr>
                        <td class="fw-semibold text-secondary">Posisi Lantai</td>
                        <td>: <span class="badge bg-secondary-subtle text-dark border">Lantai
                                {{ $ruangan->lantai }}</span></td>
                    </tr>
                    <tr>
                        <td class="fw-semibold text-secondary">Keterangan</td>
                        <td>: {{ $ruangan->keterangan ?? 'Tidak ada keterangan' }}</td>
                    </tr>
                </tbody>
            </table>

            <hr class="my-4 text-muted">

            <!-- 2. Informasi Gedung Tempat Ruangan Berada -->
            <h4 class="mb-3 text-primary fw-bold">Gedung Tempat Ruangan Berada</h4>

            @if($ruangan->gedung)
            <table class="table table-borderless fs-6">
                <tbody>
                    <tr>
                        <td class="fw-semibold text-secondary" style="width: 160px;">Nama Gedung</td>
                        <td>:
                            <a href="{{ route('gedung.show', $ruangan->gedung->id) }}"
                                class="fw-bold text-decoration-none">
                                🏢 {{ $ruangan->gedung->nama_gedung }}
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-semibold text-secondary">Koordinat Gedung</td>
                        <td>: {{ $ruangan->gedung->latitude }}, {{ $ruangan->gedung->longitude }}</td>
                    </tr>
                    <tr>
                        <td class="fw-semibold text-secondary">Google Maps</td>
                        <td>:
                            <a href="https://www.google.com/maps/search/?api=1&query={{ $ruangan->gedung->latitude }},{{ $ruangan->gedung->longitude }}"
                                target="_blank" class="btn btn-sm btn-outline-primary">
                                📍 Buka Lokasi Gedung
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
            @else
            <div class="alert alert-warning py-2 rounded-3" role="alert">
                Data gedung untuk ruangan ini tidak ditemukan.
            </div>
            @endif
        </div>
    </div>
</div>
@endsection