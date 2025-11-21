@extends('layouts.Admin.master')

@section('content')
<div class="container">

    {{-- Judul Halaman --}}
    <h3 class="mb-4">Kelola Team Members</h3>

    {{-- Pesan Sukses --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Tambah Member --}}
    <a href="{{ route('admin.team.create') }}" class="btn btn-primary mb-3">
        <i class="bi bi-plus-circle"></i> Tambah Member
    </a>

    {{-- CUSTOM SOCIAL MEDIA ICON STYLE --}}
    <style>
        .social-icon {
            margin: 0 6px;
            text-decoration: none;
        }

        .social-icon i {
            font-size: 26px;      /* Ikon diperbesar */
            transition: 0.25s ease;
            color: #111;
        }

        .social-icon:hover i {
            transform: scale(1.25);
            color: #0d6efd;       /* Efek hover biru */
        }
    </style>

    {{-- Tabel --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered text-center align-middle">
                <thead class="table-light">
                    <tr>
                        <th style="width: 5%">NO</th>
                        <th style="width: 10%">FOTO</th>
                        <th style="width: 20%">NAMA</th>
                        <th style="width: 15%">POSISI</th>
                        <th style="width: 10%">URUTAN</th>
                        <th style="width: 25%">SOCIAL MEDIA</th>
                        <th style="width: 15%">AKSI</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($members as $index => $member)
                        <tr>

                            {{-- No --}}
                            <td>{{ $index + 1 }}</td>

                            {{-- Foto --}}
                            <td>
                                @if ($member->photo && Storage::disk('public')->exists($member->photo))
                                    <img src="{{ asset('storage/' . $member->photo) }}"
                                         class="rounded-circle shadow-sm"
                                         style="width: 70px; height: 70px; object-fit: cover;">
                                @else
                                    <span class="text-muted">Tidak ada foto</span>
                                @endif
                            </td>

                            {{-- Nama --}}
                            <td>{{ $member->name }}</td>

                            {{-- Posisi --}}
                            <td>{{ $member->position }}</td>

                            {{-- Urutan --}}
                            <td>{{ $member->order }}</td>

                            {{-- SOCIAL MEDIA --}}
                            <td>
                                @php $soc = $member->socials; @endphp

                                @if ($soc)
                                    @if ($soc->linkedin)
                                        <a href="{{ $soc->linkedin }}" target="_blank" class="social-icon">
                                            <i class="bi bi-linkedin"></i>
                                        </a>
                                    @endif

                                    @if ($soc->instagram)
                                        <a href="{{ $soc->instagram }}" target="_blank" class="social-icon">
                                            <i class="bi bi-instagram"></i>
                                        </a>
                                    @endif

                                    @if ($soc->github)
                                        <a href="{{ $soc->github }}" target="_blank" class="social-icon">
                                            <i class="bi bi-github"></i>
                                        </a>
                                    @endif

                                    @if ($soc->youtube)
                                        <a href="{{ $soc->youtube }}" target="_blank" class="social-icon">
                                            <i class="bi bi-youtube"></i>
                                        </a>
                                    @endif

                                    @if ($soc->facebook)
                                        <a href="{{ $soc->facebook }}" target="_blank" class="social-icon">
                                            <i class="bi bi-facebook"></i>
                                        </a>
                                    @endif

                                    {{-- Jika semua social media kosong --}}
                                    @if(
                                        !$soc->linkedin &&
                                        !$soc->instagram &&
                                        !$soc->github &&
                                        !$soc->youtube &&
                                        !$soc->facebook
                                    )
                                        <span class="text-muted">Belum ada social media</span>
                                    @endif

                                @else
                                    <span class="text-muted">Belum ada social media</span>
                                @endif
                            </td>

                            {{-- AKSI --}}
                            <td>
                                <a href="{{ route('admin.team.edit', $member->id) }}" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>

                                <form action="{{ route('admin.team.destroy', $member->id) }}"
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus {{ $member->name }}?')">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-muted">Belum ada data team member.</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>
</div>
@endsection
