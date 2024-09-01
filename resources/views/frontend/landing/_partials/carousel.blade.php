
    <!-- Carousel Start -->
    <div class="container-fluid p-0 pb-5 mb-5">
        <div id="header-carousel" class="carousel slide carousel-fade" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#header-carousel" data-slide-to="0" class="active"></li>
                <li data-target="#header-carousel" data-slide-to="1"></li>
                <li data-target="#header-carousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active" style="min-height: 300px;">
                    <img class="position-relative w-100" src="{{ asset('assets_frontend/img/banner1.jpg') }}" style="min-height: 300px; object-fit: cover;">
                    <div class="carousel-caption d-flex align-items-center justify-content-center">
                        <div class="p-5" style="width: 100%; max-width: 900px;">
                            <h5 class="text-white text-uppercase mb-md-3">SMA Negeri 1 Sano Nggoang</h5>
                            <h1 class="display-3 text-white mb-md-4">Membangun Generasi Berprestasi</h1>
                            <a href="{{ route('login') }}" class="btn btn-primary py-md-2 px-md-4 font-weight-semi-bold mt-2">Daftar Sekarang</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item" style="min-height: 300px;">
                    <img class="position-relative w-100" src="{{ asset('assets_frontend/img/banner2.jpg') }}" style="min-height: 300px; object-fit: cover;">
                    <div class="carousel-caption d-flex align-items-center justify-content-center">
                        <div class="p-5" style="width: 100%; max-width: 900px;">
                            <h5 class="text-white text-uppercase mb-md-3">Pendidikan Berkualitas</h5>
                            <h1 class="display-3 text-white mb-md-4">Menuju Masa Depan Cerah</h1>
                            <a href="{{ route('login') }}" class="btn btn-primary py-md-2 px-md-4 font-weight-semi-bold mt-2">Daftar Sekarang</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item" style="min-height: 300px;">
                    <img class="position-relative w-100" src="{{ asset('assets_frontend/img/banner3.jpg') }}" style="min-height: 300px; object-fit: cover;">
                    <div class="carousel-caption d-flex align-items-center justify-content-center">
                        <div class="p-5" style="width: 100%; max-width: 900px;">
                            <h5 class="text-white text-uppercase mb-md-3">Sekolah Terbaik di NTT</h5>
                            <h1 class="display-3 text-white mb-md-4">Membangun Karakter dan Kecerdasan</h1>
                            <a href="{{ route('login') }}" class="btn btn-primary py-md-2 px-md-4 font-weight-semi-bold mt-2">Daftar Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>