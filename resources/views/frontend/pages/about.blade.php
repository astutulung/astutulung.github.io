@extends('frontend.layouts.master')
@section('content')
    <div class="container-fluid page-header" style="margin-bottom: 90px;">
        <div class="container">
            <div class="d-flex flex-column justify-content-center" style="min-height: 300px">
                <h3 class="display-4 text-white text-uppercase">About</h3>
                <div class="d-inline-flex text-white">
                    <p class="m-0 text-uppercase"><a class="text-white" href="{{ route('index') }}">Home</a></p>
                    <i class="fa fa-angle-double-right pt-1 px-3"></i>
                    <p class="m-0 text-uppercase">About</p>
                </div>
            </div>
        </div>
    </div>

    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <img class="img-fluid rounded mb-4 mb-lg-0" src="{{ asset('assets_frontend/img/banner2.jpg') }}"
                        alt="">
                </div>
                <div class="col-lg-7">
                    <div class="text-left mb-4">
                        <h5 class="text-primary text-uppercase mb-3" style="letter-spacing: 5px;">Visi dan Misi</h5>
                        <h1>Menyiapkan Generasi Berkarakter dan Berprestasi</h1>
                    </div>
                    <p><strong>Visi:</br></strong> Mewujudkan SMAN 1 Sano Nggoang sebagai lembaga pendidikan unggulan yang
                        berkarakter, berprestasi, dan berdaya saing tinggi, dengan menanamkan nilai-nilai kearifan lokal dan
                        global.</p>
                    <p><strong>Misi:</strong>
                    <ul>
                        <li>Menyelenggarakan pendidikan yang berkualitas dan berorientasi pada pengembangan karakter peserta
                            didik.</li>
                        <li>Meningkatkan prestasi akademik dan non-akademik siswa melalui pembelajaran yang inovatif dan
                            kreatif.</li>
                        <li>Memfasilitasi kegiatan ekstrakurikuler yang dapat menggali potensi dan bakat siswa.</li>
                        <li>Menumbuhkan kesadaran lingkungan dan cinta tanah air melalui program-program kepedulian sosial
                            dan budaya.</li>
                        <li>Membangun kerja sama yang harmonis antara sekolah, orang tua, dan masyarakat untuk mendukung
                            perkembangan siswa.</li>
                    </ul>
                    </p>
                    <a href="{{ route('login') }}" class="btn btn-primary py-md-2 px-md-4 font-weight-semi-bold mt-2">Daftar
                        Sekarang</a>
                </div>

            </div>
        </div>
    </div>
    <!-- About End -->
@endsection
