@extends('layouts.app')

@section('title', 'Hasil Pencarian - ' . $keyword)

@section('content')
<div class="container my-5">
    <!-- Tombol Kembali -->
    <div class="mb-4">
        <a href="{{ url('/') }}" class="btn btn-outline-secondary">&larr; Kembali ke Pencarian</a>
    </div>

    <h3 class="fw-bold mb-4">Hasil Pencarian untuk: <span class="text-primary">"{{ $keyword }}"</span></h3>

    <!-- 1. HASIL PENCARIAN RUANGAN -->
    <div class="mb-5">
        <h4 class="fw-bold text-dark border-bottom pb-2 mb-3">
            🚪 Ruangan <span class="badge bg-primary fs-6 ms-2">{{ $ruangan->count() }}</span>
        </h4>

        @if($ruangan->isNotEmpty())
        <div class="row">
            @foreach($ruangan as $item)
            <div class="col-md-6 col-lg-4 mb-3">
                <div class="card h-100 shadow-sm border rounded-3">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="card-title fw-bold text-primary mb-0">{{ $item->nama_ruangan }}</h5>
                                <span class="badge bg-secondary-subtle text-dark border">
                                    Lantai {{ $item->lantai }}
                                </span>
                            </div>

                            @if($item->gedung)
                            <p class="card-text text-muted mb-2">
                                🏢 Gedung: <strong>{{ $item->gedung->nama_gedung }}</strong>
                            </p>
                            @else
                            <p class="card-text text-danger small mb-2">
                                🏢 Gedung tidak terhubung
                            </p>
                            @endif

                            <p class="card-text text-secondary small">
                                {{ Str::limit($item->keterangan ?? 'Tidak ada keterangan', 70) }}
                            </p>
                        </div>

                        <div class="mt-3 pt-2 border-top">
                            <a href="{{ route('ruangan.show', $item->id) }}"
                                class="btn btn-sm btn-outline-primary w-100">
                                Lihat Detail Ruangan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <p class="text-muted fst-italic">Tidak ada ruangan yang cocok dengan kata kunci "{{ $keyword }}".</p>
        @endif
    </div>

    <!-- 2. HASIL PENCARIAN GEDUNG -->
    <div>
        <h4 class="fw-bold text-dark border-bottom pb-2 mb-3">
            🏢 Gedung <span class="badge bg-secondary fs-6 ms-2">{{ $gedung->count() }}</span>
        </h4>

        @if($gedung->isNotEmpty())
        <div class="row">
            @foreach($gedung as $item)
            <div class="col-md-6 col-lg-4 mb-3">
                <div class="card h-100 shadow-sm border rounded-3">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <h5 class="card-title fw-bold text-dark mb-2">{{ $item->nama_gedung }}</h5>
                            <p class="card-text text-muted small mb-2">
                                {{ Str::limit($item->keterangan ?? 'Tidak ada keterangan', 80) }}
                            </p>
                        </div>

                        <div class="mt-3 pt-2 border-top">
                            <a href="{{ route('gedung.show', $item->id) }}"
                                class="btn btn-sm btn-outline-secondary w-100">
                                Lihat Detail Gedung
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <p class="text-muted fst-italic">Tidak ada gedung yang cocok dengan kata kunci "{{ $keyword }}".</p>
        @endif
    </div>
</div>
@endsection