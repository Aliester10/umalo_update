@extends('layouts.Admin.master')

@section('content')
<div class="container-fluid py-4">

    <h3 class="fw-bold mb-4">Tambah Solusi Baru</h3>

    <div class="card shadow-sm border-0">
        <div class="card-body p-4">

            <form action="{{ route('admin.solution.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Title -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Judul Solusi</label>
                    <input type="text" class="form-control" name="title" required>
                </div>

                <!-- Banner -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Banner Image</label>
                    <input type="file" class="form-control" name="banner_image">
                </div>

                <!-- Short Description -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Deskripsi Singkat</label>
                    <textarea class="form-control" name="short_description" rows="3"></textarea>
                </div>

                <!-- Overview -->
                <h5 class="mt-4 fw-bold">Overview</h5>

                <div class="mb-3">
                    <label class="form-label">Judul Overview</label>
                    <input type="text" name="overview_title" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi Overview</label>
                    <textarea name="overview_description" class="form-control" rows="4"></textarea>
                </div>

                <!-- FEATURES -->
                <h5 class="fw-bold mt-4">Features</h5>

                <div id="feature-wrapper">

                    <div class="border rounded p-3 mb-3 feature-item">
                        <label class="form-label">Judul Feature</label>
                        <input type="text" class="form-control mb-2" name="features[0][title]">

                        <label class="form-label">Icon (Opsional)</label>
                        <input type="text" class="form-control" name="features[0][icon]" placeholder="ex: fas fa-check">
                    </div>

                </div>

                <button type="button" class="btn btn-secondary mb-3" onclick="addFeature()">
                    + Tambah Feature
                </button>

                <!-- Benefits -->
                <div class="mb-3 mt-4">
                    <label class="form-label fw-bold">Benefits</label>
                    <textarea name="benefits" class="form-control" rows="4"></textarea>
                </div>

                <!-- Brochure -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Brochure File (PDF)</label>
                    <input type="file" class="form-control" name="brochure_file">
                </div>

                <!-- Contact Link -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Link Kontak</label>
                    <input type="text" name="contact_link" class="form-control">
                </div>

                <!-- Order -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Urutan</label>
                    <input type="number" class="form-control" name="order" value="0">
                </div>

                <!-- Status -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Status</label>
                    <select name="status" class="form-select">
                        <option value="draft">Draft</option>
                        <option value="published">Publish</option>
                    </select>
                </div>

                <button class="btn btn-primary px-4">Simpan</button>
            </form>

        </div>
    </div>

</div>

<script>
let featureIndex = 1;

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
