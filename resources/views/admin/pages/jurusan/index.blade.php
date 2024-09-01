@extends('admin.layouts.app')

@section('content')
<div class="card mb-3">
    <div class="card-header">
        <h5 class="card-title">Manajemen Data Jurusan</h5>
    </div>
</div>
<div class="card">
    <div class="card-datatable table-responsive">
        <div class="add-new mb-2 text-end mt-2 me-2">
            <button class='btn btn-primary waves-effect waves-light' data-bs-toggle='offcanvas'
                data-bs-target='#offcanvasAddJurusan'>
                <i class='ri-add-line me-0 me-sm-1 d-inline-block d-sm-none'></i>
                <span class='d-none d-sm-inline-block'>Add New Jurusan</span>
            </button>
        </div>
        <table id="dt_jurusan_table" class="datatables-jurusan table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Tahun Ajaran</th>
                    <th>Kuota</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

{{-- Offcanvas Add Jurusan --}}
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddJurusan" aria-labelledby="offcanvasAddJurusanLabel">
    <div class="offcanvas-header border-bottom">
        <h5 id="offcanvasAddJurusanLabel" class="offcanvas-title">Add Jurusan</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0 h-100">
        <form class="add-new-jurusan pt-0" id="addNewJurusanForm" action="{{ route('jurusan.store') }}" method="POST">
            @csrf
            <div class="form-floating form-floating-outline mb-5">
                <input type="text" class="form-control" id="add-jurusan-nama" placeholder="Nama Jurusan" name="nama"
                    aria-label="Nama Jurusan" required />
                <label for="add-jurusan-nama">Nama</label>
            </div>
            <div class="form-floating form-floating-outline mb-5">
                <input type="text" class="form-control" id="add-jurusan-tahun_ajaran" placeholder="Tahun Ajaran" name="tahun_ajaran"
                    aria-label="Tahun Ajaran" required />
                <label for="add-jurusan-tahun_ajaran">Tahun Ajaran</label>
            </div>
            <div class="form-floating form-floating-outline mb-5">
                <input type="number" class="form-control" id="add-jurusan-kuota" placeholder="Kuota" name="kuota"
                    aria-label="Kuota" required />
                <label for="add-jurusan-kuota">Kuota</label>
            </div>
            <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button>
            <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>
        </form>
    </div>
</div>

