<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ $title}} - SMAN 1 SANO NGGOANG</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{  asset('assets_frontend/img/logo.jpeg') }}" />

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('assets_frontend/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('assets_frontend/css/style.css') }}" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->

    <!-- Topbar End -->


    <!-- Navbar Start -->
    @include('frontend.includes.navbar')
    <!-- Navbar End -->

    @yield('content')

    <!-- Footer Start -->
    @include('frontend.includes.footer')
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets_frontend/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('assets_frontend/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Contact Javascript File -->
    <script src="{{ asset('assets_frontend/mail/jqBootstrapValidation.min.js') }}"></script>
    <script src="{{ asset('assets_frontend/mail/contact.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('assets_frontend/js/main.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('a.cat-overlay').click(function(event) {
                event.preventDefault();
            });

            $('#beritaModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
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
</body>

</html>
