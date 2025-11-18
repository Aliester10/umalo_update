@extends('layouts.Admin.master')

@section('content')
<div class="container-fluid py-4">

    <h3 class="fw-bold mb-4">Edit Solusi</h3>

    <div class="card shadow-sm border-0">
        <div class="card-body p-4">

            <form action="{{ route('admin.solution.update', $solution->id) }}"
                  method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Title -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Judul Solusi</label>
                    <input type="text" class="form-control" name="title" value="{{ $solution->title }}" required>
                </div>

                <!-- Banner -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Banner Image</label>
                    <input type="file" class="form-control" name="banner_image">
                    @if($solution->banner_image)
                        <img src="{{ asset($solution->banner_image) }}" class="img-fluid mt-2 rounded" width="200">
                    @endif
                </div>

                <!-- Short Description -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Deskripsi Singkat</label>
                    <textarea class="form-control" name="short_description" rows="3">{{ $solution->short_description }}</textarea>
                </div>

                <!-- Overview -->
                <h5 class="mt-4 fw-bold">Overview</h5>

                <div class="mb-3">
                    <label class="form-label">Judul Overview</label>
                    <input type="text" name="overview_title" class="form-control" value="{{ $solution->overview_title }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi Overview</label>
                    <textarea name="overview_description" class="form-control" rows="4">{{ $solution->overview_description }}</textarea>
                </div>

                <!-- Features -->
                <h5 class="fw-bold mt-4">Features</h5>

                <div id="feature-wrapper">

                    @foreach($solution->features as $index => $feature)
                    <div class="border rounded p-3 mb-3 feature-item">

                        <label class="form-label">Judul Feature</label>
                        <input type="text" class="form-control mb-2"
                               name="features[{{ $index }}][title]"
                               value="{{ $feature->feature_title }}">

                        <label class="form-label">Icon (Opsional)</label>
                        <input type="text" class="form-control"
                               name="features[{{ $index }}][icon]"
                               value="{{ $feature->feature_icon }}">

                        <button type="button" class="btn btn-danger btn-sm mt-2" onclick="this.parentNode.remove()">
                            Hapus Feature
                        </button>

                    </div>
                    @endforeach

                </div>

                <button type="button" class="btn btn-secondary mb-3" onclick="addFeature()">
                    + Tambah Feature
                </button>

                <!-- Benefits -->
                <div class="mb-3 mt-4">
                    <label class="form-label fw-bold">Benefits</label>
                    <textarea name="benefits" class="form-control" rows="4">{{ $solution->benefits }}</textarea>
                </div>

                <!-- Brochure -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Brochure File (PDF)</label>
                    <input type="file" class="form-control" name="brochure_file">

                    @if($solution->brochure_file)
                        <p class="mt-2">
                            <a href="{{ asset($solution->brochure_file) }}" target="_blank">
                                Lihat Brochure Sebelumnya
                            </a>
                        </p>
                    @endif
                </div>

                <!-- Contact -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Link Kontak</label>
                    <input type="text" name="contact_link" class="form-control" value="{{ $solution->contact_link }}">
                </div>

                <!-- Order -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Urutan</label>
                    <input type="number" class="form-control" name="order" value="{{ $solution->order }}">
                </div>

                <!-- Status -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Status</label>
                    <select name="status" class="form-select">
                        <option value="draft" {{ $solution->status == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ $solution->status == 'published' ? 'selected' : '' }}>Publish</option>
                    </select>
                </div>

                <button class="btn btn-primary px-4">Update Solusi</button>
            </form>

        </div>
    </div>

</div>

<script>
let featureIndex = {{ count($solution->features) }};

function addFeature() {
    let html = `
    <div class="border rounded p-3 mb-3 feature-item">
        <label class="form-label">Judul Feature</label>
        <input type="text" class="form-control mb-2" name="features[${featureIndex}][title]">

        <label class="form-label">Icon (Opsional)</label>
        <input type="text" class="form-control" name="features[${featureIndex}][icon]" placeholder="ex: fas fa-check">

        <button type="button" class="btn btn-danger btn-sm mt-2" onclick="this.parentNode.remove()">
            Hapus Feature
        </button>
    </div>
    `;

    document.getElementById('feature-wrapper').insertAdjacentHTML('beforeend', html);
    featureIndex++;
}
</script>

@endsection
