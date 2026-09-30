@extends('layouts.app')

@section('title', 'Data Ruangan')

@section('content')
<div class="py-3">

    <!-- Tombol Kembali -->
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
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h2 class="h4 fw-bold text-dark mb-1">Daftar Ruangan</h2>
            <p class="text-secondary small mb-0">Kelola informasi ruangan beserta lokasi gedungnya.</p>
        </div>

        <a href="{{ route('ruangan.create') }}" class="btn btn-primary d-inline-flex align-items-center gap-2">
            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Ruangan
        </a>
    </div>

    <!-- Notifikasi Sukses -->
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4" role="alert">
        <div class="d-flex align-items-center gap-2">
            <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                    clip-rule="evenodd"></path>
            </svg>
            <span>{{ session('success') }}</span>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Card Tabel -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom py-3">
            <h5 class="mb-1 fw-semibold">Daftar Ruangan</h5>
            <small class="text-secondary">Data ruangan yang tersedia dalam sistem</small>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="px-4 py-3 text-center" style="width: 60px;">No</th>
                            <th class="py-3" style="width: 100px;">Foto</th>
                            <th class="py-3">Informasi Ruangan</th>
                            <th class="py-3">Lokasi Gedung</th>
                            <th class="py-3">Keterangan</th>
                            <th class="text-center py-3" style="width: 220px;">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($ruangan as $index => $item)
                        <tr>
                            <!-- Nomor -->
                            <td class="px-4 text-center text-secondary fw-medium">
                                {{ $loop->iteration }}
                            </td>

                            <!-- Foto -->
                            <td>
                                @if($item->foto)
                                <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama_ruangan }}"
                                    class="rounded border object-fit-cover" style="width: 64px; height: 48px;">
                                @else
                                <div class="bg-light border rounded d-flex flex-column align-items-center justify-content-center text-secondary"
                                    style="width: 64px; height: 48px;">
                                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <small style="font-size: 8px;">No Photo</small>
                                </div>
                                @endif
                            </td>

                            <!-- Informasi Ruangan -->
                            <td>
                                <div class="fw-semibold text-dark mb-1">
                                    {{ $item->nama_ruangan }}
                                </div>
                                <span class="badge bg-light text-secondary border fw-normal">
                                    Lantai {{ $item->lantai }}
                                </span>
                            </td>

                            <!-- Lokasi Gedung -->
                            <td>
                                @if($item->gedung)
                                <div class="fw-semibold text-primary d-flex align-items-center gap-1">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m0 0h5m-5 0V11m0 5h5">
                                        </path>
                                    </svg>
                                    {{ $item->gedung->nama_gedung }}
                                </div>
                                <small class="text-secondary">
                                    Koordinat: {{ $item->gedung->latitude }}, {{ $item->gedung->longitude }}
                                </small>
                                @else
                                <span class="text-danger small fst-italic">
                                    Gedung tidak ditemukan
                                </span>
                                @endif
                            </td>

                            <!-- Keterangan -->
                            <td class="text-secondary" style="max-width: 250px;">
                                <div class="text-truncate">
                                    {{ $item->keterangan ?? '-' }}
                                </div>
                            </td>

                            <!-- Aksi -->
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('ruangan.show', $item->id) }}" class="btn btn-sm btn-outline-info"
                                        title="Detail">
                                        Detail
                                    </a>

                                    <a href="{{ route('ruangan.edit', $item->id) }}"
                                        class="btn btn-sm btn-outline-warning" title="Ubah">
                                        Ubah
                                    </a>

                                    <form action="{{ route('ruangan.destroy', $item->id) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus ruangan {{ $item->nama_ruangan }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="text-secondary">
                                    <svg width="48" height="48" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        class="mb-3">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path>
                                    </svg>
                                    <p class="fw-medium text-dark mb-1">Belum ada data ruangan tersedia.</p>
                                    <p class="small text-secondary mb-0">
                                        Klik tombol <strong>Tambah Ruangan</strong> untuk membuat data baru.
                                    </p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if(method_exists($ruangan, 'hasPages') && $ruangan->hasPages())
        <div class="card-footer bg-white border-top py-3">
            {{ $ruangan->links() }}
        </div>
        @endif
    </div>
</div>
@endsection