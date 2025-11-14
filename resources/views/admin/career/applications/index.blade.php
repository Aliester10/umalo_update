@extends('layouts.Admin.master')

@section('content')
<div class="container-fluid px-4">

    <h3 class="fw-bold mb-4">Lamaran Masuk</h3>

    <div class="card shadow-sm">
        <div class="card-body">

            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No. HP</th>
                        <th>Posisi</th>
                        <th>Tanggal</th>
                        <th width="150px">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($applications as $app)
                    <tr>
                        <td>{{ $app->full_name }}</td>
                        <td>{{ $app->email }}</td>
                        <td>{{ $app->phone }}</td>
                        <td>{{ $app->position->title }}</td>
                        <td>{{ $app->created_at->format('d M Y') }}</td>

                        <td>
                            <a href="{{ route('admin.career.applications.show', $app->id) }}" 
                               class="btn btn-info btn-sm">
                                Detail
                            </a>

                            <form action="{{ route('admin.career.applications.destroy', $app->id) }}" 
                                method="POST" class="d-inline"
                                onsubmit="return confirm('Hapus lamaran ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">
                            Belum ada lamaran masuk.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">{{ $applications->links() }}</div>

        </div>
    </div>

</div>
@endsection
