@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Profil Siswa</h2>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center mb-4">{{ $calonSiswa->nama_siswa }}</h4>

                    <!-- Informasi Pribadi -->
                    <div class="card mb-4 border">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="text-heading">Informasi Pribadi</h5>
                            <div>
                                <button class="btn btn-sm btn-outline-primary edit-btn" data-target="#informasiPribadi">Edit</button>
                                <button class="btn btn-sm btn-outline-danger d-none cancel-btn" data-target="#informasiPribadiForm">Cancel</button>
                            </div>
                        </div>
                        <div class="card-body" id="informasiPribadi">
                            <form action="{{ route('profile.update', $calonSiswa->id) }}" method="POST" id="informasiPribadiForm">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Nama Siswa:</strong>
                                            <input type="text" name="nama_siswa" class="form-control-plaintext" value="{{ $calonSiswa->nama_siswa }}" readonly>
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>NIS:</strong>
                                            <input type="text" name="nis" class="form-control-plaintext" value="{{ $calonSiswa->pendaftaran->NIS ?? 'N/A' }}" readonly>
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Asal Sekolah:</strong>
                                            <input type="text" name="asal_sekolah" class="form-control-plaintext" value="{{ $calonSiswa->asal_sekolah }}" readonly>
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Tempat Lahir:</strong>
                                            <input type="text" name="tempat_lahir" class="form-control-plaintext" value="{{ $calonSiswa->tempat_lahir }}" readonly>
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Tanggal Lahir:</strong>
                                            <input type="date" name="tanggal_lahir" class="form-control-plaintext" value="{{ $calonSiswa->tanggal_lahir }}" readonly>
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Agama:</strong>
                                            <input type="text" name="agama" class="form-control-plaintext" value="{{ $calonSiswa->agama }}" readonly>
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Jenis Kelamin:</strong>
                                            <input type="text" name="jk" class="form-control-plaintext" value="{{ $calonSiswa->jk }}" readonly>
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Tahun Ajaran:</strong>
                                            <input type="text" name="tahun_ajaran" class="form-control-plaintext" value="{{ $calonSiswa->tahun_ajaran }}" readonly>
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Nomor Telepon:</strong>
                                            <input type="text" name="no_tlpn" class="form-control-plaintext" value="{{ $calonSiswa->no_tlpn }}" readonly>
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Email:</strong>
                                            <input type="email" name="email" class="form-control-plaintext" value="{{ $calonSiswa->email }}" readonly>
                                        </p>
                                    </div>
                                    <div class="col-12">
                                        <p><strong>Alamat:</strong>
                                            <input type="text" name="alamat" class="form-control-plaintext" value="{{ $calonSiswa->alamat }}" readonly>
                                        </p>
                                    </div>
                                    <div class="col-12 text-end d-none" id="informasiPribadiSaveBtn">
                                        <button type="submit" class="btn btn-sm btn-success">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Informasi Orangtua -->
                    <div class="card mb-4 border">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="text-heading">Informasi Orangtua</h5>
                            <div>
                                <button class="btn btn-sm btn-outline-primary edit-btn" data-target="#informasiOrangtua">Edit</button>
                                <button class="btn btn-sm btn-outline-danger d-none cancel-btn" data-target="#informasiOrangtuaForm">Cancel</button>
                            </div>
                        </div>
                        <div class="card-body" id="informasiOrangtua">
                            <form action="{{ route('profile.update', $calonSiswa->id) }}" method="POST" id="informasiOrangtuaForm">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Nama Ayah:</strong>
                                            <input type="text" name="nama_ayah" class="form-control-plaintext" value="{{ $calonSiswa->pendaftaran->nama_ayah ?? 'N/A' }}" readonly>
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Pekerjaan Ayah:</strong>
                                            <input type="text" name="pekerjaan_ayah" class="form-control-plaintext" value="{{ $calonSiswa->pendaftaran->pekerjaan_ayah ?? 'N/A' }}" readonly>
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Nama Ibu:</strong>
                                            <input type="text" name="nama_ibu" class="form-control-plaintext" value="{{ $calonSiswa->pendaftaran->nama_ibu ?? 'N/A' }}" readonly>
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Pekerjaan Ibu:</strong>
                                            <input type="text" name="pekerjaan_ibu" class="form-control-plaintext" value="{{ $calonSiswa->pendaftaran->pekerjaan_ibu ?? 'N/A' }}" readonly>
                                        </p>
                                    </div>
                                    <div class="col-12 text-end d-none" id="informasiOrangtuaSaveBtn">
                                        <button type="submit" class="btn btn-sm btn-success">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Informasi Alamat Orangtua dan Wali -->
                    <div class="card mb-4 border">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="text-heading">Informasi Alamat Orangtua dan Wali</h5>
                            <div>
                                <button class="btn btn-sm btn-outline-primary edit-btn" data-target="#informasiAlamatOrangtua">Edit</button>
                                <button class="btn btn-sm btn-outline-danger d-none cancel-btn" data-target="#informasiAlamatOrangtuaForm">Cancel</button>
                            </div>
                        </div>
                        <div class="card-body" id="informasiAlamatOrangtua">
                            <form action="{{ route('profile.update', $calonSiswa->id) }}" method="POST" id="informasiAlamatOrangtuaForm">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-12">
                                        <p><strong>Alamat Orangtua:</strong>
                                            <input type="text" name="alamat_orangtua" class="form-control-plaintext" value="{{ $calonSiswa->pendaftaran->alamat_orangtua ?? 'N/A' }}" readonly>
                                        </p>
                                    </div>
                                    <div class="col-12">
                                        <p><strong>Nama Wali:</strong>
                                            <input type="text" name="nama_wali" class="form-control-plaintext" value="{{ $calonSiswa->pendaftaran->nama_wali ?? 'N/A' }}" readonly>
                                        </p>
                                    </div>
                                    <div class="col-12">
                                        <p><strong>Alamat Wali:</strong>
                                            <input type="text" name="alamat_wali" class="form-control-plaintext" value="{{ $calonSiswa->pendaftaran->alamat_wali ?? 'N/A' }}" readonly>
                                        </p>
                                    </div>
                                    <div class="col-12 text-end d-none" id="informasiAlamatOrangtuaSaveBtn">
                                        <button type="submit" class="btn btn-sm btn-success">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Informasi Tambahan -->
                    <div class="card mb-4 border">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="text-heading">Informasi Tambahan</h5>
                            <div>
                                <button class="btn btn-sm btn-outline-primary edit-btn" data-target="#informasiTambahan">Edit</button>
                                <button class="btn btn-sm btn-outline-danger d-none cancel-btn" data-target="#informasiTambahanForm">Cancel</button>
                            </div>
                        </div>
                        <div class="card-body" id="informasiTambahan">
                            <form action="{{ route('profile.update', $calonSiswa->id) }}" method="POST" id="informasiTambahanForm">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Golongan Darah:</strong>
                                            <input type="text" name="golongan_darah" class="form-control-plaintext" value="{{ $calonSiswa->pendaftaran->golongan_darah ?? 'N/A' }}" readonly>
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Tanggal Registrasi:</strong>
                                            <input type="date" name="tanggal_registrasi" class="form-control-plaintext" value="{{ $calonSiswa->pendaftaran->tanggal_registrasi ?? 'N/A' }}" readonly>
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Jumlah Saudara Kandung:</strong>
                                            <input type="number" name="jml_saudara_kandung" class="form-control-plaintext" value="{{ $calonSiswa->pendaftaran->jml_saudara_kandung ?? 'N/A' }}" readonly>
                                        </p>
                                    </div>
                                    <div class="col-12 text-end d-none" id="informasiTambahanSaveBtn">
                                        <button type="submit" class="btn btn-sm btn-success">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function () {
            const target = document.querySelector(this.dataset.target);
            const form = target.querySelector('form');
            const inputs = form.querySelectorAll('.form-control-plaintext');
            const saveBtn = target.querySelector('.text-end');
            const cancelBtn = target.closest('.card').querySelector('.cancel-btn');

            inputs.forEach(input => {
                input.classList.remove('form-control-plaintext');
                input.classList.add('form-control');
                input.removeAttribute('readonly');
            });

            saveBtn.classList.remove('d-none');
            cancelBtn.classList.remove('d-none');
        });
    });

    document.querySelectorAll('.cancel-btn').forEach(button => {
        button.addEventListener('click', function () {
            location.reload();
        });
    });
</script>
@endsection
