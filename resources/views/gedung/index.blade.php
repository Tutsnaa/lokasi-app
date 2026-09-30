@extends('layouts.app')

@section('title', 'Daftar Gedung')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h2 class="mb-3">Daftar Gedung</h2>

        {{-- Alert Notifikasi Sukses --}}
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Gedung</th>
                    <th width="200">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($gedung as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->nama_gedung ?? $item->nama }}</td>
                    <td>
                        <div class="d-flex gap-1">
                            {{-- Tombol Detail --}}
                            <a href="{{ route('gedung.show', $item->id) }}"
                                class="btn btn-sm btn-info text-white">Detail</a>

                            {{-- Tombol Ubah --}}
                            <a href="{{ route('gedung.edit', $item->id) }}"
                                class="btn btn-sm btn-warning text-white">Ubah</a>

                            {{-- Form & Tombol Hapus --}}
                            <form action="{{ route('gedung.destroy', $item->id) }}" method="POST"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus gedung ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center text-muted">Belum ada data gedung.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection