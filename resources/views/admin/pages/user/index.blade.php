@extends('admin.layouts.app')

@section('content')
    <div class="card mb-3">
        <div class="card-header">
            <h5 class="card-title">Filters</h5>
        </div>
        <div class="card-body">
            <div class="row">           
                <div class="col-md-6">
                    <label for="filter-gender" class="form-label">Filter by Gender</label>
                    <select id="filter-gender" class="form-select">
                        <option value="">All Genders</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-datatable table-responsive">
            <div class="add-new mb-2 text-end mt-2 me-2"></div>
            <table id="dt_user_table" class="datatables-users table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Gender</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
    {{-- Offcanvas Add --}}
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser" aria-labelledby="offcanvasAddUserLabel">
        <div class="offcanvas-header border-bottom">
            <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add User</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body mx-0 flex-grow-0 h-100">
            <form class="add-new-user pt-0" id="addNewUserForm" action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="form-floating form-floating-outline mb-5">
                    <input type="text" class="form-control" id="add-user-nama" placeholder="John Doe" name="nama"
                        aria-label="John Doe" />
                    <label for="add-user-nama">Full Name</label>
                </div>
                <div class="form-floating form-floating-outline mb-5">
                    <select id="add-user-jk" class="form-select" name="jk">
                        <option value="">Select Gender</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                    <label for="add-user-jk">Gender</label>
                </div>
                <div class="form-floating form-floating-outline mb-5">
                    <input type="text" id="add-user-no_tlpn" class="form-control phone-mask"
                        placeholder="+1 (609) 988-44-11" aria-label="Phone Number" name="no_tlpn" />
                    <label for="add-user-no_tlpn">Contact</label>
                </div>
                <div class="form-floating form-floating-outline mb-5">
                    <input type="text" id="add-user-email" class="form-control" placeholder="john.doe@example.com"
                        aria-label="Email" name="email" />
                    <label for="add-user-email">Email</label>
                </div>
                <div class="form-floating form-floating-outline mb-5">
                    <input type="password" id="add-user-password" class="form-control" placeholder="Password"
                        aria-label="Password" name="password" />
                    <label for="add-user-password">Password</label>
                </div>
                <div class="form-floating form-floating-outline mb-5">
                    <select id="add-user-role" class="form-select" name="role">
                        @if (auth()->user()->role == 'admin')
                            <option value="admin">Admin</option>
                            <option value="panitia">Panitia</option>
                        @elseif (auth()->user()->role == 'panitia')
                            <option value="panitia">Panitia</option>
                            <option value="siswa">Siswa</option>
                        @endif
                    </select>
                    <label for="add-user-role">Role</label>
                </div>
                <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button>
                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>
            </form>
        </div>
    </div>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEditUser"
            aria-labelledby="offcanvasEditUserLabel">
            <div class="offcanvas-header border-bottom">
                <h5 id="offcanvasEditUserLabel" class="offcanvas-title">Edit User</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body mx-0 flex-grow-0 h-100">
                <form class="edit-user-form pt-0" id="editUserForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-floating form-floating-outline mb-5">
                        <input type="text" class="form-control" id="edit-user-nama" placeholder="John Doe"
                            name="nama" aria-label="John Doe" />
                        <label for="edit-user-nama">Full Name</label>
                    </div>
                    <div class="form-floating form-floating-outline mb-5">
                        <select id="edit-user-jk" class="form-select" name="jk">
                            <option value="">Select Gender</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        <label for="edit-user-jk">Gender</label>
                    </div>
                    <div class="form-floating form-floating-outline mb-5">
                        <input type="text" id="edit-user-no_tlpn" class="form-control phone-mask"
                            placeholder="+1 (609) 988-44-11" aria-label="Phone Number" name="no_tlpn" />
                        <label for="edit-user-no_tlpn">Contact</label>
                    </div>
                    <div class="form-floating form-floating-outline mb-5">
                        <input type="text" id="edit-user-email" class="form-control"
                            placeholder="john.doe@example.com" aria-label="Email" name="email" />
                        <label for="edit-user-email">Email</label>
                    </div>
                    <div class="form-floating form-floating-outline mb-5">
                        <input type="password" id="edit-user-password" class="form-control" placeholder="Password"
                            aria-label="Password" name="password" />
                        <label for="edit-user-password">Password</label>
                    </div>
                    <div class="form-floating form-floating-outline mb-5">
                        <select id="edit-user-role" class="form-select" name="role">
                            @if (auth()->user()->role == 'admin')
                                <option value="admin">Admin</option>
                                <option value="panitia">Panitia</option>
                            @elseif (auth()->user()->role == 'panitia')
                                <option value="panitia">Panitia</option>
                                <option value="siswa">Siswa</option>
                            @endif
                        </select>
                        <label for="edit-user-role">Role</label>
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
        var role = '{{ request('role') }}'; 

        var table = $('#dt_user_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route('users.data') }}',
                data: function(d) {
                    d.role = role;
                    d.gender = $('#filter-gender').val();
                }
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'nama', name: 'nama' },
                { data: 'jk', name: 'jk' },
                { data: 'no_tlpn', name: 'no_tlpn' },
                { data: 'email', name: 'email' },
                { data: 'role', name: 'role' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
            dom: '<"d-flex justify-content-between ms-2"<"dt-action-buttons text-start ms-2"B><"head-label text-center ms-2">>t<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>rt<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            displayLength: 7,
            lengthMenu: [7, 10, 25, 50, 75, 100],
            buttons: [
                {
                    extend: 'collection',
                    className: 'btn btn-label-primary dropdown-toggle me-4 waves-effect waves-light',
                    text: '<i class="ri-external-link-line me-sm-1"></i> <span class="d-none d-sm-inline-block">Export</span>',
                    buttons: [
                        {
                            extend: 'print',
                            text: '<i class="ri-printer-line me-1" ></i>Print',
                            className: 'dropdown-item',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5],
                                format: {
                                    body: function (inner, coldex, rowdex) {
                                        if (inner.length <= 0) return inner;
                                        var el = $.parseHTML(inner);
                                        var result = '';
                                        $.each(el, function (index, item) {
                                            if (item.classList !== undefined && item.classList.contains('user-name')) {
                                                result = result + item.lastChild.firstChild.textContent;
                                            } else if (item.innerText === undefined) {
                                                result = result + item.textContent;
                                            } else result = result + item.innerText;
                                        });
                                        return result;
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
                            text: '<i class="ri-file-text-line me-1" ></i>Csv',
                            className: 'dropdown-item',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5],
                                format: {
                                    body: function (inner, coldex, rowdex) {
                                        if (inner.length <= 0) return inner;
                                        var el = $.parseHTML(inner);
                                        var result = '';
                                        $.each(el, function (index, item) {
                                            if (item.classList !== undefined && item.classList.contains('user-name')) {
                                                result = result + item.lastChild.firstChild.textContent;
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
                                columns: [1, 2, 3, 4, 5],
                                format: {
                                    body: function (inner, coldex, rowdex) {
                                        if (inner.length <= 0) return inner;
                                        var el = $.parseHTML(inner);
                                        var result = '';
                                        $.each(el, function (index, item) {
                                            if (item.classList !== undefined && item.classList.contains('user-name')) {
                                                result = result + item.lastChild.firstChild.textContent;
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
                                columns: [1, 2, 3, 4, 5],
                                format: {
                                    body: function (inner, coldex, rowdex) {
                                        if (inner.length <= 0) return inner;
                                        var el = $.parseHTML(inner);
                                        var result = '';
                                        $.each(el, function (index, item) {
                                            if (item.classList !== undefined && item.classList.contains('user-name')) {
                                                result = result + item.lastChild.firstChild.textContent;
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
                            text: '<i class="ri-file-copy-line me-1" ></i>Copy',
                            className: 'dropdown-item',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5],
                                format: {
                                    body: function (inner, coldex, rowdex) {
                                        if (inner.length <= 0) return inner;
                                        var el = $.parseHTML(inner);
                                        var result = '';
                                        $.each(el, function (index, item) {
                                            if (item.classList !== undefined && item.classList.contains('user-name')) {
                                                result = result + item.lastChild.firstChild.textContent;
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
                }
            ]
        });

        $('#filter-gender').change(function() {
            table.draw();
        });

        // Edit User
        $('.datatables-users tbody').on('click', '.edit-record', function() {
            var userId = $(this).data('id');
            var editUrl = $(this).data('url');

            $.ajax({
                url: editUrl,
                type: 'GET',
                success: function(response) {
                    $('#editUserForm').attr('action', `/user/${response.id}`);
                    $('#edit-user-nama').val(response.nama);
                    $('#edit-user-jk').val(response.jk);
                    $('#edit-user-no_tlpn').val(response.no_tlpn);
                    $('#edit-user-email').val(response.email);
                    $('#edit-user-role').val(response.role);

                    var offcanvasEditUser = new bootstrap.Offcanvas(document.getElementById('offcanvasEditUser'));
                    offcanvasEditUser.show();
                },
                error: function(xhr, error, thrown) {
                    console.log(xhr.responseText);
                    alert('Error: ' + error + '\n' + 'Thrown: ' + thrown);
                }
            });
        });

        $('#editUserForm').on('submit', function(event) {
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
                            window.location.href = '/user';
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
                    var errorMessage = 'An error occurred while updating the user.';
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

        // Delete User
        $('.datatables-users tbody').on('click', '.delete-record', function() {
            var userId = $(this).data('id');
            var deleteUrl = $(this).data('url');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                customClass: {
                    confirmButton: 'btn btn-primary waves-effect waves-light',
                    cancelButton: 'btn btn-outline-secondary waves-effect'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: deleteUrl,
                        method: 'DELETE',
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
                                    table.ajax.reload(null, false);
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
                            var errorMessage = 'An error occurred while deleting the user.';
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
    });
</script>


@endpush
