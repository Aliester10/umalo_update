@extends('layouts.Admin.master')

@section('content')
<div class="container">
    {{-- Judul Halaman --}}
    <h3 class="mb-4">Kelola Brand & Partner</h3>

    {{-- Pesan Sukses --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Tombol Tambah --}}
    <a href="{{ route('admin.brand-partner.create') }}" class="btn btn-primary mb-3">
        <i class="bi bi-plus-circle"></i> Tambah Brand
    </a>

    {{-- Tabel --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th style="width: 5%">NO</th>
                        <th style="width: 10%">LOGO</th>
                        <th style="width: 20%">NAMA</th>
                        <th style="width: 10%">TIPE</th>
                        <th style="width: 25%">URL</th>
                        <th style="width: 15%">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($brands as $key => $brand)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>
                                @if ($brand->gambar && file_exists(public_path('storage/' . $brand->gambar)))
                                    <img src="{{ asset('storage/' . $brand->gambar) }}" 
                                         alt="{{ $brand->nama }}" 
                                         class="rounded shadow-sm" 
                                         style="width: 70px; height: 70px; object-fit: contain;">
                                @else
                                    <span class="text-muted">Tidak ada gambar</span>
                                @endif
                            </td>
                            <td>{{ $brand->nama }}</td>
                            <td>{{ ucfirst($brand->type) }}</td>
                            <td>
                                @if ($brand->url)
                                    <a href="{{ $brand->url }}" target="_blank">{{ $brand->url }}</a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.brand-partner.edit', $brand->id) }}" class="btn btn-sm btn-warning me-1">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('admin.brand-partner.destroy', $brand->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Yakin ingin menghapus {{ $brand->nama }}?')">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-muted">Belum ada data brand atau partner.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
