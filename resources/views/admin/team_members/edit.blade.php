@extends('layouts.Admin.master')

@section('content')
<div class="container">
    <h3 class="mb-4">Edit Team Member</h3>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.team.update', $member->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Nama --}}
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="name" class="form-control" required value="{{ old('name', $member->name) }}">
                </div>

                {{-- Posisi --}}
                <div class="mb-3">
                    <label class="form-label">Posisi / Jabatan</label>
                    <input type="text" name="position" class="form-control" required value="{{ old('position', $member->position) }}">
                </div>

                {{-- Foto --}}
                <div class="mb-3">
                    <label class="form-label">Foto</label>
                    @if ($member->photo && file_exists(public_path('uploads/team/' . $member->photo)))
                        <div class="mb-2">
                            <img src="{{ asset('uploads/team/' . $member->photo) }}"
                                 alt="{{ $member->name }}"
                                 class="rounded-circle shadow-sm"
                                 style="width: 80px; height: 80px; object-fit: cover;">
                        </div>
                    @endif
                    <input type="file" name="photo" class="form-control" accept="image/*">
                    <small class="text-muted">Kosongkan jika tidak ingin mengubah foto.</small>
                </div>

                {{-- Deskripsi --}}
                <div class="mb-3">
                    <label class="form-label">Deskripsi Singkat</label>
                    <textarea name="description" rows="3" class="form-control">{{ old('description', $member->description) }}</textarea>
                </div>

                {{-- Urutan --}}
                <div class="mb-3">
                    <label class="form-label">Urutan Tampil</label>
                    <input type="number" name="order" class="form-control" value="{{ old('order', $member->order) }}">
                </div>

                <hr>

                <h5 class="mb-3">Social Media (Optional)</h5>

                @php
                    $socials = $member->socials;
                @endphp

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">LinkedIn</label>
                        <input type="url" name="linkedin" class="form-control"
                               value="{{ old('linkedin', optional($socials)->linkedin) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Instagram</label>
                        <input type="text" name="instagram" class="form-control"
                               value="{{ old('instagram', optional($socials)->instagram) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Github</label>
                        <input type="url" name="github" class="form-control"
                               value="{{ old('github', optional($socials)->github) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">YouTube</label>
                        <input type="url" name="youtube" class="form-control"
                               value="{{ old('youtube', optional($socials)->youtube) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Facebook</label>
                        <input type="url" name="facebook" class="form-control"
                               value="{{ old('facebook', optional($socials)->facebook) }}">
                    </div>
                </div>

                <div class="d-flex justify-content-end pt-3">
                    <a href="{{ route('admin.team.index') }}" class="btn btn-secondary me-2">Kembali</a>
                    <button type="submit" class="btn btn-primary">Update Member</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
