@extends('layouts.Admin.master')

@section('content')
<div class="container">
    <h3 class="mb-4">Tambah Process Step</h3>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.process.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Step Number</label>
                    <input type="number" name="step_number" class="form-control" required value="{{ old('step_number') }}">
                    <small class="text-muted">Contoh: 1, 2, 3 ... sesuai urutan proses.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Judul Step</label>
                    <input type="text" name="title" class="form-control" required value="{{ old('title') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" rows="4" class="form-control">{{ old('description') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Gambar (optional)</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    <small class="text-muted">Gambar bisa berupa ilustrasi proses.</small>
                </div>

                <div class="d-flex justify-content-end pt-3">
                    <a href="{{ route('admin.process.index') }}" class="btn btn-secondary me-2">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan Step</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
