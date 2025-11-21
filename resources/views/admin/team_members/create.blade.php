@extends('layouts.Admin.master')

@section('content')
<div class="container">
    <h3 class="mb-4">Tambah Team Member</h3>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.team.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Nama --}}
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                </div>

                {{-- Posisi --}}
                <div class="mb-3">
                    <label class="form-label">Posisi / Jabatan</label>
                    <input type="text" name="position" class="form-control" required value="{{ old('position') }}">
                </div>

                {{-- Foto --}}
                <div class="mb-3">
                    <label class="form-label">Foto (optional)</label>
                    <input type="file" name="photo" class="form-control" accept="image/*">
                    <small class="text-muted">Disarankan ukuran square (1:1) agar rapi.</small>
                </div>

                {{-- Deskripsi --}}
                <div class="mb-3">
                    <label class="form-label">Deskripsi Singkat (optional)</label>
                    <textarea name="description" rows="3" class="form-control">{{ old('description') }}</textarea>
                </div>

                {{-- Urutan --}}
                <div class="mb-3">
                    <label class="form-label">Urutan Tampil</label>
                    <input type="number" name="order" class="form-control" value="{{ old('order', 0) }}">
                    <small class="text-muted">Semakin kecil angkanya, semakin di depan.</small>
                </div>

                <hr>

                <h5 class="mb-3">Social Media (Optional)</h5>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">LinkedIn</label>
                        <input type="url" name="linkedin" class="form-control" placeholder="https://linkedin.com/in/username" value="{{ old('linkedin') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Instagram</label>
                        <input type="text" name="instagram" class="form-control" placeholder="https://instagram.com/username" value="{{ old('instagram') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Github</label>
                        <input type="url" name="github" class="form-control" placeholder="https://github.com/username" value="{{ old('github') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">YouTube</label>
                        <input type="url" name="youtube" class="form-control" placeholder="https://youtube.com/@channel" value="{{ old('youtube') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Facebook</label>
                        <input type="url" name="facebook" class="form-control" placeholder="https://facebook.com/username" value="{{ old('facebook') }}">
                    </div>
                </div>

                <div class="d-flex justify-content-end pt-3">
                    <a href="{{ route('admin.team.index') }}" class="btn btn-secondary me-2">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan Member</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
