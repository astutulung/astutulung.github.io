@extends('admin.layouts.app')

@section('content')
    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <table class="dt_calon_siswa table table-bordered">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Tanggal Pendaftaran</th>
                        <th>Nomor HP</th>
                        <th>Asal Sekolah</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <!-- Modal for Details -->
    <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailsModalLabel">Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Name:</strong> <span id="modalNamaSiswa"></span>
                        </div>
                        <div class="col-md-4">
                            <strong>Email:</strong> <span id="modalEmailSiswa"></span>
                        </div>
                        <div class="col-md-4">
                            <strong>Tanggal Pendaftaran:</strong> <span id="modalTanggalPendaftaran"></span>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <strong>Nomor HP:</strong> <span id="modalNomorHP"></span>
                        </div>
                        <div class="col-md-4">
                            <strong>Asal Sekolah:</strong> <span id="modalAsalSekolah"></span>
                        </div>
                        <div class="col-md-4">
                            <strong>Status:</strong> <span id="modalStatus"></span>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <strong>File Raport:</strong> <a href="#" id="modalFileRaport" class="btn btn-sm btn-primary" download>Download</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script>
$(document).ready(function() {
    var dt_basic_table = $('.dt_calon_siswa');
    var dt_basic;

    if (dt_basic_table.length) {
        dt_basic = dt_basic_table.DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('calon_siswa.data') }}',
            columns: [
                { data: '' },
                { data: 'id' },
                { data: 'id' },
                { data: 'nama_siswa' },
                { data: 'email' },
                { data: 'tanggal_daftar' },
                { data: 'no_tlpn' },
                { data: 'asal_sekolah' },
                { data: 'status' },
                { data: 'action', orderable: false, searchable: false }
            ],
            columnDefs: [
                {
                    className: 'control',
                    orderable: false,
                    searchable: false,
                    responsivePriority: 2,
                    targets: 0,
                    render: function(data, type, full, meta) {
                        return '';
                    }
                },
                {
                    targets: 1,
                    orderable: false,
                    searchable: false,
                    responsivePriority: 3,
                    checkboxes: true,
                    render: function() {
                        return '<input type="checkbox" class="dt-checkboxes form-check-input">';
                    },
                    checkboxes: {
                        selectAllRender: '<input type="checkbox" class="form-check-input">'
                    }
                },
                {
                    targets: 2,
                    searchable: false,
                    visible: false
                },
                {
                    targets: 3,
                    responsivePriority: 4,
                    render: function(data, type, full, meta) {
                        var $user_img = full['avatar'],
                            $name = full['nama_siswa'],
                            $kode_pcs = full['kode_pcs'];
                        if ($user_img) {
                            var $output = '<img src="{{ asset('img/avatars/') }}/' +
                                $user_img + '" alt="Avatar" class="rounded-circle">';
                        } else {
                            var stateNum = Math.floor(Math.random() * 6);
                            var states = ['success', 'danger', 'warning', 'info', 'dark', 'primary', 'secondary'];
                            var $state = states[stateNum],
                                $name = full['nama_siswa'],
                                $initials = $name.match(/\b\w/g) || [];
                            $initials = (($initials.shift() || '') + ($initials.pop() || '')).toUpperCase();
                            $output = '<span class="avatar-initial rounded-circle bg-label-' + $state + '">' + $initials + '</span>';
                        }
                        var $row_output =
                            '<div class="d-flex justify-content-start align-items-center user-name">' +
                            '<div class="avatar-wrapper">' +
                            '<div class="avatar me-2">' +
                            $output +
                            '</div>' +
                            '</div>' +
                            '<div class="d-flex flex-column">' +
                            '<span class="emp_name text-truncate text-heading fw-medium">' + $name + '</span>' +
                            '<small class="emp_post text-truncate">' + $kode_pcs + '</small>' +
                            '</div>' +
                            '</div>';
                        return $row_output;
                    }
                },
                {
                    responsivePriority: 1,
                    targets: 4
                },
                {
                    targets: 8,
                    render: function(data, type, full, meta) {
                        var $status = full['status'];
                        var statusOptions = `
                            <select class="form-control form-control-sm status-dropdown" data-id="${full['id']}">
                                <option value="pending" ${$status === 'pending' ? 'selected' : ''}>Pending</option>
                                <option value="accept" ${$status === 'accept' ? 'selected' : ''}>Terima</option>
                                <option value="reject" ${$status === 'reject' ? 'selected' : ''}>Tolak</option>
                            </select>
                        `;
                        return statusOptions;
                    }
                },
                {
                    targets: -1,
                    title: 'Actions',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, full, meta) {
                        return (
                            '<div class="d-inline-block">' +
                            '<a href="javascript:;" class="btn btn-sm btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ri-more-2-line"></i></a>' +
                            '<ul class="dropdown-menu dropdown-menu-end m-0">' +
                            '<li><a href="javascript:;" class="dropdown-item view-details" data-id="' + full.id + '" data-bs-toggle="modal" data-bs-target="#detailsModal">Details</a></li>' +
                            '<li><a href="javascript:;" class="dropdown-item text-danger delete-record" data-id="' + full.id + '" data-url="{{ route('calon_siswa.destroy', ':id') }}">Delete</a></li>' +
                            '</ul>' +
                            '</div>'
                        );
                    }
                }
            ],
            order: [[2, 'desc']],
            dom: '<"card-header flex-column flex-md-row border-bottom"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6 mt-5 mt-md-0"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            displayLength: 7,
            lengthMenu: [7, 10, 25, 50, 75, 100],
            buttons: [{
                    extend: 'collection',
                    className: 'btn btn-label-primary dropdown-toggle me-4 waves-effect waves-light',
                    text: '<i class="ri-external-link-line me-sm-1"></i> <span class="d-none d-sm-inline-block">Export</span>',
                    buttons: [{
                            extend: 'print',
                            text: '<i class="ri-printer-line me-1"></i>Print',
                            className: 'dropdown-item',
                            exportOptions: {
                                columns: [3, 4, 5, 6, 7],
                                format: {
                                    body: function(inner, coldex, rowdex) {
                                        if (inner.length <= 0) return inner;
                                        var el = $.parseHTML(inner);
                                        var result = '';
                                        $.each(el, function(index, item) {
                                            if (item.classList !== undefined && item.classList.contains('user-name')) {
                                                result = result + item.lastChild.textContent;
                                            } else if (item.innerText === undefined) {
                                                result = result + item.textContent;
                                            } else result = result + item.innerText;
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
                                columns: [3, 4, 5, 6, 7],
                                format: {
                                    body: function(inner, coldex, rowdex) {
                                        if (inner.length <= 0) return inner;
                                        var el = $.parseHTML(inner);
                                        var result = '';
                                        $.each(el, function(index, item) {
                                            if (item.classList !== undefined && item.classList.contains('user-name')) {
                                                result = result + item.lastChild.textContent;
                                            } else if (item.innerText === undefined) {
                                                result = result + item.textContent;
                                            } else result = result + item.innerText;
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
                                columns: [3, 4, 5, 6, 7],
                                format: {
                                    body: function(inner, coldex, rowdex) {
                                        if (inner.length <= 0) return inner;
                                        var el = $.parseHTML(inner);
                                        var result = '';
                                        $.each(el, function(index, item) {
                                            if (item.classList !== undefined && item.classList.contains('user-name')) {
                                                result = result + item.lastChild.textContent;
                                            } else if (item.innerText === undefined) {
                                                result = result + item.textContent;
                                            } else result = result + item.innerText;
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
                                columns: [3, 4, 5, 6, 7],
                                format: {
                                    body: function(inner, coldex, rowdex) {
                                        if (inner.length <= 0) return inner;
                                        var el = $.parseHTML(inner);
                                        var result = '';
                                        $.each(el, function(index, item) {
                                            if (item.classList !== undefined && item.classList.contains('user-name')) {
                                                result = result + item.lastChild.textContent;
                                            } else if (item.innerText === undefined) {
                                                result = result + item.textContent;
                                            } else result = result + item.innerText;
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
                                columns: [3, 4, 5, 6, 7],
                                format: {
                                    body: function(inner, coldex, rowdex) {
                                        if (inner.length <= 0) return inner;
                                        var el = $.parseHTML(inner);
                                        var result = '';
                                        $.each(el, function(index, item) {
                                            if (item.classList !== undefined && item.classList.contains('user-name')) {
                                                result = result + item.lastChild.textContent;
                                            } else if (item.innerText === undefined) {
                                                result = result + item.textContent;
                                            } else result = result + item.innerText;
                                        });
                                        return result;
                                    }
                                }
                            }
                        }
                    ]
                },
            ],
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function(row) {
                            var data = row.data();
                            return 'Details of ' + data['nama_siswa'];
                        }
                    }),
                    type: 'column',
                    renderer: function(api, rowIdx, columns) {
                        var data = $.map(columns, function(col, i) {
                            return col.title !== '' ?
                                '<tr data-dt-row="' + col.rowIndex + '" data-dt-column="' + col.columnIndex + '">' +
                                '<td>' + col.title + ':' + '</td> ' +
                                '<td>' + col.data + '</td>' +
                                '</tr>' : '';
                        }).join('');

                        return data ? $('<table class="table"/><tbody />').append(data) : false;
                    }
                }
            }
        });
           // Handle status update
           dt_basic_table.on('change', '.status-dropdown', function() {
            var status = $(this).val();
            var id = $(this).data('id');

            Swal.fire({
                title: 'Anda Yakin?',
                text: `Status siswa akan di perbaharui ke-${status}.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, update it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('calon_siswa.update_status') }}',
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: id,
                            status: status
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire(
                                    'Updated!',
                                    'The status has been updated successfully.',
                                    'success'
                                );
                                dt_basic.ajax.reload();
                            } else {
                                Swal.fire(
                                    'Error!',
                                    'There was an error updating the status.',
                                    'error'
                                );
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire(
                                'Error!',
                                'There was an error updating the status.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
        
        // View Details
        dt_basic_table.on('click', '.view-details', function() {
            var id = $(this).data('id');
            $.ajax({
                url: `/calon_siswa/${id}`,
                method: 'GET',
                success: function(data) {
                    $('#detailsModalLabel').text(`Details ${data.nama_siswa}`);
                    $('#modalNamaSiswa').text(data.nama_siswa);
                    $('#modalEmailSiswa').text(data.email);
                    $('#modalTanggalPendaftaran').text(data.tanggal_daftar);
                    $('#modalNomorHP').text(data.no_tlpn);
                    $('#modalAsalSekolah').text(data.asal_sekolah);
                    $('#modalStatus').text(data.status);
                    $('#modalFileRaport').attr('href', data.file_raport);
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        });
    
        // Delete Record
        dt_basic_table.on('click', '.delete-record', function() {
            var id = $(this).data('id');
            var url = $(this).data('url').replace(':id', id);

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
                                Swal.fire(
                                    'Deleted!',
                                    'Record has been deleted.',
                                    'success'
                                );
                                dt_basic.ajax.reload();
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
