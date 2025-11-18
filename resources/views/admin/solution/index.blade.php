@extends('layouts.Admin.master')

@section('content')
<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Daftar Solusi</h3>
        <a href="{{ route('admin.solution.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Solusi
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th width="50">#</th>
                            <th>Judul</th>
                            <th>Banner</th>
                            <th>Status</th>
                            <th>Urutan</th>
                            <th width="180">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($solutions as $index => $solution)
                        <tr>
                            <td>{{ $index+1 }}</td>

                            <td>{{ $solution->title }}</td>

                            <td>
                                @if($solution->banner_image)
                                    <img src="{{ asset($solution->banner_image) }}" width="90" class="rounded">
                                @else
                                    <span class="text-muted">Tidak ada</span>
                                @endif
                            </td>

                            <td>
                                @if($solution->status == 'published')
                                    <span class="badge bg-success">Published</span>
                                @else
                                    <span class="badge bg-secondary">Draft</span>
                                @endif
                            </td>

                            <td>{{ $solution->order }}</td>

                            <td>
                                <a href="{{ route('admin.solution.edit', $solution->id) }}"
                                   class="btn btn-warning btn-sm text-white">
                                    <i class="fas fa-edit"></i> Edit
                                </a>

                                <form action="{{ route('admin.solution.destroy', $solution->id) }}"
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Hapus solusi ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>

</div>
@endsection
