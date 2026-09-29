@extends('layouts.app')

@section('title', 'Informasi Gedung - ' . $gedung->nama_gedung)

@section('content')
<div class="container my-5">
    <a href="{{ url('/') }}" class="btn btn-outline-secondary mb-4">&larr; Kembali ke Pencarian</a>

    <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
        <div class="card-header bg-primary text-white p-4">
            <h2 class="mb-0">{{ $gedung->nama_gedung }}</h2>
        </div>
        <div class="card-body p-4">
            <div class="row">
                <!-- Kolom Foto Gedung -->
                <div class="col-md-5 mb-4 mb-md-0">
                    @if($gedung->foto)
                    <img src="{{ asset('storage/' . $gedung->foto) }}" alt="{{ $gedung->nama_gedung }}"
                        class="img-fluid rounded-3 shadow-sm w-100 object-fit-cover" style="max-height: 350px;">
                    @else
                    <div class="bg-light rounded-3 d-flex align-items-center justify-content-center text-muted"
                        style="height: 250px;">
                        <span>Tidak ada foto tersedia</span>
                    </div>
                    @endif
                </div>

                <!-- Kolom Detail Informasi -->
                <div class="col-md-7">
                    <h4 class="mb-3 text-dark fw-bold">Detail Informasi</h4>

                    <table class="table table-borderless fs-6">
                        <tbody>
                            <tr>
                                <td class="fw-semibold text-secondary" style="width: 140px;">Nama Gedung</td>
                                <td>: {{ $gedung->nama_gedung }}</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold text-secondary">Koordinat</td>
                                <td>: {{ $gedung->latitude }}, {{ $gedung->longitude }}</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold text-secondary">Google Maps</td>
                                <td>:
                                    <a href="https://www.google.com/maps/search/?api=1&query={{ $gedung->latitude }},{{ $gedung->longitude }}"
                                        target="_blank" class="btn btn-sm btn-outline-primary">
                                        📍 Buka di Google Maps
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-semibold text-secondary">Keterangan</td>
                                <td>: {{ $gedung->keterangan ?? 'Tidak ada keterangan' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection