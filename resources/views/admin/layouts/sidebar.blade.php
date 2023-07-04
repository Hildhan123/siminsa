<div class="container-fluid">
    <!-- Toggler -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"
        aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Brand -->
    <a class="text-center pt-0" href="{{ route('home.index2') }}">
        <h1 class="text-primary font-weight-900 text-uppercase">Super Admin</h1>
    </a>
    <!-- User -->
    <ul class="nav align-items-center d-md-none">
        <li class="nav-item dropdown">
            <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <div class="media align-items-center">
                    <span class="avatar avatar-sm rounded-circle">
                        <img alt=""
                            src="{{ asset('storage/noavatar.png') }}">
                    </span>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                <a href="{{ route('profil') }}" class="dropdown-item">
                    <i class="ni ni-single-02"></i>
                    <span>Profil Saya</span>
                </a>
                <a href="{{ route('pengaturan') }}" class="dropdown-item">
                    <i class="ni ni-settings-gear-65"></i>
                    <span>Pengaturan</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('admin.logout') }}" class="dropdown-item"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="ni ni-user-run"></i>
                    <span>Logout</span>
                </a>
            </div>
        </li>
    </ul>
    <!-- Collapse -->
    <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Collapse header -->
        <div class="navbar-collapse-header d-md-none">
            <div class="row">
                <div class="col-6 collapse-brand">
                    <a href="{{ route('home.index2') }}">
                        <h1 class="text-primary"><b>Super Admin</b></h1>
                    </a>
                </div>
                <div class="col-6 collapse-close">
                    <button type="button" class="navbar-toggler" data-toggle="collapse"
                        data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false"
                        aria-label="Toggle sidenav">
                        <span></span>
                        <span></span>
                    </button>
                </div>
            </div>
        </div>
        <!-- Form -->
        @yield('form-search-mobile')
        <!-- Navigation -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link @if(Request::segment(2) == 'dashboard') active @endif" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-tachometer-alt text-blue"></i>
                    <span class="nav-link-inner--text">Dashboard</span>
                </a>
            </li>
        </ul>
        <hr class="my-3">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link @if(Request::segment(2) == 'tambah-data') active @endif" href="{{ route('admin.tambah-data') }}">
                    <i class="fas fa-database text-orange"></i>
                    <span class="nav-link-inner--text">Tambah Data</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(Request::segment(2) == 'dump-data') active @endif" href="{{ route('admin.dump') }}">
                    <i class="fas fa-plus text-orange"></i>
                    <span class="nav-link-inner--text">Dump Data</span>
                </a>
            </li>
        </ul>
        <hr class="my-3">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(2) == 'users' || Request::segment(2) == 'user') active @endif"
                    href="{{ route('admin.users') }}">
                    <i class="fas fa-users text-success"></i>
                    <span class="nav-link-inner--text">Users</span>
                </a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link @if (Request::segment(2) == 'surat' || Request::segment(2) == 'tambah-surat') active @endif"
                    href="{{ route('surat.index') }}">
                    <i class="ni ni-single-copy-04 text-primary"></i>
                    <span class="nav-link-inner--text">Kelola Surat</span>
                </a>
            </li> --}}
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(2) == 'kelurahan') active @endif" href="{{ route('admin.kelurahan') }}">
                    <i class="fas fa-home text-success"></i>
                    <span class="nav-link-inner--text">Kelurahan</span>
                </a>
            </li>
        </ul>
        <hr class="my-3">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(2) == 'profil' || Request::segment(2) == 'pengaturan') active @endif" href="#">
                    <i class="ni ni-single-02 text-yellow"></i>
                    <span class="nav-link-inner--text">Profil Saya</span>
                </a>
            </li>
        </ul>
        <hr class="my-3">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.logout') }}"
                    onclick="event.preventDefault(); document.getElementById('form-keluar').submit();">
                    <i class="ni ni-user-run text-red"></i>
                    <span class="nav-link-inner--text">logout</span>
                </a>
            </li>
        </ul>
    </div>
</div>
