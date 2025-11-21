@extends('layouts.Admin.master')

@section('content')
<div class="container">
    <h3 class="mb-4">Kelola Core Values</h3>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <a href="{{ route('admin.core.create') }}" class="btn btn-primary mb-3">
        <i class="bi bi-plus-circle"></i> Tambah Core Value
    </a>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th style="width: 5%">NO</th>
                        <th style="width: 15%">ICON</th>
                        <th style="width: 20%">JUDUL</th>
                        <th style="width: 40%">DESKRIPSI</th>
                        <th style="width: 10%">URUTAN</th>
                        <th style="width: 10%">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($values as $index => $value)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                @if($value->icon)
                                    <i class="{{ $value->icon }} fs-4"></i>
                                    <div class="text-muted small mt-1">{{ $value->icon }}</div>
                                @else
                                    <span class="text-muted">Tidak ada icon</span>
                                @endif
                            </td>
                            <td>{{ $value->title }}</td>
                            <td class="text-start">{{ $value->description }}</td>
                            <td>{{ $value->order }}</td>
                            <td>
                                <a href="{{ route('admin.core.edit', $value->id) }}" class="btn btn-sm btn-warning me-1 mb-1">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('admin.core.destroy', $value->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-sm btn-danger mb-1"
                                            onclick="return confirm('Yakin ingin menghapus {{ $value->title }}?')">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-muted">Belum ada data core values.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
