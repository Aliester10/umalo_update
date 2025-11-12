@extends('layouts.Admin.master')

@section('content')
<div class="container">
    <h3 class="mb-3">Tambah Brand / Partner</h3>
    <form action="{{ route('admin.brand-partner.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" placeholder="Nama brand/partner" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tipe</label>
            <select name="type" class="form-control" required>
                <option value="">-- Pilih Tipe --</option>
                <option value="brand">Brand</option>
                <option value="partner">Partner</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">URL</label>
            <input type="url" name="url" class="form-control" placeholder="https://example.com">
        </div>

        <div class="mb-3">
            <label class="form-label">Logo</label>
            <input type="file" name="gambar" class="form-control" accept="image/*" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.brand-partner.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
