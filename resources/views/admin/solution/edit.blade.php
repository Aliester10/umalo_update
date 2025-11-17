@extends('layouts.Admin.master')

@section('content')
<div class="container-fluid py-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Edit Solusi: {{ $solution->title }}</h3>
        <a href="{{ route('admin.solution.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <form action="{{ route('admin.solution.update', $solution->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">

            <!-- LEFT -->
            <div class="col-md-8">

                <!-- GENERAL -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Informasi Utama</h5>
                    </div>

                    <div class="card-body">

                        <div class="mb-3">
                            <label class="form-label">Judul Solusi</label>
                            <input type="text" name="title" class="form-control" value="{{ $solution->title }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Slug</label>
                            <input type="text" name="slug" class="form-control" value="{{ $solution->slug }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi Singkat</label>
                            <textarea name="short_description" class="form-control">{{ $solution->short_description }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi Lengkap</label>
                            <textarea name="long_description" class="form-control" rows="6">{{ $solution->long_description }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Urutan</label>
                            <input type="number" name="order" value="{{ $solution->order }}" class="form-control">
                        </div>

                    </div>
                </div>

                <!-- FEATURES -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">Fitur Solusi</h5>
                    </div>

                    <div class="card-body">
                        <div id="feature-wrapper">

                            @foreach($solution->features as $index => $ft)
                            <div class="row g-3 feature-item mb-2" data-id="{{ $ft->id }}">
                                <input type="hidden" name="features_existing[{{ $ft->id }}][id]" value="{{ $ft->id }}">

                                <div class="col-md-3">
                                    <input type="text" name="features_existing[{{ $ft->id }}][icon]" value="{{ $ft->icon }}" class="form-control">
                                </div>

                                <div class="col-md-8">
                                    <input type="text" name="features_existing[{{ $ft->id }}][feature]" value="{{ $ft->feature }}" class="form-control">
                                </div>

                                <div class="col-md-1">
                                    <button type="button" class="btn btn-danger btn-sm remove-existing-feature w-100" 
                                        data-id="{{ $ft->id }}">
                                        X
                                    </button>
                                </div>
                            </div>
                            @endforeach

                        </div>

                        <button type="button" id="add-feature" class="btn btn-outline-primary btn-sm mt-2">
                            + Tambah Fitur
                        </button>
                    </div>
                </div>

                <!-- METRICS -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-warning text-white">
                        <h5 class="mb-0">Metrics</h5>
                    </div>

                    <div class="card-body">
                        <div id="metrics-wrapper">

                            @foreach($solution->metrics as $mt)
                            <div class="row g-3 metric-item mb-2" data-id="{{ $mt->id }}">
                                <input type="hidden" name="metrics_existing[{{ $mt->id }}][id]" value="{{ $mt->id }}">

                                <div class="col-md-5">
                                    <input type="text" name="metrics_existing[{{ $mt->id }}][label]" value="{{ $mt->label }}" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <input type="text" name="metrics_existing[{{ $mt->id }}][value]" value="{{ $mt->value }}" class="form-control">
                                </div>

                                <div class="col-md-1">
                                    <button type="button" class="btn btn-danger btn-sm remove-existing-metric w-100" data-id="{{ $mt->id }}">
                                        X
                                    </button>
                                </div>
                            </div>
                            @endforeach

                        </div>

                        <button type="button" id="add-metric" class="btn btn-outline-warning btn-sm mt-2">
                            + Tambah Metric
                        </button>
                    </div>
                </div>

                <!-- TAGS -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0">Tag Solusi</h5>
                    </div>

                    <div class="card-body">
                        <div id="tag-wrapper">

                            @foreach($solution->tags as $tg)
                            <div class="row g-3 tag-item mb-2" data-id="{{ $tg->id }}">
                                <input type="hidden" name="tags_existing[{{ $tg->id }}][id]" value="{{ $tg->id }}">

                                <div class="col-md-11">
                                    <input type="text" name="tags_existing[{{ $tg->id }}][tag]" value="{{ $tg->tag }}" class="form-control">
                                </div>

                                <div class="col-md-1">
                                    <button type="button" class="btn btn-danger btn-sm remove-existing-tag w-100" data-id="{{ $tg->id }}">
                                        X
                                    </button>
                                </div>
                            </div>
                            @endforeach

                        </div>

                        <button type="button" id="add-tag" class="btn btn-outline-secondary btn-sm mt-2">
                            + Tambah Tag
                        </button>
                    </div>
                </div>

                <!-- MEDIA -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0">Media</h5>
                    </div>

                    <div class="card-body">
                        <div id="media-wrapper">

                            @foreach($solution->media as $md)
                            <div class="row g-3 media-item mb-2" data-id="{{ $md->id }}">
                                <input type="hidden" name="media_existing[{{ $md->id }}][id]" value="{{ $md->id }}">

                                <div class="col-md-3">
                                    <select name="media_existing[{{ $md->id }}][type]" class="form-control">
                                        <option value="image" {{ $md->type == 'image' ? 'selected' : '' }}>Image</option>
                                        <option value="video" {{ $md->type == 'video' ? 'selected' : '' }}>Video</option>
                                    </select>
                                </div>

                                <div class="col-md-8">
                                    <input type="text" name="media_existing[{{ $md->id }}][url]" class="form-control" value="{{ $md->url }}">
                                </div>

                                <div class="col-md-1">
                                    <button type="button" class="btn btn-danger btn-sm remove-existing-media w-100" data-id="{{ $md->id }}">
                                        X
                                    </button>
                                </div>
                            </div>
                            @endforeach

                        </div>

                        <button type="button" id="add-media" class="btn btn-outline-dark btn-sm mt-2">
                            + Tambah Media
                        </button>
                    </div>
                </div>

            </div>

            <!-- RIGHT -->
            <div class="col-md-4">

                <!-- BROCHURE -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">Brosur</h5>
                    </div>

                    <div class="card-body">
                        @if($solution->brochure_file)
                        <p class="text-muted">File saat ini: <a target="_blank" href="{{ asset($solution->brochure_file) }}">Download</a></p>
                        @endif
                        <input type="file" name="brochure_file" class="form-control">
                    </div>
                </div>

                <!-- THUMBNAIL -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">Thumbnail</h5>
                    </div>

                    <div class="card-body">
                        @if($solution->thumbnail)
                        <img src="{{ asset($solution->thumbnail) }}" class="img-fluid mb-2 rounded shadow-sm" width="200">
                        @endif

                        <input type="file" name="thumbnail" class="form-control">
                    </div>
                </div>

                <!-- COVER -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Cover Image</h5>
                    </div>

                    <div class="card-body">
                        @if($solution->cover_image)
                        <img src="{{ asset($solution->cover_image) }}" class="img-fluid mb-2 rounded shadow-sm" width="200">
                        @endif

                        <input type="file" name="cover_image" class="form-control">
                    </div>
                </div>

            </div>
        </div>

        <button type="submit" class="btn btn-primary w-100 py-2 mt-3">Update Solusi</button>

    </form>

</div>
@endsection


@section('scripts')
<script>
let featureIndex = 9999;
let metricIndex = 9999;
let tagIndex = 9999;
let mediaIndex = 9999;

// ADD NEW ITEMS (same as create)
document.getElementById('add-feature').addEventListener('click', function(){
    document.getElementById('feature-wrapper').insertAdjacentHTML('beforeend', `
        <div class="row g-3 feature-item mb-2">
            <div class="col-md-3">
                <input type="text" name="features[${featureIndex}][icon]" class="form-control" placeholder="Icon">
            </div>
            <div class="col-md-8">
                <input type="text" name="features[${featureIndex}][feature]" class="form-control" placeholder="Nama Fitur">
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-danger btn-sm remove-feature">X</button>
            </div>
        </div>
    `);
    featureIndex++;
});
document.addEventListener('click', function(e){
    if(e.target.classList.contains('remove-feature')){
        e.target.closest('.feature-item').remove();
    }
});

// DELETE EXISTING
document.addEventListener('click', function(e){
    if(e.target.classList.contains('remove-existing-feature')){
        let id = e.target.dataset.id;
        e.target.closest('.feature-item').innerHTML =
            `<input type="hidden" name="delete_features[]" value="${id}">`;
    }
});

// ------------------------------------------------------
// SAME LOGIC UNTUK METRICS, TAG, MEDIA (DISINGKAT)
// ------------------------------------------------------

</script>
@endsection
