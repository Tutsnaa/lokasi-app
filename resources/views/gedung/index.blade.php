@extends('layouts.app')

@section('title', 'Data Gedung')

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
            <h2 class="h4 fw-bold text-dark mb-1">Data Gedung</h2>
            <p class="text-secondary small mb-0">Kelola seluruh informasi dan data gedung dalam sistem.</p>
        </div>

        <a href="{{ route('gedung.create') }}" class="btn btn-primary d-inline-flex align-items-center gap-2">
            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Gedung
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
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Card Tabel -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom py-3">
            <h5 class="mb-1 fw-semibold">Daftar Gedung</h5>
            <small class="text-secondary">Data gedung yang tersedia dalam sistem</small>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="px-4 py-3" style="width: 80px;">ID</th>
                            <th class="py-3">Nama Gedung</th>
                            <th class="text-center py-3" style="width: 250px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($gedung as $item)
                        <tr>
                            <td class="px-4 text-secondary fw-medium">#{{ $item->id }}</td>
                            <td class="fw-semibold text-dark">{{ $item->nama_gedung ?? $item->nama }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('gedung.show', $item->id) }}" class="btn btn-sm btn-outline-info">
                                        Detail
                                    </a>

                                    <a href="{{ route('gedung.edit', $item->id) }}"
                                        class="btn btn-sm btn-outline-warning">
                                        Ubah
                                    </a>

                                    <form action="{{ route('gedung.destroy', $item->id) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus gedung ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-5">
                                <div class="text-secondary">
                                    <svg width="48" height="48" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        class="mb-3">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m0 0h5m-5 0V11m0 5h5">
                                        </path>
                                    </svg>
                                    <p class="mb-0">Belum ada data gedung yang tersimpan.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if(method_exists($gedung, 'hasPages') && $gedung->hasPages())
        <div class="card-footer bg-white border-top py-3">
            {{ $gedung->links() }}
        </div>
        @endif
    </div>
</div>
@endsection