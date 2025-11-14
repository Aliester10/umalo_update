@extends('layouts.Admin.master')

@section('content')
<div class="card shadow-lg">
    <div class="card-header">
        <h1 class="h4">Tambah Aktivitas Baru</h1>
    </div>

    <div class="card-body">
        <form action="{{ route('Admin.Activity.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Main Image --}}
            <div class="mb-3">
                <label class="form-label">Gambar Utama</label>
                <input type="file" class="form-control" name="images" required>
            </div>

            {{-- Cover Image --}}
            <div class="mb-3">
                <label class="form-label">Cover Image (Header Besar)</label>
                <input type="file" class="form-control" name="cover_image">
            </div>

            {{-- Title --}}
            <div class="mb-3">
                <label class="form-label">Judul</label>
                <input type="text" class="form-control" name="title" required>
            </div>

            {{-- Description --}}
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea class="form-control" name="description" rows="4" required></textarea>
            </div>

            {{-- Start / End Date --}}
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Mulai</label>
                    <input type="date" class="form-control" name="start_date">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Selesai</label>
                    <input type="date" class="form-control" name="end_date">
                </div>
            </div>

            {{-- Location --}}
            <div class="mb-3">
                <label class="form-label">Lokasi</label>
                <input type="text" class="form-control" name="location">
            </div>

            {{-- Participants --}}
            <div class="mb-3">
                <label class="form-label">Jumlah Peserta</label>
                <input type="number" class="form-control" name="participants">
            </div>

            {{-- Duration --}}
            <div class="mb-3">
                <label class="form-label">Durasi (cth: 3 Hari)</label>
                <input type="text" class="form-control" name="duration">
            </div>

            {{-- Category --}}
            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <input type="text" class="form-control" name="category">
            </div>

            {{-- Status --}}
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select class="form-select" name="status">
                    <option value="">-- Pilih Status --</option>
                    <option value="Berlangsung">Berlangsung</option>
                    <option value="Selesai">Selesai</option>
                    <option value="Coming Soon">Coming Soon</option>
                </select>
            </div>

            {{-- Tags --}}
            <div class="mb-3">
                <label class="form-label">Tags (Pisahkan dengan koma)</label>
                <input type="text" class="form-control" name="tags" placeholder="Outdoor, Kepemimpinan, Kesehatan">
            </div>

            {{-- Gallery --}}
            <div class="mb-3">
                <label class="form-label">Galeri Foto (Multiple)</label>
                <input type="file" class="form-control" name="gallery[]" multiple>
            </div>

            {{-- Highlights --}}
            <div class="mb-3">
                <label class="form-label">Highlight</label>
                <div id="highlight-wrapper">
                    <input type="text" class="form-control mb-2" name="highlights[]" placeholder="Tambahkan highlight">
                </div>
                <button type="button" class="btn btn-sm btn-secondary" onclick="addHighlight()">+ Tambah Highlight</button>
            </div>

            {{-- Schedule --}}
            <div class="mb-3">
                <label class="form-label">Jadwal Kegiatan</label>
                <div id="schedule-wrapper">
                    <div class="mb-3 border rounded p-3">
                        <input type="text" class="form-control mb-2" name="schedule_day[]" placeholder="Hari 1: Tiba & Sambutan">
                        <textarea class="form-control" name="schedule_content[]" rows="3" placeholder="Detail kegiatan..."></textarea>
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-secondary" onclick="addSchedule()">+ Tambah Hari</button>
            </div>

            <button type="submit" class="btn btn-primary mt-4">Simpan</button>
        </form>
    </div>
</div>

{{-- JS Tambahan --}}
<script>
function addHighlight() {
    const wrap = document.getElementById('highlight-wrapper');
    wrap.insertAdjacentHTML('beforeend', `<input type="text" class="form-control mb-2" name="highlights[]" placeholder="Tambahkan highlight">`);
}

function addSchedule() {
    const wrap = document.getElementById('schedule-wrapper');
    wrap.insertAdjacentHTML('beforeend', `
        <div class="mb-3 border rounded p-3">
            <input type="text" class="form-control mb-2" name="schedule_day[]" placeholder="Hari ...">
            <textarea class="form-control" name="schedule_content[]" rows="3" placeholder="Detail kegiatan..."></textarea>
        </div>
    `);
}
</script>
@endsection
