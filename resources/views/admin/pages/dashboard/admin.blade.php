@extends('admin.layouts.app')

@section('content')
    <div class="col-12">
        <div class="card w-100 mb-4">
            <div class="d-flex align-items-end row">
                <div class="col-md-6 order-2 order-md-1">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Selamat Datang, <span class="fw-bold">{{ Auth::user()->nama }}</span> 🎉</h4>
                        <p class="mb-0">Berikut adalah ringkasan informasi terkini mengenai pengelolaan sistem.</p>
                        <p>Anda dapat melihat data pengguna, berita, dan jurusan serta mengakses pengelolaan lebih lanjut melalui menu yang tersedia.</p>
                    </div>
                </div>
                <div class="col-md-6 text-center text-md-end order-1 order-md-2">
                    <div class="card-body pb-0 px-0 pt-2">
                        <img src="{{ asset('assets_backend/img/illustrations/illustration-john-light.png') }}"
                            height="186" class="scaleX-n1-rtl" alt="View Profile">
                    </div>
                </div>
            </div>
        </div>
    </div>

    @php
        $totalUsers = \App\Models\User::count();
        $totalAdmins = \App\Models\User::where('role', 'admin')->count();
        $totalPanitia = \App\Models\User::where('role', 'panitia')->count();
        $totalSiswa = \App\Models\User::where('role', 'siswa')->count();
        $totalBerita = \App\Models\Berita::count();
        $totalJurusan = \App\Models\Jurusan::count();
    @endphp

    <div class="row">
        <!-- Data Pengguna -->
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center">
                    <i class="ri-group-line ri-3x text-primary me-3"></i>
                    <div>
                        <h5 class="card-title">Total Pengguna</h5>
                        <p class="card-text fs-4 fw-bold">{{ $totalUsers }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center">
                    <i class="ri-admin-line ri-3x text-info me-3"></i>
                    <div>
                        <h5 class="card-title">Total Admin</h5>
                        <p class="card-text fs-4 fw-bold">{{ $totalAdmins }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center">
                    <i class="ri-user-settings-line ri-3x text-warning me-3"></i>
                    <div>
                        <h5 class="card-title">Total Panitia</h5>
                        <p class="card-text fs-4 fw-bold">{{ $totalPanitia }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center">
                    <i class="ri-user-line ri-3x text-success me-3"></i>
                    <div>
                        <h5 class="card-title">Total Siswa</h5>
                        <p class="card-text fs-4 fw-bold">{{ $totalSiswa }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Pengguna -->
    <div class="col-12 mt-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><i class="ri-user-line text-primary me-2"></i>Data Pengguna</h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Lihat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(\App\Models\User::take(5)->get() as $user)
                            <tr>
                                <td>{{ $user->nama }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ ucfirst($user->role) }}</td>
                                <td>
                                    <a href="{{ route('users.index') }}" class="btn btn-sm btn-info">
                                        <i class="ri-eye-line"></i> Lihat Semua
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="{{ route('users.index') }}" class="btn btn-primary mt-3">
                    <i class="ri-arrow-right-line"></i> Lihat Semua Pengguna
                </a>
            </div>
        </div>
    </div>

    <!-- Tabel Berita -->
    <div class="col-12 mt-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><i class="ri-newspaper-line text-info me-2"></i>Data Berita</h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Judul Berita</th>
                            <th>Tanggal</th>
                            <th>Lihat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(\App\Models\Berita::latest()->take(5)->get() as $berita)
                            <tr>
                                <td>{{ $berita->judul }}</td>
                                <td>{{ $berita->tanggal }}</td>
                                <td>
                                    <a href="{{ route('berita.index') }}" class="btn btn-sm btn-info">
                                        <i class="ri-eye-line"></i> Lihat Semua
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="{{ route('berita.index') }}" class="btn btn-info mt-3">
                    <i class="ri-arrow-right-line"></i> Lihat Semua Berita
                </a>
            </div>
        </div>
    </div>

    <!-- Tabel Jurusan -->
    <div class="col-12 mt-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><i class="ri-bookmark-line text-success me-2"></i>Data Jurusan</h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nama Jurusan</th>
                            <th>Kuota</th>
                            <th>Lihat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(\App\Models\Jurusan::take(5)->get() as $jurusan)
                            <tr>
                                <td>{{ $jurusan->nama }}</td>
                                <td>{{ $jurusan->kuota }}</td>
                                <td>
                                    <a href="{{ route('jurusan.index') }}" class="btn btn-sm btn-info">
                                        <i class="ri-eye-line"></i> Lihat Semua
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="{{ route('jurusan.index') }}" class="btn btn-success mt-3">
                    <i class="ri-arrow-right-line"></i> Lihat Semua Jurusan
                </a>
            </div>
        </div>
    </div>
@endsection
