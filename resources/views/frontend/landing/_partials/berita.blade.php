<!-- Category Start -->
<div class="container-fluid py-5">
    <div class="container pt-5 pb-3">
        <div class="text-center mb-5">
            <h5 class="text-primary text-uppercase mb-3" style="letter-spacing: 5px;">Berita</h5>
            <h1>Daftar Berita</h1>
        </div>
        <div class="row">
            @foreach($beritas as $berita)
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="cat-item position-relative overflow-hidden rounded mb-2">
                        <img class="img-fluid berita-image" src="{{ asset('storage/' . $berita->foto) }}" alt="{{ $berita->judul }}" 
                             data-toggle="modal" data-target="#beritaModal" 
                             data-judul="{{ $berita->judul }}" 
                             data-tanggal="{{ \Carbon\Carbon::parse($berita->tanggal)->format('d M Y') }}" 
                             data-isi="{{ $berita->isi }}" 
                             data-foto="{{ asset('storage/' . $berita->foto) }}">
                        <a class="cat-overlay text-white text-decoration-none" href="#"
                            data-toggle="modal" data-target="#beritaModal"
                            data-judul="{{ $berita->judul }}" 
                            data-tanggal="{{ \Carbon\Carbon::parse($berita->tanggal)->format('d M Y') }}" 
                            data-isi="{{ $berita->isi }}" 
                            data-foto="{{ asset('storage/' . $berita->foto) }}">
                            <h4 class="text-white font-weight-medium">{{ $berita->judul }}</h4>
                            <span>{{ \Carbon\Carbon::parse($berita->tanggal)->format('d M Y') }}</span>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Category End -->

<!-- Modal Start -->
<div class="modal fade" id="beritaModal" tabindex="-1" role="dialog" aria-labelledby="beritaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content rounded-0">
            <div class="modal-body py-0">
                <div class="d-block main-content">
                    <img id="modal-foto" src="" alt="Image" class="img-fluid" style="background-color: #b2fcff;">
                    <div class="content-text p-4">
                        <h3 id="modal-judul" class="mb-4"></h3>
                        <p id="modal-tanggal" class="mb-4"></p>
                        <p id="modal-isi" class="mb-4"></p>
                        <div class="d-flex">
                            <div class="ml-auto">
                                <a href="#" class="btn btn-link" data-dismiss="modal">Close</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal End -->

@push('js')
<script>
    $(document).ready(function() {
        // Prevent default action for the anchor tag
        $('a.cat-overlay').click(function(event) {
            event.preventDefault();
        });

        $('#beritaModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Element that triggered the modal
            var judul = button.data('judul');
            var tanggal = button.data('tanggal');
            var isi = button.data('isi');
            var foto = button.data('foto');

            var modal = $(this);
            modal.find('#modal-judul').text(judul);
            modal.find('#modal-tanggal').text(tanggal);
            modal.find('#modal-isi').text(isi);
            modal.find('#modal-foto').attr('src', foto);
        });
    });
</script>
@endpush
