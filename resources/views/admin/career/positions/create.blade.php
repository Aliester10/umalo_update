@extends('layouts.Admin.master')

@section('content')
<div class="container-fluid px-4">

    <h3 class="mb-4 fw-bold">Tambah Karir Baru</h3>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('admin.career.positions.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Judul Posisi</label>
                    <input type="text" name="title" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tipe Pekerjaan</label>
                    <select name="employment_type" class="form-control" required>
                        <option value="full_time">Full Time</option>
                        <option value="part_time">Part Time</option>
                        <option value="internship">Internship</option>
                        <option value="remote">Remote</option>
                        <option value="contract">Contract</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tags (Pisahkan dengan koma)</label>
                    <input type="text" name="tags" class="form-control" placeholder="React, Node, Teamwork">
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" class="form-control" rows="4"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kualifikasi</label>
                    <textarea name="requirements" class="form-control" rows="4"></textarea>
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" name="is_active" type="checkbox" checked>
                    <label class="form-check-label">Aktif</label>
                </div>

                <button class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.career.positions.index') }}" class="btn btn-secondary">Kembali</a>

            </form>
        </div>
    </div>

</div>
@endsection
