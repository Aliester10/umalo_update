@extends('layouts.Admin.master')

@section('content')
<div class="container-fluid py-4">

    <!-- Header -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">
                <i class="fas fa-lightbulb me-2"></i> Detail Solusi
            </h4>
            <div>
                <a href="{{ route('admin.solution.edit', $solution->id) }}" class="btn btn-warning text-white btn-sm">
                    <i class="fas fa-edit"></i> Edit
                </a>

                <form action="{{ route('admin.solution.destroy', $solution->id) }}" method="POST" class="d-inline-block"
                      onsubmit="return confirm('Yakin ingin menghapus solusi ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>

                <a href="{{ route('admin.solution.index') }}" class="btn btn-light btn-sm ms-1">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="row">

        <!-- LEFT CONTENT -->
        <div class="col-md-8">

            <!-- GENERAL -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">Informasi Umum</h5>
                </div>
                <div class="card-body">

                    <h4 class="fw-bold">{{ $solution->title }}</h4>
                    <p class="text-muted">Slug: {{ $solution->slug }}</p>

                    <p class="mt-3">{{ $solution->short_description }}</p>

                    <div class="mt-3">
                        <h6 class="fw-bold">Deskripsi Lengkap:</h6>
                        <div class="border rounded p-3 bg-light">
                            {!! nl2br(e($solution->long_description)) !!}
                        </div>
                    </div>

                    <div class="mt-3">
                        <span class="badge bg-secondary">Order: {{ $solution->order }}</span>
                    </div>

                </div>
            </div>

            <!-- FEATURES -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Fitur Solusi</h5>
                </div>

                <div class="card-body">
                    @if($solution->features->count())
                        <ul class="list-group">
                            @foreach($solution->features as $f)
                            <li class="list-group-item">
                                @if($f->icon)
                                <i class="{{ $f->icon }}"></i>
                                @endif
                                {{ $f->feature }}
                            </li>
                            @endforeach
                        </ul>
                    @else
                    <p class="text-muted">Belum ada fitur yang ditambahkan.</p>
                    @endif
                </div>
            </div>

            <!-- METRICS -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-warning text-white">
                    <h5 class="mb-0">Metrics / Angka Highlight</h5>
                </div>

                <div class="card-body">
                    @if($solution->metrics->count())
                    <div class="row">
                        @foreach($solution->metrics as $m)
                        <div class="col-6 mb-3">
                            <div class="p-3 bg-light rounded text-center shadow-sm">
                                <h4 class="fw-bold">{{ $m->value }}</h4>
                                <p class="text-muted">{{ $m->label }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                        <p class="text-muted">Belum ada metric.</p>
                    @endif
                </div>
            </div>

            <!-- TAGS -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Tag Solusi</h5>
                </div>

                <div class="card-body">
                    @if($solution->tags->count())
                        @foreach($solution->tags as $t)
                        <span class="badge bg-info text-dark me-1">{{ $t->tag }}</span>
                        @endforeach
                    @else
                        <p class="text-muted">Belum ada tag.</p>
                    @endif
                </div>
            </div>

            <!-- MEDIA -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Media Solusi</h5>
                </div>

                <div class="card-body">

                    @if($solution->media->count())

                        @foreach($solution->media as $md)
                        <div class="mb-4">

                            @if($md->type == 'image')
                                <img src="{{ $md->url }}" class="img-fluid rounded shadow-sm" alt="">
                            
                            @elseif($md->type == 'video')
                                <div class="ratio ratio-16x9">
                                    <iframe src="{{ $md->url }}" frameborder="0" allowfullscreen></iframe>
                                </div>
                            @endif

                        </div>
                        @endforeach

                    @else
                        <p class="text-muted">Belum ada media.</p>
                    @endif

                </div>
            </div>

        </div>

        <!-- RIGHT CONTENT -->
        <div class="col-md-4">

            <!-- BROCHURE -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">File Brosur</h5>
                </div>

                <div class="card-body">
                    @if($solution->brochure_file)
                        <a href="{{ asset($solution->brochure_file) }}" target="_blank" class="btn btn-success w-100">
                            <i class="fas fa-download me-2"></i> Download Brosur
                        </a>
                    @else
                        <p class="text-muted">Tidak ada brosur diunggah.</p>
                    @endif
                </div>
            </div>

            <!-- THUMBNAIL -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">Thumbnail</h5>
                </div>

                <div class="card-body">
                    @if($solution->thumbnail)
                        <img src="{{ asset($solution->thumbnail) }}" class="img-fluid rounded shadow-sm">
                    @else
                        <p class="text-muted">Tidak ada thumbnail.</p>
                    @endif
                </div>
            </div>

            <!-- COVER -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Cover Image</h5>
                </div>

                <div class="card-body">
                    @if($solution->cover_image)
                        <img src="{{ asset($solution->cover_image) }}" class="img-fluid rounded shadow-sm">
                    @else
                        <p class="text-muted">Tidak ada cover.</p>
                    @endif
                </div>
            </div>

        </div>

    </div>

</div>
@endsection
