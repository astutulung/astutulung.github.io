@extends('admin.layouts.app')

@section('content')
<div class="card mb-3">
    <div class="card-header">
        <h5 class="card-title">Manajemen Data Berita</h5>
    </div>
</div>
<div class="card">
    <div class="card-datatable table-responsive">
        <div class="add-new mb-2 text-end mt-2 me-2">
            <button class='btn btn-primary waves-effect waves-light' data-bs-toggle='modal' data-bs-target='#modalAddBerita'>
                <i class='ri-add-line me-0 me-sm-1 d-inline-block d-sm-none'></i>
                <span class='d-none d-sm-inline-block'>Add New Berita</span>
            </button>
        </div>
        <table id="dt_berita_table" class="datatables-berita table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul</th>
                    <th>Tanggal</th>
                    <th>Isi</th>
                    <th>Foto</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

{{-- Modal Add Berita --}}
<div class="modal fade" id="modalAddBerita" tabindex="-1" aria-labelledby="modalAddBeritaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddBeritaLabel">Add Berita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addNewBeritaForm" action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="add-berita-judul" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="add-berita-judul" name="judul" required>
                    </div>
                    <div class="mb-3">
                        <label for="add-berita-tanggal" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="add-berita-tanggal" name="tanggal" required>
                    </div>
                    <div class="mb-3">
                        <label for="add-berita-isi" class="form-label">Isi</label>
                        <textarea class="form-control" id="add-berita-isi" name="isi" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="add-berita-foto" class="form-label">Foto</label>
                        <input type="file" class="form-control" id="add-berita-foto" name="foto" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Modal Edit Berita --}}
<div class="modal fade" id="modalEditBerita" tabindex="-1" aria-labelledby="modalEditBeritaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditBeritaLabel">Edit Berita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editBeritaForm" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="edit-berita-judul" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="edit-berita-judul" name="judul" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-berita-tanggal" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="edit-berita-tanggal" name="tanggal" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-berita-isi" class="form-label">Isi</label>
                        <textarea class="form-control" id="edit-berita-isi" name="isi" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit-berita-foto" class="form-label">Foto</label>
                        <input type="file" class="form-control" id="edit-berita-foto" name="foto">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script>
    $(document).ready(function() {
        var table = $('#dt_berita_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('berita.data') }}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'judul', name: 'judul' },
                { data: 'tanggal', name: 'tanggal' },
                { data: 'isi', name: 'isi' },
                { data: 'foto', name: 'foto' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });

        // Edit Berita
        $('.datatables-berita tbody').on('click', '.edit-record', function() {
            var beritaId = $(this).data('id');
            var editUrl = $(this).data('url');

            $.ajax({
                url: editUrl,
                type: 'GET',
                success: function(response) {
                    $('#editBeritaForm').attr('action', `/berita/${response.id}`);
                    $('#edit-berita-judul').val(response.judul);
                    $('#edit-berita-tanggal').val(response.tanggal);
                    $('#edit-berita-isi').val(response.isi);

                    var modalEditBerita = new bootstrap.Modal(document.getElementById('modalEditBerita'));
                    modalEditBerita.show();
                },
                error: function(xhr, error, thrown) {
                    console.log(xhr.responseText);
                    alert('Error: ' + error + '\n' + 'Thrown: ' + thrown);
                }
            });
        });

        // Update Berita
        $('#editBeritaForm').on('submit', function(event) {
            event.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
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
                            window.location.href = '/berita';
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
                    var errorMessage = 'An error occurred while updating the berita.';
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

        // Add New Berita
        $('#addNewBeritaForm').on('submit', function(event) {
            event.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
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
                            window.location.href = '/berita';
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
                    var errorMessage = 'An error occurred while creating the berita.';
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

        // Delete Berita
        $('.datatables-berita tbody').on('click', '.delete-record', function() {
            var beritaId = $(this).data('id');
            var deleteUrl = $(this).data('url');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                customClass: {
                    confirmButton: 'btn btn-danger',
                    cancelButton: 'btn btn-secondary'
                },
                buttonsStyling: false
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
                                    table.ajax.reload();
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
                            var errorMessage = 'An error occurred while deleting the berita.';
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
