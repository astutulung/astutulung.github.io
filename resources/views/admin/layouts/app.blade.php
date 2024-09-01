<!doctype html>

<html class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default"
    data-assets-path="../../assets/" data-template="vertical-menu-template" data-style="light">
<meta charset="utf-8" />
<meta name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

<title>{{ $title }}</title>

<meta name="description" content="" />

<!-- Favicon -->
<link rel="icon" type="image/x-icon" href="{{  asset('assets_backend/img/logo.jpeg') }}" />

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap" rel="stylesheet" />

<!-- Icons -->
<link rel="stylesheet" href="{{ asset('assets_backend/vendor/fonts/remixicon/remixicon.css') }}" />
<link rel="stylesheet" href="{{ asset('assets_backend/vendor/fonts/flag-icons.css') }}" />

<!-- Menu waves for no-customizer fix -->
<link rel="stylesheet" href="{{ asset('assets_backend/vendor/libs/node-waves/node-waves.css') }}" />

<!-- Core CSS -->
<link rel="stylesheet" href="{{ asset('assets_backend/vendor/css/rtl/core.css') }}" />
<link rel="stylesheet" href="{{ asset('assets_backend/vendor/css/rtl/theme-default.css') }}" />
<link rel="stylesheet" href="{{ asset('assets_backend/css/demo.css') }}" />

<!-- Vendors CSS -->
<link rel="stylesheet" href="{{ asset('assets_backend/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
<link rel="stylesheet" href="{{ asset('assets_backend/vendor/libs/typeahead-js/typeahead.css') }}" />
<link rel="stylesheet" href="{{ asset('assets_backend/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
<link rel="stylesheet" href="{{ asset('assets_backend/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
<link rel="stylesheet" href="{{ asset('assets_backend/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}" />
<link rel="stylesheet" href="{{ asset('assets_backend/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}" />
<link rel="stylesheet" href="{{ asset('assets_backend/vendor/libs/select2/select2.css') }}" />
<link rel="stylesheet" href="{{ asset('assets_backend/vendor/libs/@form-validation/form-validation.css') }}" />
<link rel="stylesheet" href="{{ asset('assets_backend/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
<link rel="stylesheet" href="{{ asset('assets_backend/vendor/libs/animate-css/animate.css') }}" />
<link rel="stylesheet" href="{{ asset('assets_backend/vendor/libs/sweetalert2/sweetalert2.css') }}" />

<!-- Page CSS -->

<!-- Helpers -->
<script src="{{ asset('assets_backend/vendor/js/helpers.js') }}"></script>
<!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
<!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
<script src="{{ asset('assets_backend/vendor/js/template-customizer.js') }}"></script>
<!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
<script src="{{ asset('assets_backend/js/config.js') }}"></script>
@stack('css')
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
           
            <!-- Menu -->
            @include('admin.includes.sidebar')
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                @include('admin.includes.navbar')

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        @yield('content')
                        @include('sweetalert::alert')
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    @include('admin.includes.footer')
                    <!-- / Footer -->
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('assets_backend/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets_backend/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets_backend/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets_backend/vendor/libs/node-waves/node-waves.js') }}"></script>
    <script src="{{ asset('assets_backend/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets_backend/vendor/libs/hammer/hammer.js') }}"></script>
    <script src="{{ asset('assets_backend/vendor/libs/i18n/i18n.js') }}"></script>
    <script src="{{ asset('assets_backend/vendor/libs/typeahead-js/typeahead.js') }}"></script>
    <script src="{{ asset('assets_backend/vendor/js/menu.js') }}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('assets_backend/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets_backend/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('assets_backend/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets_backend/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
    <script src="{{ asset('assets_backend/vendor/libs/@form-validation/popular.js') }}"></script>
    <script src="{{ asset('assets_backend/vendor/libs/@form-validation/bootstrap5.js') }}"></script>
    <script src="{{ asset('assets_backend/vendor/libs/@form-validation/auto-focus.js') }}"></script>
    <script src="{{ asset('assets_backend/vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('assets_backend/vendor/libs/cleavejs/cleave-phone.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets_backend/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('assets_backend/js/app-user-list.js') }}"></script>
    <script src="{{ asset('assets_backend/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('assets_backend/js/tables-datatables-basic.js') }}"></script>
    @stack('js')
</body>

</html>
