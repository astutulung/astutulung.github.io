@extends('admin.layouts.app')

@section('content')
    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <table class="dt-pendaftaran table table-bordered">
                <thead>
                    <tr>
                        <th>Kode RUS</th>
                        <th>Nama Siswa</th>
                        <th>NIS</th>
                        <th>No Seri Ijazah</th>
                        <th>Nama Ayah</th>
                        <th>Pekerjaan Ayah</th>
                        <th>Nama Ibu</th>
                        <th>Pekerjaan Ibu</th>
                        <th>Alamat Orangtua</th>
                        <th>Nama Wali</th>
                        <th>Alamat Wali</th>
                        <th>Tinggal Bersama</th>
                        <th>Asal Provinsi</th>
                        <th>Asal Kabupaten</th>
                        <th>Asal Kecamatan</th>
                        <th>Asal Kelurahan</th>
                        <th>RT</th>
                        <th>RW</th>
                        <th>Golongan Darah</th>
                        <th>Tanggal Registrasi</th>
                        <th>Jumlah Saudara Kandung</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <!-- Modal untuk Detail Siswa -->
    <div class="modal fade" id="viewUser" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-simple modal-view-user">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body p-0">
                    <div class="text-center mb-6">
                        <h4 class="mb-2">Student Information</h4>
                        <p class="mb-6">Details about the selected student.</p>
                    </div>
                    <form id="viewUserForm" class="row g-5">
                        <!-- Informasi Pribadi -->
                        <div class="col-12">
                            <h5 class="text-heading">Informasi Pribadi</h5>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <p><strong>Nama Siswa:</strong> <span id="viewNamaSiswa"></span></p>
                                </div>
                                <div class="col-12 col-md-6">
                                    <p><strong>NIS:</strong> <span id="viewNIS"></span></p>
                                </div>
                                <div class="col-12 col-md-6">
                                    <p><strong>No Seri Ijazah:</strong> <span id="viewNoSeriIjazah"></span></p>
                                </div>
                                <div class="col-12 col-md-6">
                                    <p><strong>Kode RUS:</strong> <span id="viewKodeRUS"></span></p>
                                </div>
                                <div class="col-12 col-md-6">
                                    <p><strong>Golongan Darah:</strong> <span id="viewGolonganDarah"></span></p>
                                </div>
                                <div class="col-12 col-md-6">
                                    <p><strong>Tanggal Registrasi:</strong> <span id="viewTanggalRegistrasi"></span></p>
                                </div>
                                <div class="col-12 col-md-6">
                                    <p><strong>Jumlah Saudara Kandung:</strong> <span id="viewJumlahSaudaraKandung"></span></p>
                                </div>
                            </div>
                        </div>

                        <!-- Informasi Orangtua -->
                        <div class="col-12">
                            <h5 class="text-heading">Informasi Orangtua</h5>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <p><strong>Nama Ayah:</strong> <span id="viewNamaAyah"></span></p>
                                </div>
                                <div class="col-12 col-md-6">
                                    <p><strong>Pekerjaan Ayah:</strong> <span id="viewPekerjaanAyah"></span></p>
                                </div>
                                <div class="col-12 col-md-6">
                                    <p><strong>Nama Ibu:</strong> <span id="viewNamaIbu"></span></p>
                                </div>
                                <div class="col-12 col-md-6">
                                    <p><strong>Pekerjaan Ibu:</strong> <span id="viewPekerjaanIbu"></span></p>
                                </div>
                            </div>
                        </div>

                        <!-- Informasi Alamat -->
                        <div class="col-12">
                            <h5 class="text-heading">Alamat Orangtua dan Wali</h5>
                            <div class="row">
                                <div class="col-12">
                                    <p><strong>Alamat Orangtua:</strong> <span id="viewAlamatOrangtua"></span></p>
                                </div>
                                <div class="col-12">
                                    <p><strong>Nama Wali:</strong> <span id="viewNamaWali"></span></p>
                                </div>
                                <div class="col-12">
                                    <p><strong>Alamat Wali:</strong> <span id="viewAlamatWali"></span></p>
                                </div>
                                <div class="col-12">
                                    <p><strong>Tinggal Bersama:</strong> <span id="viewTinggalBersama"></span></p>
                                </div>
                                <div class="col-12 col-md-6">
                                    <p><strong>Asal Provinsi:</strong> <span id="viewAsalProvinsi"></span></p>
                                </div>
                                <div class="col-12 col-md-6">
                                    <p><strong>Asal Kabupaten:</strong> <span id="viewAsalKabupaten"></span></p>
                                </div>
                                <div class="col-12 col-md-6">
                                    <p><strong>Asal Kecamatan:</strong> <span id="viewAsalKecamatan"></span></p>
                                </div>
                                <div class="col-12 col-md-6">
                                    <p><strong>Asal Kelurahan:</strong> <span id="viewAsalKelurahan"></span></p>
                                </div>
                                <div class="col-12 col-md-6">
                                    <p><strong>RT:</strong> <span id="viewRT"></span></p>
                                </div>
                                <div class="col-12 col-md-6">
                                    <p><strong>RW:</strong> <span id="viewRW"></span></p>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Tutup -->
                        <div class="col-12 text-center d-flex flex-wrap justify-content-center gap-4 row-gap-4">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                                Close
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            var dt_pendaftaran_table = $('.dt-pendaftaran');
            var dt_pendaftaran;

            if (dt_pendaftaran_table.length) {
                dt_pendaftaran = dt_pendaftaran_table.DataTable({
                    processing: true,
                    serverSide: true,
                    scrollX: true, // Enable horizontal scrolling
                    responsive: false, // Disable responsiveness to show all columns
                    ajax: '{{ route('pendaftaran.data') }}',
                    columns: [
                        { data: 'kode_rus', title: 'Kode RUS' },
                        { data: 'calon_siswa.nama_siswa', title: 'Nama Siswa' },
                        { data: 'NIS', title: 'NIS' },
                        { data: 'no_seri_ijazah', title: 'No Seri Ijazah' },
                        { data: 'nama_ayah', title: 'Nama Ayah' },
                        { data: 'pekerjaan_ayah', title: 'Pekerjaan Ayah' },
                        { data: 'nama_ibu', title: 'Nama Ibu' },
                        { data: 'pekerjaan_ibu', title: 'Pekerjaan Ibu' },
                        { data: 'alamat_orangtua', title: 'Alamat Orangtua' },
                        { data: 'nama_wali', title: 'Nama Wali' },
                        { data: 'alamat_wali', title: 'Alamat Wali' },
                        { data: 'tinggal_bersama', title: 'Tinggal Bersama' },
                        { data: 'asal_prov', title: 'Asal Provinsi' },
                        { data: 'asal_kab', title: 'Asal Kabupaten' },
                        { data: 'asal_kec', title: 'Asal Kecamatan' },
                        { data: 'asal_kel', title: 'Asal Kelurahan' },
                        { data: 'RT', title: 'RT' },
                        { data: 'RW', title: 'RW' },
                        { data: 'golongan_darah', title: 'Golongan Darah' },
                        { data: 'tanggal_registrasi', title: 'Tanggal Registrasi' },
                        { data: 'jml_saudara_kandung', title: 'Jumlah Saudara Kandung' },
                        { data: 'action', title: 'Action', orderable: false, searchable: false }
                    ],
                    dom: '<"card-header flex-column flex-md-row border-bottom"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6 mt-5 mt-md-0"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                    displayLength: 10,
                    lengthMenu: [10, 25, 50, 75, 100],
                    buttons: [
                        {
                            extend: 'collection',
                            className: 'btn btn-label-primary dropdown-toggle me-4 waves-effect waves-light',
                            text: '<i class="ri-external-link-line me-sm-1"></i> <span class="d-none d-sm-inline-block">Export</span>',
                            buttons: [
                                {
                                    extend: 'print',
                                    text: '<i class="ri-printer-line me-1"></i>Print',
                                    className: 'dropdown-item',
                                    exportOptions: {
                                        columns: ':visible',
                                        format: {
                                            body: function(inner, coldex, rowdex) {
                                                var el = $.parseHTML(inner);
                                                var result = '';
                                                $.each(el, function(index, item) {
                                                    result += item.innerText || item.textContent || '';
                                                });
                                                return result;
                                            }
                                        }
                                    },
                                    customize: function(win) {
                                        $(win.document.body)
                                            .css('color', config.colors.headingColor)
                                            .css('border-color', config.colors.borderColor)
                                            .css('background-color', config.colors.bodyBg);
                                        $(win.document.body)
                                            .find('table')
                                            .addClass('compact')
                                            .css('color', 'inherit')
                                            .css('border-color', 'inherit')
                                            .css('background-color', 'inherit');
                                    }
                                },
                                {
                                    extend: 'csv',
                                    text: '<i class="ri-file-text-line me-1"></i>Csv',
                                    className: 'dropdown-item',
                                    exportOptions: {
                                        columns: ':visible',
                                        format: {
                                            body: function(inner, coldex, rowdex) {
                                                var el = $.parseHTML(inner);
                                                var result = '';
                                                $.each(el, function(index, item) {
                                                    result += item.innerText || item.textContent || '';
                                                });
                                                return result;
                                            }
                                        }
                                    }
                                },
                                {
                                    extend: 'excel',
                                    text: '<i class="ri-file-excel-line me-1"></i>Excel',
                                    className: 'dropdown-item',
                                    exportOptions: {
                                        columns: ':visible',
                                        format: {
                                            body: function(inner, coldex, rowdex) {
                                                var el = $.parseHTML(inner);
                                                var result = '';
                                                $.each(el, function(index, item) {
                                                    result += item.innerText || item.textContent || '';
                                                });
                                                return result;
                                            }
                                        }
                                    }
                                },
                                {
                                    extend: 'pdf',
                                    text: '<i class="ri-file-pdf-line me-1"></i>Pdf',
                                    className: 'dropdown-item',
                                    exportOptions: {
                                        columns: ':visible',
                                        format: {
                                            body: function(inner, coldex, rowdex) {
                                                var el = $.parseHTML(inner);
                                                var result = '';
                                                $.each(el, function(index, item) {
                                                    result += item.innerText || item.textContent || '';
                                                });
                                                return result;
                                            }
                                        }
                                    }
                                },
                                {
                                    extend: 'copy',
                                    text: '<i class="ri-file-copy-line me-1"></i>Copy',
                                    className: 'dropdown-item',
                                    exportOptions: {
                                        columns: ':visible',
                                        format: {
                                            body: function(inner, coldex, rowdex) {
                                                var el = $.parseHTML(inner);
                                                var result = '';
                                                $.each(el, function(index, item) {
                                                    result += item.innerText || item.textContent || '';
                                                });
                                                return result;
                                            }
                                        }
                                    }
                                }
                            ]
                        }
                    ],
                    order: [[1, 'desc']], // Urutkan berdasarkan kolom Kode RUS
                });

                // Event untuk tombol "Details"
                dt_pendaftaran_table.on('click', '.view-details', function() {
                    var id_pendaftaran = $(this).data('id');
                    var url = `/pendaftaran/${id_pendaftaran}/details`;

                    $.ajax({
                        url: url,
                        method: 'GET',
                        success: function(data) {
                            // Isi data ke dalam modal
                            $('#viewNamaSiswa').text(data.calon_siswa.nama_siswa);
                            $('#viewNIS').text(data.NIS);
                            $('#viewNoSeriIjazah').text(data.no_seri_ijazah);
                            $('#viewKodeRUS').text(data.kode_rus);
                            $('#viewGolonganDarah').text(data.golongan_darah);
                            $('#viewTanggalRegistrasi').text(data.tanggal_registrasi);
                            $('#viewJumlahSaudaraKandung').text(data.jml_saudara_kandung);

                            $('#viewNamaAyah').text(data.nama_ayah);
                            $('#viewPekerjaanAyah').text(data.pekerjaan_ayah);
                            $('#viewNamaIbu').text(data.nama_ibu);
                            $('#viewPekerjaanIbu').text(data.pekerjaan_ibu);

                            $('#viewAlamatOrangtua').text(data.alamat_orangtua);
                            $('#viewNamaWali').text(data.nama_wali);
                            $('#viewAlamatWali').text(data.alamat_wali);
                            $('#viewTinggalBersama').text(data.tinggal_bersama);
                            $('#viewAsalProvinsi').text(data.asal_prov);
                            $('#viewAsalKabupaten').text(data.asal_kab);
                            $('#viewAsalKecamatan').text(data.asal_kec);
                            $('#viewAsalKelurahan').text(data.asal_kel);
                            $('#viewRT').text(data.RT);
                            $('#viewRW').text(data.RW);

                            // Tampilkan modal
                            $('#viewUser').modal('show');
                        },
                        error: function(xhr, status, error) {
                            console.error('Terjadi kesalahan saat mengambil data:', error);
                        }
                    });
                });

                // Delete Record
                dt_pendaftaran_table.on('click', '.delete-record', function() {
                    var id_pendaftaran = $(this).data('id');
                    var url = $(this).data('url').replace(':id', id_pendaftaran);

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: url,
                                type: 'DELETE',
                                data: {
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(response) {
                                    if (response.success) {
                                        Swal.fire('Deleted!', 'Record has been deleted.', 'success');
                                        dt_pendaftaran.ajax.reload();
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.log(error);
                                }
                            });
                        }
                    });
                });
            }
        });
    </script>
@endpush

@push('css')
    <style>
        .dataTables_wrapper {
            width: 100%;
            overflow-x: auto;
            overflow-y: hidden;
            -webkit-overflow-scrolling: touch;
        }

        .dt-pendaftaran {
            width: 100% !important;
            white-space: nowrap;
        }
    </style>
@endpush
