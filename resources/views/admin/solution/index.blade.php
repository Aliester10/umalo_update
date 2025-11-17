@extends('layouts.Admin.master')

@section('content')
<div class="container-fluid py-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Daftar Solusi</h3>
        <a href="{{ route('admin.solution.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Tambah Solusi
        </a>
    </div>

    <!-- Table -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th width="5%">#</th>
                            <th width="10%">Thumbnail</th>
                            <th>Judul</th>
                            <th>Deskripsi Singkat</th>
                            <th width="10%">Urutan</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($solutions as $key => $solution)
                            <tr>
                                <td>{{ $key + 1 }}</td>

                                <td>
                                    @if($solution->thumbnail)
                                        <img src="{{ asset('storage/' . $solution->thumbnail) }}"
                                             class="img-fluid rounded"
                                             width="60">
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>

                                <td class="fw-semibold">{{ $solution->title }}</td>

                                <td class="text-muted" style="max-width: 300px;">
                                    {{ Str::limit($solution->short_description, 60) }}
                                </td>

                                <td>{{ $solution->order }}</td>

                                <td>
                                    <a href="{{ route('admin.solution.edit', $solution->id) }}"
                                       class="btn btn-warning btn-sm text-white">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('admin.solution.destroy', $solution->id) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Hapus solusi ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <span class="text-muted">Belum ada solusi.</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
