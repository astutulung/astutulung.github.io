@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <!-- Basic Layout -->
        <div class="col-xxl">
            <div class="card mb-6">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Form Registrasi Ulang</h5>
                    <small class="text-muted float-end">Masukkan data registrasi ulang</small>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('registrasiulang.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="nis" class="form-label">NIS</label>
                                <input type="text" name="NIS" class="form-control" id="nis"
                                    placeholder="NIS" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="no_seri_ijazah" class="form-label">Nomor Seri Ijazah</label>
                                
                                <input type="number" name="no_seri_ijazah" class="form-control" id="no_seri_ijazah"
                                    placeholder="Nomor Seri Ijazah" />
                            </div>
                            <div class="col-md-4 mb-3">
                            <span class="text-danger" style="font-size: 12px;">*Format File berupa PDF dan ukuran min 2mb</span>
                                <label for="file_SKHUN" class="form-label">File SKHUN</label>
                                <input type="file" name="file_SKHUN" class="form-control" id="file_SKHUN" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="nama_ayah" class="form-label">Nama Ayah</label>
                                <input type="text" name="nama_ayah" class="form-control" id="nama_ayah"
                                    placeholder="Nama Ayah" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="pekerjaan_ayah" class="form-label">Pekerjaan Ayah</label>
                                <input type="text" name="pekerjaan_ayah" class="form-control" id="pekerjaan_ayah"
                                    placeholder="Pekerjaan Ayah" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="nama_ibu" class="form-label">Nama Ibu</label>
                                <input type="text" name="nama_ibu" class="form-control" id="nama_ibu"
                                    placeholder="Nama Ibu" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="pekerjaan_ibu" class="form-label">Pekerjaan Ibu</label>
                                <input type="text" name="pekerjaan_ibu" class="form-control" id="pekerjaan_ibu"
                                    placeholder="Pekerjaan Ibu" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="alamat_orangtua" class="form-label">Alamat Orang Tua</label>
                                <input type="text" name="alamat_orangtua" class="form-control" id="alamat_orangtua"
                                    placeholder="Alamat Orang Tua" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="nama_wali" class="form-label">Nama Wali</label>
                                <input type="text" name="nama_wali" class="form-control" id="nama_wali"
                                    placeholder="Nama Wali" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="alamat_wali" class="form-label">Alamat Wali</label>
                                <input type="text" name="alamat_wali" class="form-control" id="alamat_wali"
                                    placeholder="Alamat Wali" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="tinggal_bersama" class="form-label">Tinggal Bersama</label>
                                <input type="text" name="tinggal_bersama" class="form-control" id="tinggal_bersama"
                                    placeholder="Tinggal Bersama" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="asal_prov" class="form-label">Asal Provinsi</label>
                                <input type="text" name="asal_prov" class="form-control" id="asal_prov"
                                    placeholder="Asal Provinsi" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="asal_kab" class="form-label">Asal Kabupaten</label>
                                <input type="text" name="asal_kab" class="form-control" id="asal_kab"
                                    placeholder="Asal Kabupaten" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="asal_kec" class="form-label">Asal Kecamatan</label>
                                <input type="text" name="asal_kec" class="form-control" id="asal_kec"
                                    placeholder="Asal Kecamatan" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="asal_kel" class="form-label">Asal Kelurahan</label>
                                <input type="text" name="asal_kel" class="form-control" id="asal_kel"
                                    placeholder="Asal Kelurahan" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="rt" class="form-label">RT</label>
                                <input type="number" name="RT" class="form-control" id="rw"
                                    placeholder="RT" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="rw" class="form-label">RW</label>
                                <input type="number" name="RW" class="form-control" id="rt"
                                    placeholder="RW" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="golongan_darah" class="form-label">Golongan Darah</label>
                                <input type="text" name="golongan_darah" class="form-control" id="golongan_darah"
                                    placeholder="Golongan Darah" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="tanggal_registrasi" class="form-label">Tanggal Registrasi</label>
                                <input type="date" name="tanggal_registrasi" class="form-control"
                                    id="tanggal_registrasi" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="jml_saudara_kandung" class="form-label">Jumlah Saudara Kandung</label>
                                <input type="number" name="jml_saudara_kandung" class="form-control"
                                    id="jml_saudara_kandung" placeholder="Jumlah Saudara Kandung" />
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-primary">Kirim</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
