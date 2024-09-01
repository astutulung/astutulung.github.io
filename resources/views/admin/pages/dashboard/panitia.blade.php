@extends('admin.layouts.app')

@section('content')
    <div class="col-12">
        <div class="card w-100">
            <div class="d-flex align-items-end row">
                <div class="col-md-6 order-2 order-md-1">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Selamat Datang, <span class="fw-bold">{{ Auth::user()->nama }}</span> 🎉</h4>
                        <p class="mb-0">Berikut adalah informasi terkini tentang pendaftaran calon siswa.</p>
                        <p>Anda dapat memverifikasi data pendaftar dan mengelola pengumuman hasil seleksi.</p>
                    </div>
                </div>
                <div class="col-md-6 text-center text-md-end order-1 order-md-2">
                    <div class="card-body pb-0 px-0 pt-2">
                        <img src="{{ asset('assets_backend/img/illustrations/misc-coming-soon-illustration.png') }}"
                             height="186" class="scaleX-n1-rtl" alt="Panitia Dashboard">
                    </div>
                </div>
            </div>
        </div>
    </div>

    @php
        $totalCalonSiswa = \App\Models\CalonSiswa::count();
        $totalPendaftaran = \App\Models\Pendaftaran::count();
        $totalTerima = \App\Models\CalonSiswa::where('status', 'accept')->count();
        $totalTolak = \App\Models\CalonSiswa::where('status', 'reject')->count();
    @endphp

    <div class="row mt-4">
        <div class="col-md-3 col-sm-6">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center">
                    <i class="ri-user-add-line ri-3x text-primary me-3"></i>
                    <div>
                        <h5 class="card-title">Total Calon Siswa</h5>
                        <p class="card-text fs-4 fw-bold">{{ $totalCalonSiswa }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center">
                    <i class="ri-file-list-3-line ri-3x text-info me-3"></i>
                    <div>
                        <h5 class="card-title">Total Pendaftaran</h5>
                        <p class="card-text fs-4 fw-bold">{{ $totalPendaftaran }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center">
                    <i class="ri-check-line ri-3x text-success me-3"></i>
                    <div>
                        <h5 class="card-title">Diterima</h5>
                        <p class="card-text fs-4 fw-bold">{{ $totalTerima }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center">
                    <i class="ri-close-line ri-3x text-danger me-3"></i>
                    <div>
                        <h5 class="card-title">Ditolak</h5>
                        <p class="card-text fs-4 fw-bold">{{ $totalTolak }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 mt-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><i class="ri-search-line text-primary me-2"></i>Verifikasi Pendaftaran</h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nama Siswa</th>
                            <th>Jurusan Pilihan</th>
                            <th>Status Pendaftaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(\App\Models\Pendaftaran::with('calonSiswa.jurusan')->get() as $pendaftaran)
                            <tr>
                                <td>{{ $pendaftaran->calonSiswa->nama_siswa }}</td>
                                <td>{{ $pendaftaran->calonSiswa->jurusan->nama }}</td>
                                <td>
                                    <span class="badge bg-{{ $pendaftaran->calonSiswa->status == 'Diterima' ? 'success' : ($pendaftaran->calonSiswa->status == 'Ditolak' ? 'danger' : 'warning') }}">
                                        {{ $pendaftaran->calonSiswa->status }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-12 mt-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><i class="ri-notification-line text-success me-2"></i>Pengumuman</h5>
                <a href="{{ route('pengumuman.index') }}" class="btn btn-success mb-3">
                    <i class="ri-add-line"></i> Buat Pengumuman Baru
                </a>
                <table class="table table-striped mt-4">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(\App\Models\Pengumuman::latest()->get() as $pengumuman)
                            <tr>
                                <td>{{ $pengumuman->judul_pengumuman }}</td>
                                <td>{{ \Illuminate\Support\Str::limit($pengumuman->deskripsi, 50) }}</td>
                                <td>
                                    <span class="badge bg-{{ $pengumuman->status == 'Diterbitkan' ? 'success' : 'secondary' }}">
                                        {{ $pengumuman->status }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
