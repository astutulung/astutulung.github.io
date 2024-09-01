@extends('admin.layouts.app')

@section('content')
    <div class="col-12">
        <div class="card w-100">
            <div class="d-flex align-items-end row">
                <div class="col-md-6 order-2 order-md-1">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Selamat Datang <span class="fw-bold">{{ Auth::user()->nama }}</span> 🎉
                        </h4>
                        <p class="mb-0">Berikut adalah informasi terkini tentang pendaftaran Anda.</p>
                        <p>Anda dapat melihat status pendaftaran dan mengelola data pribadi Anda.</p>
                        <a href="{{ route('profile.index') }}" class="btn btn-primary">Lihat Profil</a>
                    </div>
                </div>
                <div class="col-md-6 text-center text-md-end order-1 order-md-2">
                    <div class="card-body pb-0 px-0 pt-2">
                        <img src="{{ asset('assets_backend/img/illustrations/illustration-upgrade-account.png') }}"
                            height="186" class="scaleX-n1-rtl" alt="View Profile">
                    </div>
                </div>
            </div>
        </div>
    </div>

    @php
        $calonSiswa = \App\Models\CalonSiswa::where('user_id', Auth::user()->id)->first();
        $pendaftaran = $calonSiswa ? \App\Models\Pendaftaran::where('calon_siswa_id', $calonSiswa->id)->first() : null;
        $pengumuman = $calonSiswa ? \App\Models\Pengumuman::where('calon_siswa_id', $calonSiswa->id)->first() : null;
    @endphp

    <div class="row">
        @if ($calonSiswa)
            <div class="col-lg-4 col-md-6 mt-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <i class="ri-file-list-3-line ri-2x text-primary me-3"></i>
                            <div>
                                <h5 class="card-title">Status Pendaftaran</h5>
                                <p>Jurusan Pilihan: {{ $calonSiswa->jurusan->nama }}</p>
                                <p>Status Pendaftaran: <span
                                        class="badge bg-primary">{{ $calonSiswa ? $calonSiswa->status : 'Belum Terdaftar' }}</span>
                                </p>
                                <p>Status Penerimaan: <span
                                        class="badge bg-success">{{ $pengumuman ? $pengumuman->status : 'Belum Ada Pengumuman' }}</span>
                                </p>
                                <a href="{{ route('pendaftaran.index')}}" class="btn btn-info">Informasi Pendaftaran</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Konten Tambahan -->
            @if ($pendaftaran)
                <div class="col-lg-4 col-md-6 mt-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <i class="ri-user-line ri-2x text-primary me-3"></i>
                                <div>
                                    <h5 class="card-title">Data Calon Siswa</h5>
                                    <p>Nama: {{ $calonSiswa->nama_siswa }}</p>
                                    <p>Asal Sekolah: {{ $calonSiswa->asal_sekolah }}</p>
                                    <p>Email: {{ $calonSiswa->email }}</p>
                                    <a href="{{ route('profile.index')}}" class="btn btn-info">Detail Profile</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mt-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <i class="ri-file-list-3-line ri-2x text-secondary me-3"></i>
                                <div>
                                    <h5 class="card-title">Data Pendaftaran</h5>
                                    <p>Kode Pendaftaran: {{ $pendaftaran->kode_rus }}</p>
                                    <p>No. Seri Ijazah: {{ $pendaftaran->no_seri_ijazah }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mt-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <i class="ri-contacts-line ri-2x text-warning me-3"></i>
                                <div>
                                    <h5 class="card-title">Kontak Penting</h5>
                                    <p>Nama Ayah: {{ $calonSiswa->nama_ayah }}</p>
                                    <p>Nama Ibu: {{ $calonSiswa->nama_ibu }}</p>
                                    <p>No. Telepon: {{ $calonSiswa->no_tlpn }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @else
            <div class="col-lg-4 col-md-6 mt-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <i class="ri-edit-box-line ri-2x text-warning me-3"></i>
                            <div>
                                <h5 class="card-title">Anda Belum Melakukan Pendaftaran</h5>
                                <p>Silakan melengkapi data diri Anda dan melakukan pendaftaran.</p>
                                <a href="{{ route('pendaftaran.index') }}" class="btn btn-warning">Mulai Pendaftaran</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="col-lg-4 col-md-6 mt-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="ri-notification-line ri-2x text-success me-3"></i>
                        <div>
                            <h5 class="card-title">Pengumuman Terkini</h5>
                            @if ($pengumuman)
                                <p>{{ $pengumuman->judul_pengumuman }}</p>
                                <p>{{ $pengumuman->deskripsi }}</p>
                            @else
                                <p>Tidak ada pengumuman terbaru.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mt-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="ri-newspaper-line ri-2x text-info me-3"></i>
                        <div>
                            <h5 class="card-title">Berita Terbaru</h5>
                            @foreach (\App\Models\Berita::latest()->take(3)->get() as $berita)
                                <div class="mb-2">
                                    <h6>{{ $berita->judul }}</h6>
                                    <p>{{ \Illuminate\Support\Str::limit($berita->isi, 100) }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
