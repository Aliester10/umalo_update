@extends('layouts.Admin.master')

@section('content')
<div class="container">
    <h3 class="mb-4">Kelola Process Steps</h3>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <a href="{{ route('admin.process.create') }}" class="btn btn-primary mb-3">
        <i class="bi bi-plus-circle"></i> Tambah Step
    </a>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th style="width: 5%">NO</th>
                        <th style="width: 10%">STEP</th>
                        <th style="width: 20%">JUDUL</th>
                        <th style="width: 25%">GAMBAR</th>
                        <th style="width: 30%">DESKRIPSI</th>
                        <th style="width: 10%">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($steps as $index => $step)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $step->step_number }}</td>
                            <td>{{ $step->title }}</td>
                            <td>
                                @if ($step->image && file_exists(public_path('uploads/process/' . $step->image)))
                                    <img src="{{ asset('uploads/process/' . $step->image) }}"
                                         alt="{{ $step->title }}"
                                         class="rounded shadow-sm"
                                         style="width: 120px; height: 80px; object-fit: cover;">
                                @else
                                    <span class="text-muted">Tidak ada gambar</span>
                                @endif
                            </td>
                            <td class="text-start">
                                {{ $step->description }}
                            </td>
                            <td>
                                <a href="{{ route('admin.process.edit', $step->id) }}" class="btn btn-sm btn-warning me-1 mb-1">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('admin.process.destroy', $step->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-sm btn-danger mb-1"
                                            onclick="return confirm('Yakin ingin menghapus Step {{ $step->step_number }} - {{ $step->title }}?')">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-muted">Belum ada data process steps.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
