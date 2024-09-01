<div class="container-fluid">
    <div class="row border-top px-xl-5">
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                <a href="" class="text-decoration-none d-block d-lg-none">
                    <h1 class="m-0"><span class="text-primary">E</span>COURSES</h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav py-0">
                        <a href="{{ route('index') }}" class="nav-item nav-link {{ Request::is('/') ? 'active' : '' }}">Home</a>
                        <a href="{{ route('about') }}" class="nav-item nav-link {{ Request::is('about') ? 'active' : '' }}">Tentang Kami</a>
                        <a href="{{ route('course') }}" class="nav-item nav-link {{ Request::is('course') ? 'active' : '' }}">Jurusan</a>
                        <a href="{{ route('blog') }}" class="nav-item nav-link {{ Request::is('blog') ? 'active' : '' }}">Berita</a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
