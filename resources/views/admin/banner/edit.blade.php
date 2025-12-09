@extends('layouts.Admin.master')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header">
            <h1 class="h4">Edit Banner</h1>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.banner.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- DESKTOP -->
                <div class="form-group mb-4">
                    <label>Gambar Desktop</label>
                    <input type="file" name="image_url" class="form-control">
                    <div class="mt-2">
                        <img src="{{ asset($banner->image_url) }}" class="img-thumbnail" style="max-width:150px;">
                    </div>
                </div>

                <!-- MOBILE -->
                <div class="form-group mb-4">
                    <label>Gambar Mobile</label>
                    <input type="file" name="image_mobile" class="form-control">

                    @if($banner->image_mobile)
                        <div class="mt-2">
                            <img src="{{ asset($banner->image_mobile) }}" class="img-thumbnail" style="max-width:150px;">
                        </div>
                    @else
                        <small class="text-muted">Belum ada gambar mobile</small>
                    @endif
                </div>

                <div class="form-group mb-3">
                    <label>Judul</label>
                    <input type="text" name="title" value="{{ $banner->title }}" class="form-control">
                </div>

                <div class="form-group mb-3">
                    <label>Sub Judul</label>
                    <input type="text" name="subtitle" value="{{ $banner->subtitle }}" class="form-control">
                </div>

                <div class="form-group mb-3">
                    <label>Deskripsi</label>
                    <textarea name="description" class="form-control">{{ $banner->description }}</textarea>
                </div>

                <div class="form-group mb-3">
                    <label>Teks Tombol</label>
                    <input type="text" name="button_text" value="{{ $banner->button_text }}" class="form-control">
                </div>

                <div class="form-group mb-4">
                    <label>URL Tombol</label>
                    <select name="button_url" class="form-control">

                        @foreach ($routes as $name => $url)
                            <option value="{{ $url }}" {{ $banner->button_url == $url ? 'selected':'' }}>
                                {{ ucfirst($name) }}
                            </option>
                        @endforeach

                        @foreach ($activities as $activity)
                            <option value="{{ route('activity.show', $activity->id) }}"
                                {{ $banner->button_url == route('activity.show', $activity->id) ? 'selected':'' }}>
                                {{ $activity->title }}
                            </option>
                        @endforeach

                        @foreach ($metas as $meta)
                            <option value="{{ route('member.meta.show', $meta->slug) }}"
                                {{ $banner->button_url == route('member.meta.show', $meta->slug) ? 'selected':'' }}>
                                {{ $meta->title }}
                            </option>
                        @endforeach

                        @foreach ($products as $product)
                            <option value="{{ route('product.show', $product->slug) }}"
                                {{ $banner->button_url == route('product.show', $product->slug) ? 'selected':'' }}>
                                {{ $product->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button class="btn btn-primary">Update</button>
                <a href="{{ route('admin.banner.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
