@extends('layouts.Admin.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="bi bi-plus-circle-fill me-2"></i>Tambah Aktivitas Baru
                    </h5>
                    <a href="{{ route('Admin.Activity.index') }}" class="btn btn-light btn-sm">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('Admin.Activity.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Gambar Section -->
                        <div class="border-bottom pb-4 mb-4">
                            <h6 class="text-primary mb-3">
                                <i class="bi bi-images me-2"></i>Media & Gambar
                            </h6>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">
                                        <i class="bi bi-image-fill text-primary me-1"></i>
                                        Gambar Utama <span class="text-danger">*</span>
                                    </label>
                                    <input type="file" class="form-control @error('images') is-invalid @enderror" 
                                           name="images" accept="image/*" required onchange="previewImage(this, 'preview1')">
                                    <small class="text-muted d-block mt-1">Format: JPG, PNG. Max: 2MB</small>
                                    @error('images')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    <div id="preview1" class="mt-2"></div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">
                                        <i class="bi bi-card-image text-primary me-1"></i>
                                        Cover Image
                                    </label>
                                    <input type="file" class="form-control @error('cover_image') is-invalid @enderror" 
                                           name="cover_image" accept="image/*" onchange="previewImage(this, 'preview2')">
                                    <small class="text-muted d-block mt-1">Gambar untuk header detail</small>
                                    @error('cover_image')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    <div id="preview2" class="mt-2"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Informasi Dasar -->
                        <div class="border-bottom pb-4 mb-4">
                            <h6 class="text-primary mb-3">
                                <i class="bi bi-info-circle-fill me-2"></i>Informasi Dasar
                            </h6>
                            
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Judul <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                       name="title" value="{{ old('title') }}" required placeholder="Masukkan judul aktivitas">
                                @error('title')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Deskripsi <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                          name="description" rows="4" required placeholder="Jelaskan detail aktivitas...">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-semibold">Kategori</label>
                                    <input type="text" class="form-control" name="category" value="{{ old('category') }}" placeholder="Contoh: Training">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-semibold">Status</label>
                                    <select class="form-select" name="status">
                                        <option value="">-- Pilih Status --</option>
                                        <option value="Coming Soon">Coming Soon</option>
                                        <option value="Berlangsung">Berlangsung</option>
                                        <option value="Selesai">Selesai</option>
                                    </select>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-semibold">Tags</label>
                                    <input type="text" class="form-control" name="tags" value="{{ old('tags') }}" 
                                           placeholder="Pisahkan dengan koma">
                                </div>
                            </div>
                        </div>

                        <!-- Detail Kegiatan -->
                        <div class="border-bottom pb-4 mb-4">
                            <h6 class="text-primary mb-3">
                                <i class="bi bi-calendar-event-fill me-2"></i>Detail Kegiatan
                            </h6>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Tanggal Mulai</label>
                                    <input type="date" class="form-control" name="start_date" value="{{ old('start_date') }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Tanggal Selesai</label>
                                    <input type="date" class="form-control" name="end_date" value="{{ old('end_date') }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-semibold">Lokasi</label>
                                    <input type="text" class="form-control" name="location" value="{{ old('location') }}" placeholder="Contoh: Bali, Indonesia">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-semibold">Durasi</label>
                                    <input type="text" class="form-control" name="duration" value="{{ old('duration') }}" placeholder="Contoh: 3 Hari">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-semibold">Jumlah Peserta</label>
                                    <input type="number" class="form-control" name="participants" value="{{ old('participants') }}" min="0" placeholder="50">
                                </div>
                            </div>
                        </div>

                        <!-- Galeri -->
                        <div class="border-bottom pb-4 mb-4">
                            <h6 class="text-primary mb-3">
                                <i class="bi bi-images me-2"></i>Galeri Foto
                            </h6>
                            
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Upload Foto (Multiple)</label>
                                <input type="file" class="form-control" name="gallery[]" multiple accept="image/*" 
                                       onchange="previewMultiple(this, 'galleryPreview')">
                                <small class="text-muted d-block mt-1">Pilih beberapa foto sekaligus</small>
                                <div id="galleryPreview" class="row mt-3"></div>
                            </div>
                        </div>

                        <!-- Highlights -->
                        <div class="border-bottom pb-4 mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="text-primary mb-0">
                                    <i class="bi bi-star-fill me-2"></i>Highlights
                                </h6>
                                <button type="button" class="btn btn-sm btn-outline-primary" onclick="addHighlight()">
                                    <i class="bi bi-plus-circle me-1"></i> Tambah
                                </button>
                            </div>
                            
                            <div id="highlightContainer">
                                <div class="mb-2 d-flex gap-2 align-items-center">
                                    <input type="text" class="form-control form-control-sm" name="highlights[]" placeholder="Tambahkan highlight aktivitas">
                                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeRow(this)" style="display:none;">
                                        <i class="bi bi-trash-fill me-1"></i>Hapus
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Jadwal -->
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="text-primary mb-0">
                                    <i class="bi bi-calendar2-week-fill me-2"></i>Jadwal Kegiatan
                                </h6>
                                <button type="button" class="btn btn-sm btn-outline-primary" onclick="addSchedule()">
                                    <i class="bi bi-plus-circle me-1"></i> Tambah Hari
                                </button>
                            </div>
                            
                            <div id="scheduleContainer">
                                <div class="card mb-3 border-0 bg-light">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between mb-2">
                                            <strong><i class="bi bi-calendar-day me-1"></i>Hari 1</strong>
                                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeScheduleCard(this)" style="display:none;">
                                                <i class="bi bi-trash-fill me-1"></i>Hapus
                                            </button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm mb-2" name="schedule_day[]" placeholder="Judul Hari (Contoh: Hari 1: Pembukaan)">
                                        <textarea class="form-control form-control-sm" name="schedule_content[]" rows="3" placeholder="Detail kegiatan hari ini..."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="pt-3 border-top">
                            <button type="submit" class="btn btn-primary btn-sm px-4">
                                <i class="bi bi-save-fill me-1"></i> Simpan Aktivitas
                            </button>
                            <a href="{{ route('Admin.Activity.index') }}" class="btn btn-secondary btn-sm px-4">
                                <i class="bi bi-x-circle me-1"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let scheduleCount = 1;

function previewImage(input, previewId) {
    const preview = document.getElementById(previewId);
    preview.innerHTML = '';
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = `<img src="${e.target.result}" class="img-thumbnail" style="max-height: 150px;">`;
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function previewMultiple(input, previewId) {
    const preview = document.getElementById(previewId);
    preview.innerHTML = '';
    
    if (input.files) {
        Array.from(input.files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const col = document.createElement('div');
                col.className = 'col-md-2 col-4 mb-2';
                col.innerHTML = `<img src="${e.target.result}" class="img-thumbnail" style="height: 100px; object-fit: cover;">`;
                preview.appendChild(col);
            }
            reader.readAsDataURL(file);
        });
    }
}

function addHighlight() {
    const container = document.getElementById('highlightContainer');
    const div = document.createElement('div');
    div.className = 'mb-2 d-flex gap-2 align-items-center';
    div.innerHTML = `
        <input type="text" class="form-control form-control-sm" name="highlights[]" placeholder="Tambahkan highlight aktivitas">
        <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeRow(this)">
            <i class="bi bi-trash-fill me-1"></i>Hapus
        </button>
    `;
    container.appendChild(div);
    updateDeleteButtons('highlightContainer');
}

function addSchedule() {
    scheduleCount++;
    const container = document.getElementById('scheduleContainer');
    const div = document.createElement('div');
    div.className = 'card mb-3 border-0 bg-light';
    div.innerHTML = `
        <div class="card-body">
            <div class="d-flex justify-content-between mb-2">
                <strong><i class="bi bi-calendar-day me-1"></i>Hari ${scheduleCount}</strong>
                <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeScheduleCard(this)">
                    <i class="bi bi-trash-fill me-1"></i>Hapus
                </button>
            </div>
            <input type="text" class="form-control form-control-sm mb-2" name="schedule_day[]" placeholder="Judul Hari">
            <textarea class="form-control form-control-sm" name="schedule_content[]" rows="3" placeholder="Detail kegiatan hari ini..."></textarea>
        </div>
    `;
    container.appendChild(div);
    updateDeleteButtons('scheduleContainer');
}

function removeRow(btn) {
    btn.closest('.mb-2, .d-flex').remove();
    updateDeleteButtons('highlightContainer');
}

function removeScheduleCard(btn) {
    btn.closest('.card').remove();
    updateScheduleNumbers();
}

function updateDeleteButtons(containerId) {
    const container = document.getElementById(containerId);
    const items = container.querySelectorAll('.mb-2, .card');
    items.forEach((item, index) => {
        const btn = item.querySelector('.btn-outline-danger');
        if (btn && items.length > 1) {
            btn.style.display = '';
        } else if (btn) {
            btn.style.display = 'none';
        }
    });
}

function updateScheduleNumbers() {
    const schedules = document.querySelectorAll('#scheduleContainer .card');
    schedules.forEach((card, index) => {
        card.querySelector('strong').innerHTML = `<i class="bi bi-calendar-day me-1"></i>Hari ${index + 1}`;
    });
    scheduleCount = schedules.length;
    updateDeleteButtons('scheduleContainer');
}

document.addEventListener('DOMContentLoaded', function() {
    updateDeleteButtons('highlightContainer');
    updateDeleteButtons('scheduleContainer');
});
</script>

<style>
.card {
    border: none;
}

.form-control-sm {
    font-size: 0.9rem;
}

.btn-sm {
    font-size: 0.85rem;
}
</style>
@endsection