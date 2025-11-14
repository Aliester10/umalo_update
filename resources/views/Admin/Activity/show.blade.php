@extends('layouts.Admin.master')

@section('content')

<div class="card shadow-lg">
    <div class="card-header bg-primary text-white">
        <h4>{{ $activity->title }}</h4>
    </div>

    <div class="card-body">

        {{-- Main Image --}}
        @if ($activity->images)
        <div class="mb-4 text-center">
            <img src="{{ asset($activity->images) }}" 
                 class="img-fluid img-thumbnail"
                 style="max-height: 280px; object-fit:cover;">
        </div>
        @endif

        {{-- Cover Image --}}
        @if ($activity->cover_image)
        <h5>Cover Image</h5>
        <div class="mb-4 text-center">
            <img src="{{ asset($activity->cover_image) }}" 
                 class="img-fluid img-thumbnail"
                 style="max-height: 280px; object-fit:cover;">
        </div>
        @endif

        {{-- Activity Details --}}
        <h5>Detail Aktivitas</h5>
        <ul class="list-group mb-4">
            <li class="list-group-item"><strong>Kategori:</strong> {{ $activity->category ?? '-' }}</li>
            <li class="list-group-item"><strong>Status:</strong> {{ $activity->status ?? '-' }}</li>
            <li class="list-group-item"><strong>Lokasi:</strong> {{ $activity->location ?? '-' }}</li>
            <li class="list-group-item"><strong>Durasi:</strong> {{ $activity->duration ?? '-' }}</li>
            <li class="list-group-item"><strong>Jumlah Peserta:</strong> {{ $activity->participants ?? '-' }}</li>
            <li class="list-group-item">
                <strong>Tanggal:</strong>
                @if($activity->start_date)
                    {{ date('d M Y', strtotime($activity->start_date)) }} - {{ date('d M Y', strtotime($activity->end_date)) }}
                @else
                    -
                @endif
            </li>
            <li class="list-group-item"><strong>Tags:</strong> 
                {{ is_array($activity->tags) ? implode(', ', $activity->tags) : ($activity->tags ?? '-') }}
            </li>
        </ul>

        {{-- Description --}}
        <h5>Deskripsi Kegiatan</h5>
        <p class="mb-4">{{ $activity->description }}</p>

        {{-- Gallery --}}
        @if ($activity->galleries->count())
        <h5>Galeri Foto</h5>
        <div class="row mb-4">
            @foreach($activity->galleries as $gallery)
            <div class="col-md-3 mb-3 text-center">
                <img src="{{ asset($gallery->image) }}" 
                     class="img-fluid img-thumbnail"
                     style="max-height:150px; object-fit:cover;">
            </div>
            @endforeach
        </div>
        @endif

        {{-- Highlights --}}
        @if ($activity->highlights->count())
        <h5>Highlight</h5>
        <ul class="list-group mb-4">
            @foreach($activity->highlights as $h)
                <li class="list-group-item">• {{ $h->highlight }}</li>
            @endforeach
        </ul>
        @endif

        {{-- Schedules --}}
        @if ($activity->schedules->count())
        <h5>Jadwal Detail</h5>
        <div class="accordion" id="scheduleAccordion">

            @foreach($activity->schedules as $index => $s)
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading{{ $index }}">
                    <button class="accordion-button {{ $index != 0 ? 'collapsed' : '' }}" 
                            type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse{{ $index }}">
                        {{ $s->day_title }}
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
        @endif

    </div>

    <div class="card-footer text-end">
        <a href="{{ route('Admin.Activity.index') }}" class="btn btn-primary">Kembali</a>
    </div>

</div>

@endsection
