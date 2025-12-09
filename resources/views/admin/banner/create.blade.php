@extends('layouts.Admin.master')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header">
            <h1 class="h4">Buat Slider Baru</h1>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.banner.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- DESKTOP IMAGE -->
                <div class="form-group mb-3">
                    <label for="image_url">Gambar Desktop</label>
                    <input type="file" name="image_url" class="form-control" required>
                    <small class="text-muted">Rekomendasi: 1920x900</small>
                    @error('image_url')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- MOBILE IMAGE -->
                <div class="form-group mb-3">
                    <label for="image_mobile">Gambar Mobile (Opsional)</label>
                    <input type="file" name="image_mobile" class="form-control">
                    <small class="text-muted">Rekomendasi: 768x1024</small>
                    @error('image_mobile')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label>Judul</label>
                    <input type="text" name="title" class="form-control">
                </div>

                <div class="form-group mb-3">
                    <label>Sub Judul</label>
                    <input type="text" name="subtitle" class="form-control">
                </div>

                <div class="form-group mb-3">
                    <label>Deskripsi</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>

                <div class="form-group mb-3">
                    <label>Teks Tombol</label>
                    <input type="text" name="button_text" class="form-control">
                </div>

                <div class="form-group mb-4">
                    <label>URL Tombol</label>
                    <select name="button_url" class="form-control">

                        <option value="">Pilih rute</option>

                        @foreach ($routes as $name => $url)
                            <option value="{{ $url }}">{{ ucfirst($name) }}</option>
                        @endforeach

                        @foreach ($activities as $activity)
                            <option value="{{ route('activity.show', $activity->id) }}">{{ $activity->title }}</option>
                        @endforeach

                        @foreach ($metas as $meta)
                            <option value="{{ route('member.meta.show', $meta->slug) }}">{{ $meta->title }}</option>
                        @endforeach

                        @foreach ($products as $product)
                            <option value="{{ route('product.show', $product->slug) }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Banner</button>
            </form>
        </div>
    </div>
</div>
@endsection
