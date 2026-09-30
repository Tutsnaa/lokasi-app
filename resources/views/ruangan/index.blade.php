@extends('layouts.app')

@section('title', 'Daftar Ruangan')

@section('content')
<div class="container my-5">
    <!-- Header Page & Tombol Tambah -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">Daftar Ruangan</h2>
            <p class="text-muted mb-0">Kelola informasi ruangan beserta lokasi gedungnya</p>
        </div>
        <a href="{{ route('ruangan.create') }}" class="btn btn-primary shadow-sm">
            + Tambah Ruangan
        </a>
    </div>

    <!-- Alert Notifikasi Sukses -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Tabel Data Ruangan & Gedung -->
    <div class="table-responsive shadow-sm rounded-3 border">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th style="width: 60px;" class="text-center">No</th>
                    <th style="width: 100px;">Foto</th>
                    <th>Informasi Ruangan</th>
                    <th>Lokasi Gedung</th>
                    <th>Keterangan</th>
                    <th style="width: 180px;" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ruangan as $index => $item)
                <tr>
                    <!-- Nomor Urut -->
                    <td class="text-center fw-semibold text-secondary">
                        {{ $loop->iteration }}
                    </td>

                    <!-- Thumbnail Foto Ruangan -->
                    <td>
                        @if($item->foto)
                        <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama_ruangan }}"
                            class="rounded-3 object-fit-cover shadow-sm" style="width: 70px; height: 50px;">
                        @else
                        <div class="bg-light border rounded-3 d-flex align-items-center justify-content-center text-muted fs-7"
                            style="width: 70px; height: 50px;">
                            <small class="text-center" style="font-size: 10px;">No Photo</small>
                        </div>
                        @endif
                    </td>

                    <!-- Informasi Ruangan -->
                    <td>
                        <div class="fw-bold text-dark fs-6">{{ $item->nama_ruangan }}</div>
                        <span class="badge bg-secondary-subtle text-secondary border">
                            Lantai {{ $item->lantai }}
                        </span>
                    </td>

                    <!-- Informasi Gedung Tempat Ruangan Berada -->
                    <td>
                        @if($item->gedung)
                        <div class="fw-semibold text-primary">
                            🏢 {{ $item->gedung->nama_gedung }}
                        </div>
                        <small class="text-muted d-block">
                            Koordinat: {{ $item->gedung->latitude }}, {{ $item->gedung->longitude }}
                        </small>
                        @else
                        <span class="text-danger italic fs-7">Gedung tidak ditemukan</span>
                        @endif
                    </td>

                    <!-- Keterangan Ruangan -->
                    <td>
                        <span class="text-secondary">
                            {{ Str::limit($item->keterangan ?? '-', 50) }}
                        </span>
                    </td>

                    <!-- Aksi (Detail, Edit, Hapus) -->
                    <td class="text-center">
                        <div class="d-inline-flex gap-1">
                            <!-- Tombol Detail -->
                            <a href="{{ route('ruangan.show', $item->id) }}"
                                class="btn btn-sm btn-info text-white shadow-sm" title="Detail">
                                Detail
                            </a>

                            <!-- Tombol Edit -->
                            <a href="{{ route('ruangan.edit', $item->id) }}"
                                class="btn btn-sm btn-warning text-white shadow-sm" title="Edit">
                                Edit
                            </a>

                            <!-- Tombol Hapus -->
                            <form action="{{ route('ruangan.destroy', $item->id) }}" method="POST"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus ruangan {{ $item->nama_ruangan }}?')"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger shadow-sm" title="Hapus">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-5">
                        <div class="my-3">
                            <p class="mb-1 fw-semibold">Belum ada data ruangan tersedia.</p>
                            <small>Klik tombol <strong>+ Tambah Ruangan</strong> untuk menambahkan data baru.</small>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection