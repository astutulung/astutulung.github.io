<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
            <i class="ri-menu-fill ri-22px"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <!-- Gambar Navbar -->
                        <img src="
                            @if(Auth::user()->role == 'siswa')
                                {{ asset('assets_backend/img/avatars/5.png') }}
                            @elseif(Auth::user()->role == 'panitia')
                                {{ asset('assets_backend/img/avatars/3.png') }}
                            @elseif(Auth::user()->role == 'admin')
                                {{ asset('assets_backend/img/avatars/1.png') }}
                            @endif
                        " alt class="rounded-circle" />
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="#">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-2">
                                    <div class="avatar avatar-online">
                                        <!-- Gambar Menu Dropdown -->
                                        <img src="
                                            @if(Auth::user()->role == 'siswa')
                                                {{ asset('assets_backend/img/avatars/5.png') }}
                                            @elseif(Auth::user()->role == 'panitia')
                                                {{ asset('assets_backend/img/avatars/3.png') }}
                                            @elseif(Auth::user()->role == 'admin')
                                                {{ asset('assets_backend/img/avatars/1.png') }}
                                            @endif
                                        " alt class="rounded-circle" />
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="fw-medium d-block small">{{ Auth::user()->nama }}</span>
                                    <small class="text-muted">
                                        @if(Auth::user()->role == 'admin')
                                            Admin
                                        @elseif(Auth::user()->role == 'panitia')
                                            Panitia
                                        @elseif(Auth::user()->role == 'siswa')
                                            Siswa
                                        @endif
                                    </small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    @if(Auth::user()->role == 'siswa')
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.index') }}">
                                <i class="ri-user-3-line ri-22px me-3"></i><span class="align-middle">My Profile</span>
                            </a>
                        </li>
                    @endif
                    <div class="d-grid px-4 pt-2 pb-1">
                        <a class="btn btn-sm btn-danger d-flex" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <small class="align-middle">Logout</small>
                            <i class="ri-logout-box-r-line ms-2 ri-16px"></i>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </ul>
            </li>
            <!--/ User -->
        </ul>
        
    </div>
</nav>
