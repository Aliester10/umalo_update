@extends('layouts.Admin.master')

@section('content')
<div class="container">
    <h3 class="mb-3">Edit Brand / Partner</h3>
    <form action="{{ route('admin.brand-partner.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ $brand->nama }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tipe</label>
            <select name="type" class="form-control" required>
                <option value="brand" {{ $brand->type == 'brand' ? 'selected' : '' }}>Brand</option>
                <option value="partner" {{ $brand->type == 'partner' ? 'selected' : '' }}>Partner</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">URL</label>
            <input type="url" name="url" class="form-control" value="{{ $brand->url }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Logo Sekarang</label><br>
            <img src="{{ asset('storage/' . $brand->gambar) }}" width="100" class="mb-2"><br>
            <label class="form-label">Ganti Logo (opsional)</label>
            <input type="file" name="gambar" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Perbarui</button>
        <a href="{{ route('admin.brand-partner.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
