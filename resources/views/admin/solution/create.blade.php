@extends('layouts.Admin.master')

@section('content')
<div class="container-fluid py-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Tambah Solusi</h3>
        <a href="{{ route('admin.solution.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <form action="{{ route('admin.solution.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">

            <!-- LEFT SIDE -->
            <div class="col-md-8">

                <!-- GENERAL DATA -->
                <div class="card shadow-sm mb-4 border-0">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Informasi Utama</h5>
                    </div>
                    <div class="card-body">

                        <div class="mb-3">
                            <label class="form-label">Judul Solusi</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Slug (otomatis jika kosong)</label>
                            <input type="text" name="slug" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi Singkat</label>
                            <textarea name="short_description" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi Lengkap</label>
                            <textarea name="long_description" class="form-control" rows="6"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Urutan Tampil</label>
                            <input type="number" name="order" class="form-control" value="0">
                        </div>

                    </div>
                </div>

                <!-- FEATURES -->
                <div class="card shadow-sm mb-4 border-0">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">Fitur Solusi</h5>
                    </div>

                    <div class="card-body">
                        <div id="feature-wrapper">
                            <div class="row g-3 feature-item mb-2">
                                <div class="col-md-3">
                                    <input type="text" name="features[0][icon]" class="form-control" placeholder="Icon (opsional)">
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="features[0][feature]" class="form-control" placeholder="Nama Fitur">
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-danger btn-sm w-100 remove-feature">X</button>
                                </div>
                            </div>
                        </div>

                        <button type="button" id="add-feature" class="btn btn-outline-primary btn-sm mt-2">
                            + Tambah Fitur
                        </button>
                    </div>
                </div>

                <!-- METRICS -->
                <div class="card shadow-sm mb-4 border-0">
                    <div class="card-header bg-warning text-white">
                        <h5 class="mb-0">Metrics / Highlight Angka</h5>
                    </div>

                    <div class="card-body">
                        <div id="metrics-wrapper">
                            <div class="row g-3 metric-item mb-2">
                                <div class="col-md-5">
                                    <input type="text" name="metrics[0][label]" class="form-control" placeholder="Label">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="metrics[0][value]" class="form-control" placeholder="Nilai">
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-danger btn-sm w-100 remove-metric">X</button>
                                </div>
                            </div>
                        </div>

                        <button type="button" id="add-metric" class="btn btn-outline-warning btn-sm mt-2">
                            + Tambah Metric
                        </button>
                    </div>
                </div>

                <!-- TAGS -->
                <div class="card shadow-sm mb-4 border-0">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0">Tag Solusi</h5>
                    </div>

                    <div class="card-body">
                        <div id="tag-wrapper">
                            <div class="row g-3 tag-item mb-2">
                                <div class="col-md-11">
                                    <input type="text" name="tags[0][tag]" class="form-control" placeholder="Tag (misal: 'Network', 'Smart System')">
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-danger btn-sm w-100 remove-tag">X</button>
                                </div>
                            </div>
                        </div>

                        <button type="button" id="add-tag" class="btn btn-outline-secondary btn-sm mt-2">
                            + Tambah Tag
                        </button>
                    </div>
                </div>

                <!-- MEDIA -->
                <div class="card shadow-sm mb-4 border-0">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0">Media (Foto/Video)</h5>
                    </div>

                    <div class="card-body">
                        <div id="media-wrapper">

                            <div class="row g-3 media-item mb-2">
                                <div class="col-md-3">
                                    <select name="media[0][type]" class="form-control">
                                        <option value="image">Image</option>
                                        <option value="video">Video</option>
                                    </select>
                                </div>

                                <div class="col-md-8">
                                    <input type="text" name="media[0][url]" class="form-control" placeholder="URL Media">
                                </div>

                                <div class="col-md-1">
                                    <button type="button" class="btn btn-danger btn-sm w-100 remove-media">X</button>
                                </div>
                            </div>

                        </div>

                        <button type="button" id="add-media" class="btn btn-outline-dark btn-sm mt-2">
                            + Tambah Media
                        </button>
                    </div>
                </div>

            </div>

            <!-- RIGHT SIDE -->
            <div class="col-md-4">

                <!-- BROCHURE -->
                <div class="card shadow-sm mb-4 border-0">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">File Brosur</h5>
                    </div>

                    <div class="card-body">
                        <input type="file" name="brochure_file" class="form-control" accept=".pdf,.doc,.docx">
                    </div>
                </div>

                <!-- THUMBNAIL -->
                <div class="card shadow-sm mb-4 border-0">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">Thumbnail</h5>
                    </div>

                    <div class="card-body">
                        <input type="file" name="thumbnail" class="form-control" accept="image/*">
                    </div>
                </div>

                <!-- COVER IMAGE -->
                <div class="card shadow-sm mb-4 border-0">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Cover Image</h5>
                    </div>

                    <div class="card-body">
                        <input type="file" name="cover_image" class="form-control" accept="image/*">
                    </div>
                </div>

            </div>
        </div>

        <!-- SUBMIT -->
        <button type="submit" class="btn btn-primary w-100 py-2 mt-3">Simpan Solusi</button>
    </form>

</div>

@endsection

@section('scripts')
<script>
    let featureIndex = 1;
    let metricIndex = 1;
    let tagIndex = 1;
    let mediaIndex = 1;

    // Add Feature
    document.getElementById('add-feature').addEventListener('click', function () {
        let wrapper = document.getElementById('feature-wrapper');
        wrapper.insertAdjacentHTML('beforeend', `
            <div class="row g-3 feature-item mb-2">
                <div class="col-md-3">
                    <input type="text" name="features[${featureIndex}][icon]" class="form-control" placeholder="Icon (opsional)">
                </div>
                <div class="col-md-8">
                    <input type="text" name="features[${featureIndex}][feature]" class="form-control" placeholder="Nama Fitur">
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-danger btn-sm w-100 remove-feature">X</button>
                </div>
            </div>
        `);

        featureIndex++;
    });

    // Remove Feature
    document.addEventListener('click', function(e) {
        if(e.target.classList.contains('remove-feature')) {
            e.target.closest('.feature-item').remove();
        }
    });

    // Add Metric
    document.getElementById('add-metric').addEventListener('click', function () {
        let wrapper = document.getElementById('metrics-wrapper');
        wrapper.insertAdjacentHTML('beforeend', `
            <div class="row g-3 metric-item mb-2">
                <div class="col-md-5">
                    <input type="text" name="metrics[${metricIndex}][label]" class="form-control" placeholder="Label">
                </div>
                <div class="col-md-6">
                    <input type="text" name="metrics[${metricIndex}][value]" class="form-control" placeholder="Nilai">
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-danger btn-sm w-100 remove-metric">X</button>
                </div>
            </div>
        `);

        metricIndex++;
    });

    // Remove Metric
    document.addEventListener('click', function(e) {
        if(e.target.classList.contains('remove-metric')) {
            e.target.closest('.metric-item').remove();
        }
    });

    // Add Tag
    document.getElementById('add-tag').addEventListener('click', function () {
        let wrapper = document.getElementById('tag-wrapper');
        wrapper.insertAdjacentHTML('beforeend', `
            <div class="row g-3 tag-item mb-2">
                <div class="col-md-11">
                    <input type="text" name="tags[${tagIndex}][tag]" class="form-control" placeholder="Tag">
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-danger btn-sm w-100 remove-tag">X</button>
                </div>
            </div>
        `);

        tagIndex++;
    });

    // Remove Tag
    document.addEventListener('click', function(e) {
        if(e.target.classList.contains('remove-tag')) {
            e.target.closest('.tag-item').remove();
        }
    });

    // Add Media
    document.getElementById('add-media').addEventListener('click', function () {
        let wrapper = document.getElementById('media-wrapper');
        wrapper.insertAdjacentHTML('beforeend', `
            <div class="row g-3 media-item mb-2">
                <div class="col-md-3">
                    <select name="media[${mediaIndex}][type]" class="form-control">
                        <option value="image">Image</option>
                        <option value="video">Video</option>
                    </select>
                </div>
                <div class="col-md-8">
                    <input type="text" name="media[${mediaIndex}][url]" class="form-control" placeholder="URL Media">
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-danger btn-sm w-100 remove-media">X</button>
                </div>
            </div>
        `);

        mediaIndex++;
    });

    // Remove Media
    document.addEventListener('click', function(e) {
        if(e.target.classList.contains('remove-media')) {
            e.target.closest('.media-item').remove();
        }
    });
</script>
@endsection
