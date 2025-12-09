@extends('layouts.Admin.master')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Semua Banner</h4>
            <a href="{{ route('admin.banner.create') }}" class="btn btn-primary">Tambah Banner</a>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Desktop</th>
                        <th>Mobile</th>
                        <th>Judul</th>
                        <th>Tombol</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($banners as $banner)
                        <tr>
                            <td>{{ $banner->id }}</td>
                            <td>
                                <img src="{{ asset($banner->image_url) }}" width="120">
                            </td>
                            <td>
                                @if($banner->image_mobile)
                                    <img src="{{ asset($banner->image_mobile) }}" width="120">
                                @else
                                    <span class="text-muted">Fallback Desktop</span>
                                @endif
                            </td>
                            <td>{{ $banner->title }}</td>
                            <td>{{ $banner->button_text }}</td>
                            <td>
                                <a href="{{ route('admin.banner.edit', $banner->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.banner.destroy', $banner->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('Hapus banner ini?')" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
