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
            <tbody id="gedung-table-body">
                <!-- Data dari API akan di-render di sini menggunakan JavaScript -->
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Mengambil data dari Endpoint API Laravel
fetch('/api/gedung')
    .then(response => response.json())
    .then(data => {
        let html = '';
        data.forEach(item => {
            html += `
                    <tr>
                        <td>${item.id}</td>
                        <td>${item.nama_gedung || item.nama}</td>
                        <td>
                            <a href="/gedung/${item.id}" class="btn btn-sm btn-info">Detail</a>
                        </td>
                    </tr>
                `;
        });
        document.getElementById('gedung-table-body').innerHTML = html;
    })
    .catch(error => console.error('Error:', error));
</script>
@endpush