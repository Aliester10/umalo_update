@extends('layouts.Admin.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="bi bi-eye-fill me-2"></i>Detail Aktivitas
                    </h5>
                    <div class="btn-group btn-group-sm" role="group">
                        <a href="{{ route('Admin.Activity.edit', $activity->id) }}" class="btn btn-warning text-dark">
                            <i class="bi bi-pencil-square me-1"></i> Edit
                        </a>
                        <a href="{{ route('Admin.Activity.index') }}" class="btn btn-light">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </div>

                <div class="card-body p-4">
                    <!-- Cover or Main Image -->
                    @if($activity->cover_image)
                    <div class="mb-4">
                        <img src="{{ asset($activity->cover_image) }}" class="img-fluid w-100 rounded shadow-sm" 
                             style="max-height: 400px; object-fit: cover;">
                    </div>
                    @elseif($activity->images)
                    <div class="mb-4 text-center">
                        <img src="{{ asset($activity->images) }}" class="img-fluid rounded shadow-sm" 
                             style="max-height: 350px;">
                    </div>
                    @endif

                    <!-- Title & Status -->
                    <div class="mb-4 pb-3 border-bottom">
                        <h3><i class="bi bi-bookmark-fill text-primary me-2"></i>{{ $activity->title }}</h3>
                        @if($activity->status)
                            @if($activity->status == 'Berlangsung')
                                <span class="badge bg-success fs-6">
                                    <i class="bi bi-play-circle-fill me-1"></i>{{ $activity->status }}
                                </span>
                            @elseif($activity->status == 'Selesai')
                                <span class="badge bg-secondary fs-6">
                                    <i class="bi bi-check-circle-fill me-1"></i>{{ $activity->status }}
                                </span>
                            @elseif($activity->status == 'Coming Soon')
                                <span class="badge bg-warning text-dark fs-6">
                                    <i class="bi bi-clock-fill me-1"></i>{{ $activity->status }}
                                </span>
                            @endif
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-lg-8">
                            <!-- Description -->
                            <div class="mb-4">
                                <h6 class="border-bottom pb-2 mb-3">
                                    <i class="bi bi-file-text-fill text-primary me-2"></i>Deskripsi Kegiatan
                                </h6>
                                <p class="text-justify">{{ $activity->description }}</p>
                            </div>

                            <!-- Highlights -->
                            @if($activity->highlights->count() > 0)
                            <div class="mb-4">
                                <h6 class="border-bottom pb-2 mb-3">
                                    <i class="bi bi-star-fill text-warning me-2"></i>Highlights
                                </h6>
                                <ul class="list-unstyled">
                                    @foreach($activity->highlights as $h)
                                        <li class="mb-2">
                                            <i class="bi bi-check-circle-fill text-success me-2"></i>{{ $h->highlight }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            <!-- Schedule -->
                            @if($activity->schedules->count() > 0)
                            <div class="mb-4">
                                <h6 class="border-bottom pb-2 mb-3">
                                    <i class="bi bi-calendar2-week-fill text-primary me-2"></i>Jadwal Kegiatan
                                </h6>
                                <div class="accordion" id="scheduleAccordion">
                                    @foreach($activity->schedules as $index => $s)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button {{ $index != 0 ? 'collapsed' : '' }}" 
                                                    type="button" 
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#collapse{{ $index }}">
                                                <i class="bi bi-calendar-day-fill me-2"></i>{{ $s->day_title }}
                                            </button>
                                        </h2>
                                        <div id="collapse{{ $index }}" 
                                             class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}"
                                             data-bs-parent="#scheduleAccordion">
                                            <div class="accordion-body">
                                                {!! nl2br(e($s->schedule_content)) !!}
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            <!-- Gallery -->
                            @if($activity->galleries->count() > 0)
                            <div class="mb-4">
                                <h6 class="border-bottom pb-2 mb-3">
                                    <i class="bi bi-images text-primary me-2"></i>Galeri Foto
                                </h6>
                                <div class="row g-2">
                                    @foreach($activity->galleries as $gallery)
                                    <div class="col-md-3 col-sm-4 col-6">
                                        <img src="{{ asset($gallery->image) }}" 
                                             class="img-thumbnail w-100" 
                                             style="height: 150px; object-fit: cover; cursor: pointer;"
                                             onclick="showImage('{{ asset($gallery->image) }}')">
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>

                        <!-- Sidebar -->
                        <div class="col-lg-4">
                            <div class="card bg-light border-0 mb-3">
                                <div class="card-header bg-white border-bottom">
                                    <h6 class="mb-0">
                                        <i class="bi bi-info-circle-fill text-info me-2"></i>Informasi Detail
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-sm table-borderless mb-0">
                                        @if($activity->category)
                                        <tr>
                                            <td width="45%">
                                                <small class="fw-semibold"><i class="bi bi-tag-fill text-primary me-1"></i>Kategori</small>
                                            </td>
                                            <td>
                                                <small>{{ $activity->category }}</small>
                                            </td>
                                        </tr>
                                        @endif

                                        @if($activity->location)
                                        <tr>
                                            <td>
                                                <small class="fw-semibold"><i class="bi bi-geo-alt-fill text-danger me-1"></i>Lokasi</small>
                                            </td>
                                            <td>
                                                <small>{{ $activity->location }}</small>
                                            </td>
                                        </tr>
                                        @endif

                                        @if($activity->duration)
                                        <tr>
                                            <td>
                                                <small class="fw-semibold"><i class="bi bi-clock-fill text-warning me-1"></i>Durasi</small>
                                            </td>
                                            <td>
                                                <small>{{ $activity->duration }}</small>
                                            </td>
                                        </tr>
                                        @endif

                                        @if($activity->participants)
                                        <tr>
                                            <td>
                                                <small class="fw-semibold"><i class="bi bi-people-fill text-info me-1"></i>Peserta</small>
                                            </td>
                                            <td>
                                                <small>{{ $activity->participants }} Orang</small>
                                            </td>
                                        </tr>
                                        @endif

                                        @if($activity->start_date)
                                        <tr>
                                            <td>
                                                <small class="fw-semibold"><i class="bi bi-calendar-event text-success me-1"></i>Mulai</small>
                                            </td>
                                            <td>
                                                <small>{{ \Carbon\Carbon::parse($activity->start_date)->format('d M Y') }}</small>
                                            </td>
                                        </tr>
                                        @endif

                                        @if($activity->end_date)
                                        <tr>
                                            <td>
                                                <small class="fw-semibold"><i class="bi bi-calendar-check text-primary me-1"></i>Selesai</small>
                                            </td>
                                            <td>
                                                <small>{{ \Carbon\Carbon::parse($activity->end_date)->format('d M Y') }}</small>
                                            </td>
                                        </tr>
                                        @endif

                                        @if($activity->tags)
                                        <tr>
                                            <td colspan="2" class="pt-3">
                                                <small class="fw-semibold"><i class="bi bi-tags-fill text-secondary me-1"></i>Tags:</small><br>
                                                @php
                                                    $tags = is_array($activity->tags) ? $activity->tags : explode(',', $activity->tags);
                                                @endphp
                                                <div class="mt-2">
                                                    @foreach($tags as $tag)
                                                        <span class="badge bg-secondary me-1 mb-1">{{ trim($tag) }}</span>
                                                    @endforeach
                                                </div>
                                            </td>
                                        </tr>
                                        @endif
                                    </table>
                                </div>
                            </div>

                            <!-- Actions Card -->
                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-white border-bottom">
                                    <h6 class="mb-0">
                                        <i class="bi bi-gear-fill text-warning me-2"></i>Aksi
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <a href="{{ route('Admin.Activity.edit', $activity->id) }}" class="btn btn-warning btn-sm w-100 mb-2 text-white">
                                        <i class="bi bi-pencil-square me-1"></i> Edit Aktivitas
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm w-100" onclick="confirmDelete()">
                                        <i class="bi bi-trash-fill me-1"></i> Hapus Aktivitas
                                    </button>

                                    <form id="delete-form" action="{{ route('Admin.Activity.destroy', $activity->id) }}" method="POST" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header bg-light border-bottom">
                <h5 class="modal-title"><i class="bi bi-image me-2"></i>Preview Gambar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0">
                <img src="" id="modalImage" class="img-fluid w-100">
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0">
            <div class="modal-header bg-danger text-white border-0">
                <h5 class="modal-title">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center py-4">
                <i class="bi bi-trash3 display-4 text-danger opacity-50 mb-3"></i>
                <p class="mb-2">Hapus aktivitas ini?</p>
                <h6 class="text-primary mb-3">{{ $activity->title }}</h6>
                <div class="alert alert-warning border-0 py-2">
                    <small><i class="bi bi-exclamation-circle-fill me-2"></i>Data akan terhapus permanen!</small>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-1"></i> Batal
                </button>
                <button type="button" class="btn btn-danger btn-sm" onclick="submitDelete()">
                    <i class="bi bi-trash-fill me-1"></i> Hapus
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete() {
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    deleteModal.show();
}

function submitDelete() {
    document.getElementById('delete-form').submit();
}

function showImage(imageUrl) {
    document.getElementById('modalImage').src = imageUrl;
    const imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
    imageModal.show();
}
</script>

<style>
.card {
    border: none;
}

.table-borderless td {
    padding: 0.5rem 0;
    vertical-align: middle;
}

.btn-sm {
    font-size: 0.85rem;
}

.accordion-button:not(.collapsed) {
    background-color: #e7f1ff;
    color: #0d6efd;
}

.accordion-button:focus {
    box-shadow: none;
    border-color: #0d6efd;
}
</style>
@endsection