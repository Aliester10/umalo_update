@extends('layouts.Admin.master')

@section('content')
<div class="card shadow-lg">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h1 class="h4">Daftar Aktivitas</h1>
        <a href="{{ route('Admin.Activity.create') }}" class="btn btn-primary">Tambah Aktivitas Baru</a>
    </div>

    <div class="card-body">

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Gambar</th>
                        <th>Judul</th>
                        <th>Tanggal</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Lokasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($activities as $activity)
                    <tr>
                        <td>
                            <img src="{{ asset($activity->images) }}" 
                                 alt="{{ $activity->title }}"
                                 class="img-thumbnail"
                                 style="max-width: 90px;">
                        </td>

                        <td>{{ $activity->title }}</td>

                        <td>
                            @if($activity->start_date)
                                {{ date('d M Y', strtotime($activity->start_date)) }}
                                -
                                {{ date('d M Y', strtotime($activity->end_date)) }}
                            @else
                                -
                            @endif
                        </td>

                        <td>{{ $activity->category ?? '-' }}</td>

                        <td>
                            <span class="badge 
                                @if($activity->status == 'Berlangsung') bg-success
                                @elseif($activity->status == 'Selesai') bg-secondary
                                @elseif($activity->status == 'Coming Soon') bg-warning text-dark
                                @else bg-light text-dark @endif">
                                {{ $activity->status ?? '-' }}
                            </span>
                        </td>

                        <td>{{ $activity->location ?? '-' }}</td>

                        <td class="text-center">
                            <div class="btn-group">
                                <a href="{{ route('Admin.Activity.show', $activity->id) }}" 
                                   class="btn btn-sm btn-info">Lihat</a>

                                <a href="{{ route('Admin.Activity.edit', $activity->id) }}" 
                                   class="btn btn-sm btn-warning">Edit</a>

                                <form action="{{ route('Admin.Activity.destroy', $activity->id) }}" 
                                      method="POST" 
                                      class="d-inline-block" 
                                      onsubmit="return confirm('Yakin ingin menghapus aktivitas ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    </div>
</div>
@endsection
