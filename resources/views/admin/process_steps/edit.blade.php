@extends('layouts.Admin.master')

@section('content')
<div class="container">
    <h3 class="mb-4">Edit Process Step</h3>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.process.update', $step->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Step Number</label>
                    <input type="number" name="step_number" class="form-control" required value="{{ old('step_number', $step->step_number) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Judul Step</label>
                    <input type="text" name="title" class="form-control" required value="{{ old('title', $step->title) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" rows="4" class="form-control">{{ old('description', $step->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Gambar</label>
                    @if ($step->image && file_exists(public_path('uploads/process/' . $step->image)))
                        <div class="mb-2">
                            <img src="{{ asset('uploads/process/' . $step->image) }}"
                                 alt="{{ $step->title }}"
                                 class="rounded shadow-sm"
                                 style="width: 150px; height: 100px; object-fit: cover;">
                        </div>
                    @endif
                    <input type="file" name="image" class="form-control" accept="image/*">
                    <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar.</small>
                </div>

                <div class="d-flex justify-content-end pt-3">
                    <a href="{{ route('admin.process.index') }}" class="btn btn-secondary me-2">Kembali</a>
                    <button type="submit" class="btn btn-primary">Update Step</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
