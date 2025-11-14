@extends('layouts.Admin.master')

@section('content')
<div class="container-fluid px-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Daftar Karir</h3>
        <a href="{{ route('admin.career.positions.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Karir
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Posisi</th>
                        <th>Tipe</th>
                        <th>Status</th>
                        <th>Dibuat</th>
                        <th width="160px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($positions as $pos)
                    <tr>
                        <td>{{ $pos->title }}</td>
                        <td>{{ ucfirst(str_replace('_',' ', $pos->employment_type)) }}</td>
                        <td>
                            @if($pos->is_active)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-secondary">Nonaktif</span>
                            @endif
                        </td>
                        <td>{{ $pos->created_at->format('d M Y') }}</td>
                        <td>
                            <a href="{{ route('admin.career.positions.edit', $pos->id) }}" 
                               class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form action="{{ route('admin.career.positions.destroy', $pos->id) }}" 
                                  method="POST" class="d-inline"
                                  onsubmit="return confirm('Yakin ingin menghapus posisi ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">
                            Belum ada data karir.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $positions->links() }}
            </div>

        </div>
    </div>

</div>
@endsection
