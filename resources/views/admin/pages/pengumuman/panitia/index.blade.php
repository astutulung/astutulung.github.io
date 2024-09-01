@extends('admin.layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Daftar Pengumuman</h5>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pengumumanModal">
                    Buat Pengumuman
                </button>
            </div>
            <div class="card-datatable table-responsive pt-0">
                <table class="dt_pengumuman table table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>Kode Pengumuman</th>
                            <th>Judul Pengumuman</th>
                            <th>Deskripsi</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal untuk Buat Pengumuman -->
    <div class="modal fade" id="pengumumanModal" tabindex="-1" aria-labelledby="pengumumanModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pengumumanModalLabel">Buat Pengumuman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('pengumuman.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="judul_pengumuman">Judul Pengumuman</label>
                            <input type="text" name="judul_pengumuman" class="form-control" id="judul_pengumuman"
                                required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="deskripsi">Deskripsi Pengumuman</label>
                            <textarea name="deskripsi" class="form-control" id="deskripsi" rows="4" required></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="status">Status Pengumuman</label>
                            <input type="text" name="status" class="form-control" id="status" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="broadcast">Tipe Pengumuman</label>
                            <div>
                                <input type="radio" name="broadcast" id="broadcast_all" value="all" checked>
                                <label for="broadcast_all">Broadcast ke Semua Siswa</label>
                            </div>
                            <div>
                                <input type="radio" name="broadcast" id="broadcast_specific" value="specific">
                                <label for="broadcast_specific">Pengumuman ke Siswa Tertentu</label>
                            </div>
                        </div>
                        <div class="form-group mb-3" id="specific_students" style="display: none;">
                            <label for="siswa">Pilih Siswa yang Menerima</label>
                            <div class="row">
                                @foreach ($siswaList as $siswa)
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="siswa[]"
                                                value="{{ $siswa->id }}" id="siswa{{ $siswa->id }}">
                                            <label class="form-check-label" for="siswa{{ $siswa->id }}">
                                                {{ $siswa->nama_siswa }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Kirim Pengumuman</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            var dt_basic_table = $('.dt_pengumuman');
            var dt_basic;

            if (dt_basic_table.length) {
                dt_basic = dt_basic_table.DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('pengumuman.data') }}',
                    columns: [{
                            data: '', // Kolom untuk kontrol
                            orderable: false,
                            searchable: false,
                            className: 'control',
                            render: function() {
                                return '';
                            }
                        },
                        {
                            data: 'id', // Kolom untuk checkbox
                            orderable: false,
                            searchable: false,
                            checkboxes: true,
                            render: function() {
                                return '<input type="checkbox" class="dt-checkboxes form-check-input">';
                            },
                            checkboxes: {
                                selectAllRender: '<input type="checkbox" class="form-check-input">'
                            }
                        },
                        {
                            data: 'kode_pengumuman'
                        },
                        {
                            data: 'judul_pengumuman' 
                        },
                        {
                            data: 'deskripsi' 
                        },
                        {
                            data: 'status',
                            render: function(data, type, full) {
                                var $status = full['status'];
                                var statusOptions = `
                                <select class="form-control form-control-sm status-dropdown" data-id="${full['id']}">
                                    <option value="active" ${$status === 'active' ? 'selected' : ''}>Active</option>
                                    <option value="inactive" ${$status === 'inactive' ? 'selected' : ''}>Inactive</option>
                                </select>
                            `;
                                return statusOptions;
                            }
                        },
                        {
                            data: 'action', // Kolom action
                            orderable: false,
                            searchable: false,
                            render: function() {
                                return `
                                <div class="d-inline-block">
                                    <a href="javascript:;" class="btn btn-sm btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="ri-more-2-line"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end m-0">
                                        <li><a href="javascript:void(0)" class="dropdown-item edit-record">Edit</a></li>
                                        <li><a href="javascript:void(0)" class="dropdown-item delete-record">Delete</a></li>
                                    </ul>
                                </div>
                            `;
                            }
                        }
                    ],
                    order: [
                        [2, 'desc']
                    ],
                    dom: '<"card-header flex-column flex-md-row border-bottom"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>>' +
                        '<"row"<"col-sm-12 col-md-6 mt-5 mt-md-0"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t' +
                        '<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                    displayLength: 7,
                    lengthMenu: [7, 10, 25, 50, 75, 100],
                    buttons: [{
                        extend: 'collection',
                        className: 'btn btn-label-primary dropdown-toggle me-4 waves-effect waves-light',
                        text: '<i class="ri-external-link-line me-sm-1"></i> <span class="d-none d-sm-inline-block">Export</span>',
                        buttons: [{
                                extend: 'print',
                                text: '<i class="ri-printer-line me-1"></i>Print',
                                className: 'dropdown-item'
                            },
                            {
                                extend: 'csv',
                                text: '<i class="ri-file-text-line me-1"></i>Csv',
                                className: 'dropdown-item'
                            },
                            {
                                extend: 'excel',
                                text: '<i class="ri-file-excel-line me-1"></i>Excel',
                                className: 'dropdown-item'
                            },
                            {
                                extend: 'pdf',
                                text: '<i class="ri-file-pdf-line me-1"></i>Pdf',
                                className: 'dropdown-item'
                            },
                            {
                                extend: 'copy',
                                text: '<i class="ri-file-copy-line me-1"></i>Copy',
                                className: 'dropdown-item'
                            }
                        ]
                    }],
                    responsive: {
                        details: {
                            display: $.fn.dataTable.Responsive.display.modal({
                                header: function(row) {
                                    var data = row.data();
                                    return 'Details of ' + data['judul_pengumuman'];
                                }
                            }),
                            type: 'column',
                            renderer: function(api, rowIdx, columns) {
                                var data = $.map(columns, function(col) {
                                    return col.title !== '' ?
                                        '<tr data-dt-row="' + col.rowIndex +
                                        '" data-dt-column="' + col.columnIndex + '">' +
                                        '<td>' + col.title + ':</td> ' +
                                        '<td>' + col.data + '</td>' +
                                        '</tr>' : '';
                                }).join('');
                                return data ? $('<table class="table"/><tbody />').append(data) : false;
                            }
                        }
                    }
                });

                // Update status
                $(document).on('change', '.status-dropdown', function() {
                    var id = $(this).data('id');
                    var status = $(this).val();

                    Swal.fire({
                        title: 'Apakah anda yakin?',
                        text: "Status pengumuman akan diupdate",
                        icon: 'warning',
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: '{{ route('pengumuman.update_status') }}',
                                type: 'POST',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    id: id,
                                    status: status
                                },
                                success: function(response) {
                                    if (response.success) {
                                        Swal.fire(
                                            'Updated!',
                                            'Status Pengumuman Telah Terupdate',
                                            'success'
                                        );
                                        dt_basic.ajax.reload();
                                    } else {
                                        Swal.fire(
                                            'Failed!',
                                            'Gagal mengupdate status.',
                                            'error'
                                        );
                                    }
                                }
                            });
                        }
                    });
                });

                // Menampilkan dan menyembunyikan elemen specific_students
                const broadcastSpecificRadio = document.getElementById('broadcast_specific');
                const specificStudentsDiv = document.getElementById('specific_students');
                const broadcastAllRadio = document.getElementById('broadcast_all');

                broadcastSpecificRadio.addEventListener('change', function() {
                    if (this.checked) {
                        specificStudentsDiv.style.display = 'block';
                    }
                });

                broadcastAllRadio.addEventListener('change', function() {
                    if (this.checked) {
                        specificStudentsDiv.style.display = 'none';
                    }
                });

                // Inisiasi awal: jika halaman dimuat dengan opsi "specific" yang sudah dipilih
                if (broadcastSpecificRadio.checked) {
                    specificStudentsDiv.style.display = 'block';
                }
            }
        });
    </script>
@endpush
