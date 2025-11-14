@extends('layouts.Admin.master')

@section('content')

<div class="card shadow-lg">
    <div class="card-header">
        <h1 class="h4">Edit Aktivitas</h1>
    </div>

    <div class="card-body">
        <form action="{{ route('Admin.Activity.update', $activity) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Main Image --}}
            <div class="mb-3">
                <label class="form-label">Gambar Utama</label>
                <input type="file" class="form-control" name="images">
                <div class="mt-2">
                    <img src="{{ asset($activity->images) }}" style="max-width:120px;" class="img-thumbnail">
                </div>
            </div>

            {{-- Cover Image --}}
            <div class="mb-3">
                <label class="form-label">Cover Image (Header Besar)</label>
                <input type="file" class="form-control" name="cover_image">
                @if($activity->cover_image)
                <div class="mt-2">
                    <img src="{{ asset($activity->cover_image) }}" style="max-width:120px;" class="img-thumbnail">
                </div>
                @endif
            </div>

            {{-- Title --}}
            <div class="mb-3">
                <label class="form-label">Judul</label>
                <input type="text" class="form-control" name="title" value="{{ $activity->title }}" required>
            </div>

            {{-- Description --}}
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea class="form-control" name="description" rows="4">{{ $activity->description }}</textarea>
            </div>

            {{-- Start / End Date --}}
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Mulai</label>
                    <input type="date" class="form-control" name="start_date" value="{{ $activity->start_date }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Selesai</label>
                    <input type="date" class="form-control" name="end_date" value="{{ $activity->end_date }}">
                </div>
            </div>

            {{-- Location --}}
            <div class="mb-3">
                <label class="form-label">Lokasi</label>
                <input type="text" class="form-control" name="location" value="{{ $activity->location }}">
            </div>

            {{-- Participants --}}
            <div class="mb-3">
                <label class="form-label">Jumlah Peserta</label>
                <input type="number" class="form-control" name="participants" value="{{ $activity->participants }}">
            </div>

            {{-- Duration --}}
            <div class="mb-3">
                <label class="form-label">Durasi</label>
                <input type="text" class="form-control" name="duration" value="{{ $activity->duration }}">
            </div>

            {{-- Category --}}
            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <input type="text" class="form-control" name="category" value="{{ $activity->category }}">
            </div>

            {{-- Status --}}
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select class="form-select" name="status">
                    <option value="">-- Pilih Status --</option>
                    <option value="Berlangsung" {{ $activity->status == 'Berlangsung' ? 'selected' : '' }}>Berlangsung</option>
                    <option value="Selesai" {{ $activity->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="Coming Soon" {{ $activity->status == 'Coming Soon' ? 'selected' : '' }}>Coming Soon</option>
                </select>
            </div>

            {{-- Tags --}}
            <div class="mb-3">
                <label class="form-label">Tags</label>
                <input type="text" class="form-control" name="tags"
                    value="{{ is_array($activity->tags) ? implode(',', $activity->tags) : $activity->tags }}">
            </div>

            {{-- Gallery --}}
            <div class="mb-3">
                <label class="form-label">Galeri Foto (Tambahkan Baru)</label>
                <input type="file" class="form-control" name="gallery[]" multiple>

                <div class="mt-3">
                    <label class="form-label">Galeri Saat Ini:</label>
                    <div class="row">
                        @foreach($activity->galleries as $gallery)
                        <div class="col-md-3 mb-2 text-center">
                            <img src="{{ asset($gallery->image) }}" style="max-width:120px;" class="img-thumbnail">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Highlights --}}
            <div class="mb-3">
                <label class="form-label">Highlights</label>
                <div id="highlight-wrapper">
                    @foreach($activity->highlights as $h)
                        <input type="text" class="form-control mb-2" name="highlights_old[{{ $h->id }}]"
                            value="{{ $h->highlight }}">
                    @endforeach
                </div>
                <button type="button" class="btn btn-sm btn-secondary" onclick="addHighlight()">+ Tambah Highlight</button>
            </div>

            {{-- Schedule --}}
            <div class="mb-3">
                <label class="form-label">Jadwal</label>
                <div id="schedule-wrapper">

                    @foreach($activity->schedules as $s)
                    <div class="border rounded p-3 mb-3">
                        <input type="text" class="form-control mb-2"
                            name="schedule_old_day[{{ $s->id }}]" value="{{ $s->day_title }}">
                        <textarea class="form-control"
                            name="schedule_old_content[{{ $s->id }}]" rows="3">{{ $s->schedule_content }}</textarea>
                    </div>
                    @endforeach

                </div>

                <button type="button" class="btn btn-sm btn-secondary" onclick="addSchedule()">+ Tambah Hari</button>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>
        </form>
    </div>
</div>

<script>
function addHighlight() {
    document.getElementById('highlight-wrapper')
        .insertAdjacentHTML('beforeend',
            `<input type="text" class="form-control mb-2" name="highlights[]" placeholder="Tambahkan highlight">`);
}

function addSchedule() {
    document.getElementById('schedule-wrapper')
        .insertAdjacentHTML('beforeend',
            `<div class="border rounded p-3 mb-3">
                <input type="text" class="form-control mb-2" name="schedule_day[]" placeholder="Hari ...">
                <textarea class="form-control" name="schedule_content[]" rows="3"></textarea>
            </div>`);
}
</script>

@endsection
