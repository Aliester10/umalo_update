@extends('layouts.Admin.master')

@section('content')
<div class="container-fluid px-4">

    <h3 class="mb-4 fw-bold">Edit Posisi Karir</h3>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('admin.career.positions.update', $position->id) }}" method="POST">
                @csrf @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Judul Posisi</label>
                    <input type="text" name="title" class="form-control" 
                           value="{{ $position->title }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tipe Pekerjaan</label>
                    <select name="employment_type" class="form-control" required>
                        <option value="full_time" {{ $position->employment_type=='full_time'?'selected':'' }}>Full Time</option>
                        <option value="part_time" {{ $position->employment_type=='part_time'?'selected':'' }}>Part Time</option>
                        <option value="internship" {{ $position->employment_type=='internship'?'selected':'' }}>Internship</option>
                        <option value="remote" {{ $position->employment_type=='remote'?'selected':'' }}>Remote</option>
                        <option value="contract" {{ $position->employment_type=='contract'?'selected':'' }}>Contract</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tags (Pisahkan dengan koma)</label>
                    <input type="text" name="tags" class="form-control"
                           value="{{ implode(',', $position->tags ?? []) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" class="form-control" rows="4">{{ $position->description }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kualifikasi</label>
                    <textarea name="requirements" class="form-control" rows="4">{{ $position->requirements }}</textarea>
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" name="is_active" type="checkbox"
                           {{ $position->is_active ? 'checked' : '' }}>
                    <label class="form-check-label">Aktif</label>
                </div>

                <button class="btn btn-primary">Update</button>
                <a href="{{ route('admin.career.positions.index') }}" class="btn btn-secondary">Kembali</a>

            </form>
        </div>
    </div>

</div>
@endsection
