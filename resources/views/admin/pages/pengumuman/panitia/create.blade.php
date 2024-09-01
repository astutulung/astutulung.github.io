@extends('admin.layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Buat Pengumuman</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('pengumuman.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="judul_pengumuman">Judul Pengumuman</label>
                        <input type="text" name="judul_pengumuman" class="form-control" id="judul_pengumuman" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi Pengumuman</label>
                        <textarea name="deskripsi" class="form-control" id="deskripsi" rows="4" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="status">Status Pengumuman</label>
                        <select name="status" class="form-control" id="status" required>
                            <option value="" disabled selected>Pilih Status</option>
                            <option value="terima">Terima</option>
                            <option value="tolak">Tolak</option>
                        </select>
                    </div>                 
                    <div class="form-group">
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
                    <div class="form-group" id="specific_students" style="display: none;">
                        <label for="siswa">Pilih Siswa yang Menerima</label>
                        <select name="siswa[]" id="siswa" class="form-control" multiple>
                            @foreach($siswaList as $siswa)
                                <option value="{{ $siswa->id }}">{{ $siswa->nama_siswa }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Kirim Pengumuman</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const broadcastSpecificRadio = document.getElementById('broadcast_specific');
        const specificStudentsDiv = document.getElementById('specific_students');
        const broadcastAllRadio = document.getElementById('broadcast_all');

        broadcastSpecificRadio.addEventListener('change', function () {
            if (this.checked) {
                specificStudentsDiv.style.display = 'block';
            }
        });

        broadcastAllRadio.addEventListener('change', function () {
            if (this.checked) {
                specificStudentsDiv.style.display = 'none';
            }
        });
    });
</script>
@endpush
@endsection