{{-- Offcanvas Edit Jurusan --}}
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEditJurusan" aria-labelledby="offcanvasEditJurusanLabel">
    <div class="offcanvas-header border-bottom">
        <h5 id="offcanvasEditJurusanLabel" class="offcanvas-title">Edit Jurusan</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0 h-100">
        <form class="edit-jurusan-form pt-0" id="editJurusanForm" action="" method="POST">
            @csrf
            @method('PUT')
            <div class="form-floating form-floating-outline mb-5">
                <input type="text" class="form-control" id="edit-jurusan-nama" placeholder="Nama Jurusan" name="nama"
                    aria-label="Nama Jurusan" required />
                <label for="edit-jurusan-nama">Nama</label>
            </div>
            <div class="form-floating form-floating-outline mb-5">
                <input type="text" class="form-control" id="edit-jurusan-tahun_ajaran" placeholder="Tahun Ajaran" name="tahun_ajaran"
                    aria-label="Tahun Ajaran" required />
                <label for="edit-jurusan-tahun_ajaran">Tahun Ajaran</label>
            </div>
            <div class="form-floating form-floating-outline mb-5">
                <input type="number" class="form-control" id="edit-jurusan-kuota" placeholder="Kuota" name="kuota"
                    aria-label="Kuota" required />
                <label for="edit-jurusan-kuota">Kuota</label>
            </div>
            <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button>
            <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>
        </form>
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        var table = $('#dt_jurusan_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('jurusan.data') }}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'nama', name: 'nama' },
                { data: 'tahun_ajaran', name: 'tahun_ajaran' },
                { data: 'kuota', name: 'kuota' },
                { 
                    data: 'action', 
                    name: 'action', 
                    orderable: false, 
                    searchable: false 
                }
            ],
            dom: '<"d-flex justify-content-between ms-2"<"dt-action-buttons text-start"B><"head-label text-center">>t<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>rt<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
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
                                columns: [0, 1, 2, 3],
                                format: {
                                    body: function (inner, coldex, rowdex) {
                                        return inner; // Mengembalikan isi kolom tanpa modifikasi
                                    }
                                }
                            },
                            customize: function (win) {
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
                                columns: [0, 1, 2, 3],
                                format: {
                                    body: function (inner, coldex, rowdex) {
                                        return inner; 
                                    }
                                }
                            }
                        },
                        {
                            extend: 'excel',
                            text: '<i class="ri-file-excel-line me-1"></i>Excel',
                            className: 'dropdown-item',
                            exportOptions: {
                                columns: [0, 1, 2, 3],
                                format: {
                                    body: function (inner, coldex, rowdex) {
                                        return inner; 
                                    }
                                }
                            }
                        },
                        {
                            extend: 'pdf',
                            text: '<i class="ri-file-pdf-line me-1"></i>Pdf',
                            className: 'dropdown-item',
                            exportOptions: {
                                columns: [0, 1, 2, 3],
                                format: {
                                    body: function (inner, coldex, rowdex) {
                                        return inner; 
                                    }
                                }
                            }
                        },
                        {
                            extend: 'copy',
                            text: '<i class="ri-file-copy-line me-1"></i>Copy',
                            className: 'dropdown-item',
                            exportOptions: {
                                columns: [0, 1, 2, 3],
                                format: {
                                    body: function (inner, coldex, rowdex) {
                                        return inner;
                                    }
                                }
                            }
                        }
                    ]
                }
            ]
        });

        // Edit Jurusan
        $('.datatables-jurusan tbody').on('click', '.edit-record', function() {
            var jurusanId = $(this).data('id');
            var editUrl = $(this).data('url');

            $.ajax({
                url: editUrl,
                type: 'GET',
                success: function(response) {
                    $('#editJurusanForm').attr('action', `/jurusan/${response.id}`);
                    $('#edit-jurusan-nama').val(response.nama);
                    $('#edit-jurusan-tahun_ajaran').val(response.tahun_ajaran);
                    $('#edit-jurusan-kuota').val(response.kuota);

                    var offcanvasEditJurusan = new bootstrap.Offcanvas(document.getElementById('offcanvasEditJurusan'));
                    offcanvasEditJurusan.show();
                },
                error: function(xhr, error, thrown) {
                    console.log(xhr.responseText);
                    alert('Error: ' + error + '\n' + 'Thrown: ' + thrown);
                }
            });
        });

        // Update Jurusan
        $('#editJurusanForm').on('submit', function(event) {
            event.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            title: 'Success!',
                            text: response.message,
                            icon: 'success',
                            customClass: {
                                confirmButton: 'btn btn-primary waves-effect waves-light'
                            },
                            buttonsStyling: false
                        }).then(() => {
                            location.reload(); // Reload halaman setelah menekan OK
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: response.message,
                            icon: 'error',
                            customClass: {
                                confirmButton: 'btn btn-primary waves-effect waves-light'
                            },
                            buttonsStyling: false
                        });
                    }
                },
                error: function(response) {
                    var errorMessage = 'An error occurred while updating the jurusan.';
                    if (response.responseJSON && response.responseJSON.message) {
                        errorMessage = response.responseJSON.message;
                    }
                    Swal.fire({
                        title: 'Error!',
                        text: errorMessage,
                        icon: 'error',
                        customClass: {
                            confirmButton: 'btn btn-primary waves-effect waves-light'
                        },
                        buttonsStyling: false
                    });
                }
            });
        });

        // Delete Jurusan
        $('.datatables-jurusan tbody').on('click', '.delete-record', function() {
            var jurusanId = $(this).data('id');
            var deleteUrl = $(this).data('url');

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
                        url: deleteUrl,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    title: 'Deleted!',
                                    text: response.message,
                                    icon: 'success',
                                    customClass: {
                                        confirmButton: 'btn btn-primary waves-effect waves-light'
                                    },
                                    buttonsStyling: false
                                }).then(() => {
                                    location.reload(); // Reload halaman setelah menekan OK
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error!',
                                    text: response.message,
                                    icon: 'error',
                                    customClass: {
                                        confirmButton: 'btn btn-primary waves-effect waves-light'
                                    },
                                    buttonsStyling: false
                                });
                            }
                        },
                        error: function(response) {
                            var errorMessage = 'An error occurred while deleting the jurusan.';
                            if (response.responseJSON && response.responseJSON.message) {
                                errorMessage = response.responseJSON.message;
                            }
                            Swal.fire({
                                title: 'Error!',
                                text: errorMessage,
                                icon: 'error',
                                customClass: {
                                    confirmButton: 'btn btn-primary waves-effect waves-light'
                                },
                                buttonsStyling: false
                            });
                        }
                    });
                }
            });
        });

        // Add New Jurusan
        $('#addNewJurusanForm').on('submit', function(event) {
            event.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            title: 'Success!',
                            text: response.message,
                            icon: 'success',
                            customClass: {
                                confirmButton: 'btn btn-primary waves-effect waves-light'
                            },
                            buttonsStyling: false
                        }).then(() => {
                            location.reload(); // Reload halaman setelah menekan OK
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: response.message,
                            icon: 'error',
                            customClass: {
                                confirmButton: 'btn btn-primary waves-effect waves-light'
                            },
                            buttonsStyling: false
                        });
                    }
                },
                error: function(response) {
                    var errorMessage = 'An error occurred while creating the jurusan.';
                    if (response.responseJSON && response.responseJSON.message) {
                        errorMessage = response.responseJSON.message;
                    }
                    Swal.fire({
                        title: 'Error!',
                        text: errorMessage,
                        icon: 'error',
                        customClass: {
                            confirmButton: 'btn btn-primary waves-effect waves-light'
                        },
                        buttonsStyling: false
                    });
                }
            });
        });
    });
</script>


@endpush
