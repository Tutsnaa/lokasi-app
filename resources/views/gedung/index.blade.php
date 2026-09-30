@extends('layouts.app')

@section('title', 'Daftar Gedung')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h2 class="mb-3">Daftar Gedung</h2>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Gedung</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($gedung as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->nama_gedung ?? $item->nama }}</td>
                    <td>
                        <a href="{{ route('gedung.show', $item->id) }}"
                            class="btn btn-sm btn-info text-white">Detail</a>
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