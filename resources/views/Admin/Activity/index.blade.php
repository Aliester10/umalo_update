@extends('layouts.Admin.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center py-3">
                    <div>
                        <h4 class="mb-1"><i class="bi bi-calendar-check-fill text-primary me-2"></i>Daftar Aktivitas</h4>
                        <small class="text-muted">Kelola semua aktivitas organisasi Anda</small>
                    </div>
                    <a href="{{ route('Admin.Activity.create') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle-fill me-1"></i> Tambah Aktivitas
                    </a>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show border-start border-success border-4">
                            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show border-start border-danger border-4">
                            <i class="bi bi-exclamation-circle-fill me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Filter Section -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <div class="input-group input-group-sm">
                                <span class="input-group-text bg-white border">
                                    <i class="bi bi-search"></i>
                                </span>
                                <input type="text" class="form-control" id="searchInput" placeholder="Cari aktivitas...">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select form-select-sm" id="filterStatus">
                                <option value="">Semua Status</option>
                                <option value="Coming Soon">Coming Soon</option>
                                <option value="Berlangsung">Berlangsung</option>
                                <option value="Selesai">Selesai</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select form-select-sm" id="filterCategory">
                                <option value="">Semua Kategori</option>
                                @foreach($activities->pluck('category')->unique()->filter() as $category)
                                    <option value="{{ $category }}">{{ $category }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-outline-secondary btn-sm w-100" onclick="resetFilters()">
                                <i class="bi bi-arrow-clockwise me-1"></i> Reset
                            </button>
                        </div>
                    </div>

                    @if($activities->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle" id="activitiesTable">
                                <thead class="table-light">
                                    <tr>
                                        <th width="80">Gambar</th>
                                        <th>Judul</th>
                                        <th width="180">Tanggal</th>
                                        <th width="120">Kategori</th>
                                        <th width="100">Status</th>
                                        <th width="140">Lokasi</th>
                                        <th width="70" class="text-center">Peserta</th>
                                        <th width="210" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($activities as $activity)
                                    <tr>
                                        <td>
                                            <img src="{{ asset($activity->images) }}" 
                                                 alt="{{ $activity->title }}"
                                                 class="img-thumbnail rounded"
                                                 style="width: 65px; height: 65px; object-fit: cover;">
                                        </td>

                                        <td>
                                            <div class="fw-semibold text-dark mb-1">{{ Str::limit($activity->title, 40) }}</div>
                                            <small class="text-muted">{{ Str::limit($activity->description, 65) }}</small>
                                        </td>

                                        <td>
                                            @if($activity->start_date && $activity->end_date)
                                                <div class="d-flex flex-column">
                                                    <small>
                                                        <i class="bi bi-calendar-event text-primary me-1"></i>
                                                        {{ \Carbon\Carbon::parse($activity->start_date)->format('d M Y') }}
                                                    </small>
                                                    <small class="text-muted">
                                                        <i class="bi bi-calendar-check text-success me-1"></i>
                                                        {{ \Carbon\Carbon::parse($activity->end_date)->format('d M Y') }}
                                                    </small>
                                                </div>
                                            @else
                                                <span class="text-muted small">-</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if($activity->category)
                                                <span class="badge bg-light text-dark border border-secondary">
                                                    {{ $activity->category }}
                                                </span>
                                            @else
                                                <span class="text-muted small">-</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if($activity->status == 'Berlangsung')
                                                <span class="badge bg-success">
                                                    <i class="bi bi-play-circle-fill me-1"></i>{{ $activity->status }}
                                                </span>
                                            @elseif($activity->status == 'Selesai')
                                                <span class="badge bg-secondary">
                                                    <i class="bi bi-check-circle-fill me-1"></i>{{ $activity->status }}
                                                </span>
                                            @elseif($activity->status == 'Coming Soon')
                                                <span class="badge bg-warning text-dark">
                                                    <i class="bi bi-clock-fill me-1"></i>{{ $activity->status }}
                                                </span>
                                            @else
                                                <span class="text-muted small">-</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if($activity->location)
                                                <small>
                                                    <i class="bi bi-geo-alt-fill text-danger me-1"></i>
                                                    {{ Str::limit($activity->location, 15) }}
                                                </small>
                                            @else
                                                <span class="text-muted small">-</span>
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            @if($activity->participants)
                                                <span class="badge bg-info">
                                                    {{ $activity->participants }}
                                                </span>
                                            @else
                                                <span class="text-muted small">-</span>
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="{{ route('Admin.Activity.show', $activity->id) }}" 
                                                   class="btn btn-outline-info" 
                                                   title="Lihat Detail">
                                                    <i class="bi bi-eye-fill me-1"></i>Lihat
                                                </a>

                                                <a href="{{ route('Admin.Activity.edit', $activity->id) }}" 
                                                   class="btn btn-outline-warning" 
                                                   title="Edit Aktivitas">
                                                    <i class="bi bi-pencil-square me-1"></i>Edit
                                                </a>

                                                <button type="button" 
                                                        class="btn btn-outline-danger" 
                                                        onclick="confirmDelete({{ $activity->id }}, '{{ addslashes($activity->title) }}')"
                                                        title="Hapus Aktivitas">
                                                    <i class="bi bi-trash-fill me-1"></i>Hapus
                                                </button>
                                            </div>

                                            <!-- Hidden Delete Form -->
                                            <form id="delete-form-{{ $activity->id }}" 
                                                  action="{{ route('Admin.Activity.destroy', $activity->id) }}" 
                                                  method="POST" 
                                                  class="d-none">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        @if($activities instanceof \Illuminate\Pagination\LengthAwarePaginator)
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <div class="text-muted small">
                                <i class="bi bi-info-circle me-1"></i>
                                Menampilkan <strong>{{ $activities->firstItem() }}</strong> - <strong>{{ $activities->lastItem() }}</strong> 
                                dari <strong>{{ $activities->total() }}</strong> aktivitas
                            </div>
                            <div>
                                {{ $activities->links() }}
                            </div>
                        </div>
                        @endif

                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-inbox display-1 text-muted opacity-50"></i>
                            <h5 class="mt-3 text-muted">Belum ada aktivitas</h5>
                            <p class="text-muted">Mulai tambahkan aktivitas baru untuk organisasi Anda</p>
                            <a href="{{ route('Admin.Activity.create') }}" class="btn btn-primary mt-3 btn-sm">
                                <i class="bi bi-plus-circle-fill me-2"></i> Tambah Aktivitas Pertama
                            </a>
                        </div>
                    @endif
                </div>
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
                <p class="mb-2">Hapus aktivitas:</p>
                <h6 class="text-primary mb-3" id="activityTitle"></h6>
                <div class="alert alert-warning border-0 py-2">
                    <small><i class="bi bi-exclamation-circle-fill me-2"></i>Data akan terhapus permanen!</small>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-1"></i> Batal
                </button>
                <button type="button" class="btn btn-danger btn-sm" id="confirmDeleteBtn">
                    <i class="bi bi-trash-fill me-1"></i> Hapus
                </button>
            </div>
        </div>
    </div>
</div>

<script>
let deleteFormId = null;

function confirmDelete(activityId, activityTitle) {
    deleteFormId = activityId;
    document.getElementById('activityTitle').textContent = activityTitle;
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    deleteModal.show();
}

document.getElementById('confirmDeleteBtn')?.addEventListener('click', function() {
    if (deleteFormId) {
        document.getElementById('delete-form-' + deleteFormId).submit();
    }
});

document.getElementById('searchInput')?.addEventListener('keyup', filterTable);
document.getElementById('filterStatus')?.addEventListener('change', filterTable);
document.getElementById('filterCategory')?.addEventListener('change', filterTable);

function filterTable() {
    const searchValue = document.getElementById('searchInput').value.toLowerCase();
    const statusValue = document.getElementById('filterStatus').value;
    const categoryValue = document.getElementById('filterCategory').value;
    
    const table = document.getElementById('activitiesTable');
    const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
    
    Array.from(rows).forEach(row => {
        const title = row.cells[1].textContent.toLowerCase();
        const status = row.cells[4].textContent.trim();
        const category = row.cells[3].textContent.trim();
        
        let showRow = true;
        
        if (searchValue && !title.includes(searchValue)) showRow = false;
        if (statusValue && !status.includes(statusValue)) showRow = false;
        if (categoryValue && !category.includes(categoryValue)) showRow = false;
        
        row.style.display = showRow ? '' : 'none';
    });
}

function resetFilters() {
    document.getElementById('searchInput').value = '';
    document.getElementById('filterStatus').value = '';
    document.getElementById('filterCategory').value = '';
    filterTable();
}

document.addEventListener('DOMContentLoaded', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script>

<style>
.table-hover tbody tr:hover {
    background-color: rgba(13, 110, 253, 0.05);
    transition: background-color 0.2s ease;
}

.btn-group-sm .btn {
    padding: 0.35rem 0.65rem;
    font-size: 0.85rem;
}

.btn-group-sm .btn i {
    font-size: 0.9rem;
}

.card {
    border: none;
}
</style>
@endsection