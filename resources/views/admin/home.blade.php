@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')

<div class="py-3">

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Card Banner -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">
            <h2 class="h5 fw-semibold text-dark mb-2">
                Selamat Datang di Halaman Utama Admin
            </h2>

            <p class="text-secondary small mb-0">
                Anda berhasil masuk dengan akun
                <strong>
                    {{ Auth::check() ? Auth::user()->email : 'Admin' }}
                </strong>.
            </p>
        </div>
    </div>

    <!-- Menu Akses Cepat -->
    <div class="row g-4">

        <!-- Data Gedung -->
        <div class="col-12 col-md-4">
            <a href="{{ route('gedung.index') }}" class="text-decoration-none">
                <div class="card h-100 border shadow-sm">
                    <div class="card-body p-4">

                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="bg-primary bg-opacity-10 text-primary rounded p-3">
                                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m0 0h5m-5 0V11m0 5h5">
                                    </path>
                                </svg>
                            </div>

                            <span class="text-primary small fw-semibold">
                                Kelola →
                            </span>
                        </div>

                        <h3 class="h6 fw-semibold text-dark">
                            Data Gedung
                        </h3>

                        <p class="text-secondary small mb-0">
                            Kelola informasi gedung dan lokasi fasilitas.
                        </p>

                    </div>
                </div>
            </a>
        </div>

        <!-- Data Ruangan -->
        <div class="col-12 col-md-4">
            <a href="{{ route('ruangan.index') }}" class="text-decoration-none">
                <div class="card h-100 border shadow-sm">
                    <div class="card-body p-4">

                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="bg-primary bg-opacity-10 text-primary rounded p-3">
                                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z">
                                    </path>
                                </svg>
                            </div>

                            <span class="text-primary small fw-semibold">
                                Kelola →
                            </span>
                        </div>

                        <h3 class="h6 fw-semibold text-dark">
                            Data Ruangan
                        </h3>

                        <p class="text-secondary small mb-0">
                            Kelola ruangan yang tersedia pada setiap gedung.
                        </p>

                    </div>
                </div>
            </a>
        </div>

        <!-- Pencarian -->
        <div class="col-12 col-md-4">
            <a href="{{ url('/') }}" class="text-decoration-none">
                <div class="card h-100 border shadow-sm">
                    <div class="card-body p-4">

                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="bg-primary bg-opacity-10 text-primary rounded p-3">
                                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-4.35-4.35m2.35-5.65a8 8 0 11-16 0 8 8 0 0116 0z">
                                    </path>
                                </svg>
                            </div>

                            <span class="text-primary small fw-semibold">
                                Cari →
                            </span>
                        </div>

                        <h3 class="h6 fw-semibold text-dark">
                            Pencarian
                        </h3>

                        <p class="text-secondary small mb-0">
                            Cari informasi gedung dan ruangan berdasarkan nama.
                        </p>

                    </div>
                </div>
            </a>
        </div>

    </div>

</div>

@endsection