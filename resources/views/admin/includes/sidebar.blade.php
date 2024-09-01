<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo d-flex align-items-center justify-content-between">
        <!-- Logo dengan Ikon Sekolah dan Teks PANEL ADMIN -->
        <a href="javascript:void(0);" class="d-flex align-items-center">
            <i class="ri-government-fill ri-32px text-primary"></i>
            <span class="ms-2 h5 text-primary mb-0">PANEL ADMIN</span>
        </a>

        <!-- Menu Toggle Icon -->
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M8.47365 11.7183C8.11707 12.0749 8.11707 12.6531 8.47365 13.0097L12.071 16.607C12.4615 16.9975 12.4615 17.6305 12.071 18.021C11.6805 18.4115 11.0475 18.4115 10.657 18.021L5.83009 13.1941C5.37164 12.7356 5.37164 11.9924 5.83009 11.5339L10.657 6.707C11.0475 6.31653 11.6805 6.31653 12.071 6.707C12.4615 7.09747 12.4615 7.73053 12.071 8.121L8.47365 11.7183Z"
                    fill-opacity="0.9" />
                <path
                    d="M14.3584 11.8336C14.0654 12.1266 14.0654 12.6014 14.3584 12.8944L18.071 16.607C18.4615 16.9975 18.4615 17.6305 18.071 18.021C17.6805 18.4115 17.0475 18.4115 16.657 18.021L11.6819 13.0459C11.3053 12.6693 11.3053 12.0587 11.6819 11.6821L16.657 6.707C17.0475 6.31653 17.6805 6.31653 18.071 6.707C18.4615 7.09747 18.4615 7.73053 18.071 8.121L14.3584 11.8336Z"
                    fill-opacity="0.4" />
            </svg>
        </a>
    </div>


    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item {{ Route::is('dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons ri-home-smile-line"></i>
                <div data-i18n="Dashboards">Dashboards</div>
            </a>
            <ul class="menu-sub">
                @if (Auth::user()->role == 'admin')
                    <li class="menu-item {{ Route::is('dashboard') ? 'active' : '' }}">
                        <a href="{{ route('dashboard') }}" class="menu-link">
                            <div>Admin Dashboard</div>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->role == 'panitia')
                    <li class="menu-item {{ Route::is('dashboard') ? 'active' : '' }}">
                        <a href="{{ route('dashboard') }}" class="menu-link">
                            <div>Panitia Dashboard</div>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->role == 'siswa')
                    <li class="menu-item {{ Route::is('dashboard') ? 'active' : '' }}">
                        <a href="{{ route('dashboard') }}" class="menu-link">
                            <div>Siswa Dashboard</div>
                        </a>
                    </li>
                @endif
            </ul>
        </li>
        <!-- Apps & Pages -->
        @if (auth()->user()->role !== 'siswa')
            <li class="menu-header mt-5">
                <span class="menu-header-text">Manajemen Data</span>
            </li>
        @endif

        {{-- Admin Area --}}
        @if (auth()->user()->role === 'admin')
            <li class="menu-item {{ request()->get('role') == 'admin' ? 'active' : '' }}">
                <a href="{{ route('user', ['role' => 'admin']) }}" class="menu-link">
                    <i class="menu-icon tf-icons ri-admin-line"></i>
                    <div>Data Admin</div>
                </a>
            </li>
            <li class="menu-item {{ request()->get('role') == 'panitia' ? 'active' : '' }}">
                <a href="{{ route('user', ['role' => 'panitia']) }}" class="menu-link">
                    <i class="menu-icon tf-icons ri-group-line"></i>
                    <div>Data Panitia</div>
                </a>
            </li>
            <li class="menu-item {{ Route::is('jurusan.index') ? 'active' : '' }}">
                <a href="{{ route('jurusan.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons ri-dashboard-fill"></i>
                    <div>Data Jurusan</div>
                </a>
            </li>
            <li class="menu-item {{ Route::is('berita.index') ? 'active' : '' }}">
                <a href="{{ route('berita.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons ri-news-line"></i>
                    <div>Data Berita</div>
                </a>
            </li>
        @endif



        {{-- Panitia Area --}}
        @if (auth()->user()->role === 'panitia')
            <li class="menu-item {{ Route::is('calonsiswa.index') ? 'active' : '' }}">
                <a href="{{ route('calonsiswa.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons ri-user-2-line"></i>
                    <div>Data Calon Siswa</div>
                </a>
            </li>
            <li class="menu-item {{ Route::is('pengumuman.index') ? 'active' : '' }}">
                <a href="{{ route('pengumuman.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons ri-newspaper-line"></i>
                    <div>Daftar Pengumuman</div>
                </a>
            </li>
            <li class="menu-item {{ Route::is('data_registrasi.index') ? 'active' : '' }}">
                <a href="{{ route('data_registrasi.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons ri-contacts-book-2-line"></i>
                    <div>Daftar Registrasi Siswa</div>
                </a>
            </li>
        @endif

        {{-- Siswa Area --}}
        @if (auth()->user()->role === 'siswa')
            <li class="menu-item {{ Route::is('pendaftaran.index') ? 'active' : '' }}">
                <a href="{{ route('pendaftaran.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons ri-edit-line"></i>
                    <div>Pendaftaran</div>
                </a>
            </li>
            <li class="menu-item {{ Route::is('pengumumansiswa.show') ? 'active' : '' }}">
                <a href="{{ route('pengumumansiswa.show') }}" class="menu-link">
                    <i class="menu-icon tf-icons ri-information-line"></i>
                    <div>Informasi Calon Siswa</div>
                </a>
            </li>
            <li class="menu-item {{ Route::is('profile.index') ? 'active' : '' }}">
                <a href="{{ route('profile.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons ri-user-line"></i>
                    <div>Profile</div>
                </a>
            </li>
        @endif
    </ul>

</aside>

@push('js')
    <script>
        $('.menu-item a').on('click', function() {
            var role = $(this).find('i.menu-icon').hasClass('ri-group-line') ? 'panitia' : 'admin';
            $('#filter-role').val(role).trigger('change');
            $('.datatables-users').DataTable().draw();
        });
    </script>
@endpush
