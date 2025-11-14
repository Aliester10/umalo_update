@extends('layouts.Admin.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="bi bi-pencil-square me-2"></i>Edit Aktivitas
                    </h5>
                    <a href="{{ route('Admin.Activity.index') }}" class="btn btn-dark btn-sm">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('Admin.Activity.update', $activity) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Gambar Section -->
                        <div class="border-bottom pb-4 mb-4">
                            <h6 class="text-warning mb-3">
                                <i class="bi bi-images me-2"></i>Media & Gambar
                            </h6>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Gambar Utama</label>
                                    <input type="file" class="form-control @error('images') is-invalid @enderror" 
                                           name="images" accept="image/*" onchange="previewImage(this, 'preview1')">
                                    <small class="text-muted d-block mt-1">Kosongkan jika tidak ingin mengubah</small>
                                    @error('images')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    
                                    <div class="mt-2">
                                        <label class="text-muted small fw-semibold">Gambar Saat Ini:</label>
                                        <div id="preview1">
                                            @if($activity->images)
                                                <img src="{{ asset($activity->images) }}" class="img-thumbnail" style="max-height: 150px;">
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Cover Image</label>
                                    <input type="file" class="form-control @error('cover_image') is-invalid @enderror" 
                                           name="cover_image" accept="image/*" onchange="previewImage(this, 'preview2')">
                                    <small class="text-muted d-block mt-1">Kosongkan jika tidak ingin mengubah</small>
                                    @error('cover_image')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    
                                    <div class="mt-2">
                                        @if($activity->cover_image)
                                            <label class="text-muted small fw-semibold">Cover Saat Ini:</label>
                                            <div id="preview2">
                                                <img src="{{ asset($activity->cover_image) }}" class="img-thumbnail" style="max-height: 150px;">
                                            </div>
                                        @else
                                            <div id="preview2"></div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Informasi Dasar -->
                        <div class="border-bottom pb-4 mb-4">
                            <h6 class="text-warning mb-3">
                                <i class="bi bi-info-circle-fill me-2"></i>Informasi Dasar
                            </h6>
                            
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Judul <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                       name="title" value="{{ old('title', $activity->title) }}" required>
                                @error('title')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Deskripsi <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                          name="description" rows="4" required>{{ old('description', $activity->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-semibold">Kategori</label>
                                    <input type="text" class="form-control" name="category" value="{{ old('category', $activity->category) }}">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-semibold">Status</label>
                                    <select class="form-select" name="status">
                                        <option value="">-- Pilih Status --</option>
                                        <option value="Coming Soon" {{ old('status', $activity->status) == 'Coming Soon' ? 'selected' : '' }}>Coming Soon</option>
                                        <option value="Berlangsung" {{ old('status', $activity->status) == 'Berlangsung' ? 'selected' : '' }}>Berlangsung</option>
                                        <option value="Selesai" {{ old('status', $activity->status) == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                    </select>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-semibold">Tags</label>
                                    <input type="text" class="form-control" name="tags" 
                                           value="{{ old('tags', is_array($activity->tags) ? implode(',', $activity->tags) : $activity->tags) }}" 
                                           placeholder="Pisahkan dengan koma">
                                </div>
                            </div>
                        </div>

<!-- Detail Kegiatan -->
<div class="border-bottom pb-4 mb-4">
    <h6 class="text-warning mb-3">
        <i class="bi bi-calendar-event-fill me-2"></i>Detail Kegiatan
    </h6>
    
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">Tanggal Mulai</label>
            <input type="date" class="form-control" name="start_date"
                value="{{ old('start_date', $activity->start_date ? $activity->start_date->format('Y-m-d') : '') }}">
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">Tanggal Selesai</label>
            <input type="date" class="form-control" name="end_date"
                value="{{ old('end_date', $activity->end_date ? $activity->end_date->format('Y-m-d') : '') }}">
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mb-3">
            <label class="form-label fw-semibold">Lokasi</label>
            <input type="text" class="form-control" name="location"
                value="{{ old('location', $activity->location) }}">
        </div>

        <div class="col-md-4 mb-3">
            <label class="form-label fw-semibold">Durasi</label>
            <input type="text" class="form-control" name="duration"
                value="{{ old('duration', $activity->duration) }}">
        </div>

        <div class="col-md-4 mb-3">
            <label class="form-label fw-semibold">Jumlah Peserta</label>
            <input type="number" class="form-control" name="participants"
                value="{{ old('participants', $activity->participants) }}" min="0">
        </div>
    </div>
</div>


                        <!-- Galeri -->
                        <div class="border-bottom pb-4 mb-4">
                            <h6 class="text-warning mb-3">
                                <i class="bi bi-images me-2"></i>Galeri Foto
                            </h6>
                            
                            @if($activity->galleries->count() > 0)
                            <div class="mb-4">
                                <label class="form-label fw-semibold small">
                                    Galeri Foto Saat Ini:
                                </label>
                                <div class="row g-2" id="currentGallery">
                                    @foreach($activity->galleries as $gallery)
                                    <div class="col-md-2 col-sm-3 col-4" id="gallery-item-{{ $gallery->id }}">
                                        <div class="position-relative">
                                            <img src="{{ asset($gallery->image) }}" class="img-thumbnail w-100" 
                                                 style="height: 100px; object-fit: cover;">
                                            <button type="button" 
                                                    class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1" 
                                                    onclick="deleteGallery({{ $gallery->id }}), event.preventDefault()"
                                                    title="Hapus foto ini">
                                                <i class="bi bi-x-lg"></i>
                                            </button>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div id="deleteGalleryInputs"></div>
                            </div>
                            @endif

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Tambah Foto Ke Galeri</label>
                                <input type="file" class="form-control" name="gallery[]" multiple accept="image/*" 
                                       onchange="previewMultiple(this, 'newGalleryPreview')">
                                <small class="text-muted d-block mt-1">Pilih foto baru untuk ditambahkan</small>
                                <div id="newGalleryPreview" class="row mt-3"></div>
                            </div>
                        </div>

                        <!-- Highlights -->
                        <div class="border-bottom pb-4 mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="text-warning mb-0">
                                    <i class="bi bi-star-fill me-2"></i>Highlights
                                </h6>
                                <button type="button" class="btn btn-sm btn-outline-warning" onclick="addHighlight()">
                                    <i class="bi bi-plus-circle me-1"></i> Tambah
                                </button>
                            </div>
                            
                            <div id="highlightContainer">
                                @forelse($activity->highlights as $h)
                                <div class="mb-2 d-flex gap-2 align-items-center">
                                    <input type="hidden" name="highlight_ids[]" value="{{ $h->id }}">
                                    <input type="text" class="form-control form-control-sm" name="highlights_old[]" value="{{ $h->highlight }}">
                                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteHighlight({{ $h->id }}, this)">
                                        <i class="bi bi-trash-fill me-1"></i>Hapus
                                    </button>
                                </div>
                                @empty
                                <div class="mb-2 d-flex gap-2 align-items-center">
                                    <input type="text" class="form-control form-control-sm" name="highlights[]" placeholder="Tambahkan highlight">
                                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeRow(this)" style="display:none;">
                                        <i class="bi bi-trash-fill me-1"></i>Hapus
                                    </button>
                                </div>
                                @endforelse
                            </div>
                            <div id="deleteHighlightInputs"></div>
                        </div>

                        <!-- Jadwal -->
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="text-warning mb-0">
                                    <i class="bi bi-calendar2-week-fill me-2"></i>Jadwal Kegiatan
                                </h6>
                                <button type="button" class="btn btn-sm btn-outline-warning" onclick="addSchedule()">
                                    <i class="bi bi-plus-circle me-1"></i> Tambah Hari
                                </button>
                            </div>
                            
                            <div id="scheduleContainer">
                                @forelse($activity->schedules as $index => $s)
                                <div class="card mb-3 border-0 bg-light">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between mb-2">
                                            <strong>
                                                <i class="bi bi-calendar-day me-1"></i>Hari {{ $index + 1 }}
                                            </strong>
                                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteSchedule({{ $s->id }}, this)">
                                                <i class="bi bi-trash-fill me-1"></i>Hapus
                                            </button>
                                        </div>
                                        <input type="hidden" name="schedule_ids[]" value="{{ $s->id }}">
                                        <input type="text" class="form-control form-control-sm mb-2" name="schedule_old_day[]" value="{{ $s->day_title }}" placeholder="Judul Hari">
                                        <textarea class="form-control form-control-sm" name="schedule_old_content[]" rows="3" placeholder="Detail kegiatan...">{{ $s->schedule_content }}</textarea>
                                    </div>
                                </div>
                                @empty
                                <div class="card mb-3 border-0 bg-light">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between mb-2">
                                            <strong>
                                                <i class="bi bi-calendar-day me-1"></i>Hari 1
                                            </strong>
                                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeScheduleCard(this)" style="display:none;">
                                                <i class="bi bi-trash-fill me-1"></i>Hapus
                                            </button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm mb-2" name="schedule_day[]" placeholder="Judul Hari">
                                        <textarea class="form-control form-control-sm" name="schedule_content[]" rows="3" placeholder="Detail kegiatan..."></textarea>
                                    </div>
                                </div>
                                @endforelse
                            </div>
                            <div id="deleteScheduleInputs"></div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="pt-3 border-top">
                            <button type="submit" class="btn btn-warning text-dark btn-sm px-4">
                                <i class="bi bi-save-fill me-1"></i> Simpan Perubahan
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
let scheduleCount = {{ $activity->schedules->count() > 0 ? $activity->schedules->count() : 1 }};

function previewImage(input, previewId) {
    const preview = document.getElementById(previewId);
    
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

function deleteGallery(galleryId) {
    if (confirm('Hapus foto ini dari galeri?')) {
        const galleryItem = document.getElementById('gallery-item-' + galleryId);
        galleryItem.style.opacity = '0.5';
        galleryItem.style.filter = 'grayscale(100%)';
        
        const deleteInputs = document.getElementById('deleteGalleryInputs');
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'delete_gallery[]';
        input.value = galleryId;
        deleteInputs.appendChild(input);
        
        const btn = galleryItem.querySelector('button');
        btn.classList.remove('btn-danger');
        btn.classList.add('btn-success');
        btn.innerHTML = '<i class="bi bi-arrow-counterclockwise"></i>';
        btn.onclick = function(e) { 
            e.preventDefault();
            undoDeleteGallery(galleryId); 
        };
        btn.title = 'Batalkan hapus';
    }
}

function undoDeleteGallery(galleryId) {
    const galleryItem = document.getElementById('gallery-item-' + galleryId);
    galleryItem.style.opacity = '1';
    galleryItem.style.filter = 'none';
    
    const deleteInputs = document.getElementById('deleteGalleryInputs');
    const inputs = deleteInputs.querySelectorAll('input');
    inputs.forEach(input => {
        if (input.value == galleryId) {
            input.remove();
        }
    });
    
    const btn = galleryItem.querySelector('button');
    btn.classList.remove('btn-success');
    btn.classList.add('btn-danger');
    btn.innerHTML = '<i class="bi bi-x-lg"></i>';
    btn.onclick = function(e) { 
        e.preventDefault();
        deleteGallery(galleryId); 
    };
    btn.title = 'Hapus foto ini';
}

function addHighlight() {
    const container = document.getElementById('highlightContainer');
    const div = document.createElement('div');
    div.className = 'mb-2 d-flex gap-2 align-items-center';
    div.innerHTML = `
        <input type="text" class="form-control form-control-sm" name="highlights[]" placeholder="Tambahkan highlight baru">
        <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeRow(this)">
            <i class="bi bi-trash-fill me-1"></i>Hapus
        </button>
    `;
    container.appendChild(div);
}

function deleteHighlight(id, btn) {
    if (!confirm('Hapus highlight ini?')) return;
    const row = btn.closest('.mb-2');
    if (row) row.remove();
    const container = document.getElementById('deleteHighlightInputs');
    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'delete_highlight[]';
    input.value = id;
    container.appendChild(input);
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
            <textarea class="form-control form-control-sm" name="schedule_content[]" rows="3" placeholder="Detail kegiatan..."></textarea>
        </div>
    `;
    container.appendChild(div);
}

function deleteSchedule(id, btn) {
    if (!confirm('Hapus jadwal hari ini?')) return;
    const card = btn.closest('.card');
    if (card) card.remove();
    const container = document.getElementById('deleteScheduleInputs');
    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'delete_schedule[]';
    input.value = id;
    container.appendChild(input);
    updateScheduleNumbers();
}

function removeRow(btn) {
    if (confirm('Hapus item ini?')) {
        btn.closest('.mb-2, .d-flex').remove();
    }
}

function removeScheduleCard(btn) {
    if (confirm('Hapus jadwal hari ini?')) {
        btn.closest('.card').remove();
        updateScheduleNumbers();
    }
}

function updateScheduleNumbers() {
    const schedules = document.querySelectorAll('#scheduleContainer .card');
    schedules.forEach((card, index) => {
        card.querySelector('strong').innerHTML = `<i class="bi bi-calendar-day me-1"></i>Hari ${index + 1}`;
    });
    scheduleCount = schedules.length;
}

document.addEventListener('DOMContentLoaded', function() {
    // tidak perlu logic hide delete button lagi, biarkan user bisa hapus bebas
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

.btn-outline-danger:hover {
    color: #fff;
}

.btn-outline-warning:hover {
    color: #000;
}
</style>
@endsection