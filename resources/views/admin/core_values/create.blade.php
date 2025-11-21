@extends('layouts.Admin.master')

@section('content')
<div class="container">
    <h3 class="mb-4">Tambah Core Value</h3>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.core.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Icon (optional)</label>
                    <input type="text" name="icon" class="form-control" value="{{ old('icon') }}" placeholder="contoh: bi bi-star-fill">
                    <small class="text-muted">Gunakan class Bootstrap Icons / FontAwesome yang kamu pakai.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" name="title" class="form-control" required value="{{ old('title') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" rows="3" class="form-control">{{ old('description') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Urutan</label>
                    <input type="number" name="order" class="form-control" value="{{ old('order', 0) }}">
                </div>

                <div class="d-flex justify-content-end pt-3">
                    <a href="{{ route('admin.core.index') }}" class="btn btn-secondary me-2">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan Core Value</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
