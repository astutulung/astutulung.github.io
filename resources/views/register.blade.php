<!doctype html>
<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="../../assets/" data-template="vertical-menu-template" data-style="light">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>{{ $title }} - SMAN 1 SANO NGGOANG</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{  asset('assets_backend/img/logo.jpeg') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap"
        rel="stylesheet" />

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
    <!-- Vendor -->
    <link rel="stylesheet" href="{{ asset('assets_backend/vendor/libs/@form-validation/form-validation.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets_backend/vendor/libs/sweetalert2/sweetalert2.css') }}" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets_backend/vendor/css/pages/page-auth.css') }}" />

    <!-- Helpers -->
    <script src="{{ asset('assets_backend/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{ asset('assets_backend/vendor/js/template-customizer.js') }}"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets_backend/js/config.js') }}"></script>
</head>

<body>
    <!-- Content -->

    <div class="position-relative">
        <div class="authentication-wrapper authentication-basic container-p-y p-4 p-sm-0">
            <div class="authentication-inner py-6">
                <!-- Register -->
                <div class="card p-md-7 p-1">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center mt-5">
                        <a href="index.html" class="app-brand-link gap-2">
                            <span class="app-brand-logo demo">
                                <h1>Register</h1>
                            </span>
                        </a>
                    </div>
                    <!-- /Logo -->

                    <div class="card-body mt-1">
                        <h4 class="mb-1">Create a new account</h4>
                        <p class="mb-5 text-center">Fill the form below to create a new account</p>

                        @include('sweetalert::alert')

                        <form id="formRegistration" class="mb-5" action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="form-floating form-floating-outline mb-5">
                                <input type="text" class="form-control" id="nama" name="nama"
                                    placeholder="Enter your full name" required />
                                <label for="nama">Full Name</label>
                            </div>
                            <div class="form-floating form-floating-outline mb-5">
                                <select id="jk" class="form-select" name="jk" required>
                                    <option value="" disabled selected>Select Gender</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                                <label for="jk">Gender</label>
                            </div>
                            <div class="form-floating form-floating-outline mb-5">
                                <input type="text" class="form-control" id="no_tlpn" name="no_tlpn"
                                    placeholder="Enter your phone number" required />
                                <label for="no_tlpn">Phone Number</label>
                            </div>
                            <div class="form-floating form-floating-outline mb-5">
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Enter your email" required />
                                <label for="email">Email</label>
                            </div>
                            <div class="mb-5">
                                <div class="form-password-toggle">
                                <div class="mb-2">
                                <span class="text-danger" style="font-size: 12px;">*Password Minimal 8 Karakter</span>
                                </div>
                                    <div class="input-group input-group-merge">
                                        <div class="form-floating form-floating-outline">
                                            <input type="password" id="password" class="form-control" name="password"
                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                aria-describedby="password" required />
                                            <label for="password">Password</label>
                                        </div>
                                        <span class="input-group-text cursor-pointer"><i
                                                class="ri-eye-off-line"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-floating form-floating-outline mb-5">
                                <input type="password" id="password_confirmation" class="form-control" name="password_confirmation"
                                    placeholder="Confirm your password" required />
                                <label for="password_confirmation">Confirm Password</label>
                            </div>
                            <div class="mb-5">
                                <button class="btn btn-primary d-grid w-100" type="submit">Register</button>
                            </div>
                        </form>
                        <div class="text-center">
                            <p>Already have an account? <a href="{{ route('login') }}" class="btn btn-link">Login</a></p>
                        </div>
                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>
    </div>

    <!-- / Content -->

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
    <script src="{{ asset('assets_backend/vendor/libs/@form-validation/popular.js') }}"></script>
    <script src="{{ asset('assets_backend/vendor/libs/@form-validation/bootstrap5.js') }}"></script>
    <script src="{{ asset('assets_backend/vendor/libs/@form-validation/auto-focus.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets_backend/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('assets_backend/js/pages-auth.js') }}"></script>

    <script src="{{ asset('assets_backend/js/extended-ui-sweetalert2.js') }}"></script>
</body>

</html>
