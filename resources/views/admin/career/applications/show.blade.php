@extends('layouts.Admin.master')

@section('content')
<div class="container-fluid px-4">

    <h3 class="fw-bold mb-4">Detail Lamaran</h3>

    <div class="card shadow-sm">
        <div class="card-body">

            <h4 class="fw-bold">{{ $application->full_name }}</h4>
            <p><strong>Email:</strong> {{ $application->email }}</p>
            <p><strong>No. HP:</strong> {{ $application->phone }}</p>
            <p><strong>Lokasi:</strong> {{ $application->location }}</p>
            <p><strong>LinkedIn:</strong> 
                @if($application->linkedin)
                    <a href="{{ $application->linkedin }}" target="_blank">{{ $application->linkedin }}</a>
                @else
                    -
                @endif
            </p>

            <p><strong>Posisi Dilamar:</strong> 
                {{ $application->position->title }}
            </p>

            <hr>

            <h5 class="fw-semibold">Cover Letter</h5>
            <p>{!! nl2br(e($application->cover_letter)) !!}</p>

            <hr>

            <h5 class="fw-semibold">Resume / CV</h5>
            <a href="{{ asset('storage/' . $application->resume) }}" 
               class="btn btn-primary" target="_blank">
                <i class="fas fa-file"></i> Download Resume
            </a>

            <a href="{{ route('admin.career.applications.index') }}" 
               class="btn btn-secondary ms-2">Kembali</a>

        </div>
    </div>

</div>
@endsection
