@extends('admin.layouts.app')

@section('content')
    @if ($calonSiswa)
        <div class="col-md-12 mx-auto col-lg-6">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Status Pendaftaran</h5>
                    <p class="card-subtitle">Informasi pendaftaran Anda</p>
                    @if ($calonSiswa->status == 'pending')
                        <i class="ri-time-line" style="font-size: 48px; color: orange;"></i>
                    @elseif ($calonSiswa->status == 'accept')
                        <i class="ri-check-line" style="font-size: 48px; color: green;"></i>
                    @elseif ($calonSiswa->status == 'reject')
                        <i class="ri-close-line" style="font-size: 48px; color: red;"></i>
                    @endif
                    <p class="card-text mt-3">Status: {{ ucfirst($calonSiswa->status) }}</p>
                    <p class="card-text">Nama: {{ $calonSiswa->nama_siswa }}</p>
                    <p class="card-text">Asal Sekolah: {{ $calonSiswa->asal_sekolah }}</p>
                    <p class="card-text">Tanggal Daftar: {{ $calonSiswa->tanggal_daftar }}</p>
                    @if ($calonSiswa->status == 'accept')
                        @if ($calonSiswa->hasCompletedRegistration())
                            <button type="button" class="btn btn-primary mt-3"
                                onclick="showAlreadyRegisteredAlert()">Registrasi Ulang Berhasil</button>
                        @else
                            <a href="{{ route('registrasiulang') }}" class="btn btn-primary mt-3">Lanjutkan Registrasi
                                Ulang</a>
                        @endif
                    @endif
                </div>
            </div>

        </div>
    @else
        <div class="col-xl">
            <div class="card mb-6">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Formulir Calon Siswa</h5>
                    <small class="text-body float-end">Masukkan data calon siswa</small>
                </div>
                <div class="card-body">
                    <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group input-group-merge mb-6">
                            <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                    class="ri-user-line"></i></span>
                            <div class="form-floating form-floating-outline">
                                <input type="text" name="nama_siswa" class="form-control"
                                    id="basic-icon-default-fullname" placeholder="Nama Siswa" aria-label="Nama Siswa"
                                    aria-describedby="basic-icon-default-fullname2" />
                                <label for="basic-icon-default-fullname">Nama Siswa</label>
                            </div>
                        </div>
                        <div class="input-group input-group-merge mb-6">
                            <span id="basic-icon-default-company2" class="input-group-text"><i
                                    class="ri-building-4-line"></i></span>
                            <div class="form-floating form-floating-outline">
                                <input type="text" name="asal_sekolah" id="basic-icon-default-company"
                                    class="form-control" placeholder="Asal Sekolah" aria-label="Asal Sekolah"
                                    aria-describedby="basic-icon-default-company2" />
                                <label for="basic-icon-default-company">Asal Sekolah</label>
                            </div>
                        </div>
                        <div class="input-group input-group-merge mb-6">
                            <span id="basic-icon-default-company2" class="input-group-text"><i
                                    class="ri-building-4-line"></i></span>
                            <div class="form-floating form-floating-outline">
                                <input type="text" name="tempat_lahir" id="basic-icon-default-company"
                                    class="form-control" placeholder="Tempat Lahir" aria-label="Tempat Lahir"
                                    aria-describedby="basic-icon-default-company2" />
                                <label for="basic-icon-default-company">Tempat Lahir</label>
                            </div>
                        </div>
                        <div class="input-group input-group-merge mb-6">
                            <span id="basic-icon-default-company2" class="input-group-text"><i
                                    class="ri-building-4-line"></i></span>
                            <div class="form-floating form-floating-outline">
                                <input type="date" name="tanggal_lahir" id="basic-icon-default-company"
                                    class="form-control" placeholder="Tanggal Lahir" aria-label="Tanggal Lahir"
                                    aria-describedby="basic-icon-default-company2" />
                                <label for="basic-icon-default-company">Tanggal Lahir</label>
                            </div>
                        </div>
                        <div class="input-group input-group-merge mb-6">
                            <span id="basic-icon-default-religion2" class="input-group-text"><i
                                    class="ri-heart-line"></i></span>
                            <div class="form-floating form-floating-outline">
                                <select name="agama" id="basic-icon-default-religion" class="form-control"
                                    aria-label="Agama" aria-describedby="basic-icon-default-religion2">
                                    <option value="Agama Islam">Agama Islam</option>
                                    <option value="Agama Kristen">Agama Kristen</option>
                                    <option value="Agama Katolik">Agama Katolik</option>
                                    <option value="Agama Hindu">Agama Hindu</option>
                                    <option value="Agama Buddha">Agama Buddha</option>
                                    <option value="Agama Khonghucu">Agama Khonghucu</option>
                                </select>
                                <label for="basic-icon-default-religion">Agama</label>
                            </div>
                        </div>
                        <div class="input-group input-group-merge mb-6">
                            <span id="basic-icon-default-gender2" class="input-group-text"><i
                                    class="ri-group-line"></i></span>
                            <div class="form-floating form-floating-outline">
                                <select name="jk" id="basic-icon-default-gender" class="form-control"
                                    aria-label="Jenis Kelamin" aria-describedby="basic-icon-default-gender2">
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                                <label for="basic-icon-default-gender">Jenis Kelamin</label>
                            </div>
                        </div>
                        <div class="input-group input-group-merge mb-6">
                            <span id="basic-icon-default-date2" class="input-group-text"><i
                                    class="ri-calendar-line"></i></span>
                            <div class="form-floating form-floating-outline">
                                <input type="date" name="tanggal_daftar" id="basic-icon-default-date"
                                    class="form-control" placeholder="Tanggal Daftar" aria-label="Tanggal Daftar"
                                    aria-describedby="basic-icon-default-date2" />
                                <label for="basic-icon-default-date">Tanggal Daftar</label>
                            </div>
                        </div>
                        <div class="input-group input-group-merge mb-6">
                            <span id="basic-icon-default-year2" class="input-group-text"><i
                                    class="ri-calendar-2-line"></i></span>
                            <div class="form-floating form-floating-outline">
                                <input type="text" name="tahun_ajaran" id="basic-icon-default-year"
                                    class="form-control" placeholder="Tahun Ajaran" aria-label="Tahun Ajaran"
                                    aria-describedby="basic-icon-default-year2" />
                                <label for="basic-icon-default-year">Tahun Ajaran</label>
                            </div>
                        </div>
                        <div class="mb-2">
                        <span class="text-danger" style="font-size: 12px;">File yang diupload harus dalam format PDF dan minimal 2MB.</span>
                        </div>
                        
                        <div class="input-group input-group-merge mb-6">
                            <span id="basic-icon-default-file2" class="input-group-text"><i
                                    class="ri-file-line"></i></span>
                            <div class="form-floating form-floating-outline">
                                <input type="file" name="file_raport" id="basic-icon-default-file"
                                    class="form-control" placeholder="File Raport" aria-label="File Raport"
                                    aria-describedby="basic-icon-default-file2" />
                                <label for="basic-icon-default-file">File Raport</label>
                            </div>
                        </div>
                        <div class="input-group input-group-merge mb-6">
                            <span id="basic-icon-default-phone2" class="input-group-text"><i
                                    class="ri-phone-fill"></i></span>
                            <div class="form-floating form-floating-outline">
                                <input type="text" name="no_tlpn" id="basic-icon-default-phone"
                                    class="form-control phone-mask" placeholder="No Telepon" aria-label="No Telepon"
                                    aria-describedby="basic-icon-default-phone2" />
                                <label for="basic-icon-default-phone">No Telepon</label>
                            </div>
                        </div>
                        <div class="input-group input-group-merge mb-6">
                            <span class="input-group-text"><i class="ri-mail-line"></i></span>
                            <div class="form-floating form-floating-outline">
                                <input type="email" name="email" id="basic-icon-default-email" class="form-control"
                                    placeholder="Email" aria-label="Email"
                                    aria-describedby="basic-icon-default-email2" />
                                <label for="basic-icon-default-email">Email</label>
                            </div>
                        </div>
                        <div class="input-group input-group-merge mb-6">
                            <span class="input-group-text"><i class="ri-map-pin-line"></i></span>
                            <div class="form-floating form-floating-outline">
                                <input type="text" name="alamat" id="basic-icon-default-address"
                                    class="form-control" placeholder="Alamat" aria-label="Alamat"
                                    aria-describedby="basic-icon-default-address2" />
                                <label for="basic-icon-default-address">Alamat</label>
                            </div>
                        </div>
                        <div class="input-group input-group-merge mb-6">
                            <span id="basic-icon-default-jurusan2" class="input-group-text"><i
                                    class="ri-bookmark-line"></i></span>
                            <div class="form-floating form-floating-outline">
                                <select name="jurusan_id" id="basic-icon-default-jurusan" class="form-control"
                                    aria-label="Jurusan" aria-describedby="basic-icon-default-jurusan2">
                                    @foreach ($jurusan as $jrs)
                                        <option value="{{ $jrs->id }}">{{ $jrs->nama }}</option>
                                    @endforeach
                                </select>
                                <label for="basic-icon-default-jurusan">Jurusan</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endsection
@push('js')
    <script>
        function showAlreadyRegisteredAlert() {
            Swal.fire({
                icon: 'info',
                title: 'Registrasi Ulang Sudah Dilakukan',
                text: 'Anda sudah melakukan registrasi ulang. Silahkan kunjungi menu informasi calon siswa untuk mengetahui pengumuman hasil.',
                confirmButtonText: 'OK'
            });
        }
    </script>
@endpush
