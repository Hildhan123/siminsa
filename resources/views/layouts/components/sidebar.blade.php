<div class="container-fluid">
    <!-- Toggler -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"
        aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Brand -->
    <a class="text-center pt-0" href="{{ route('home.index2') }}">
        <h1 class="text-primary font-weight-900 text-uppercase">Kelurahan {{ $desa->nama_kelurahan }}</h1>
    </a>
    <!-- User -->
    <ul class="nav align-items-center d-md-none">
        <li class="nav-item dropdown">
            <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <div class="media align-items-center">
                    <span class="avatar avatar-sm rounded-circle">
                        <img alt="{{ asset(Storage::url(auth()->user()->foto_profil)) }}"
                            src="{{ asset(Storage::url(auth()->user()->foto_profil)) }}">
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
                <a href="{{ route('keluar') }}" class="dropdown-item"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="ni ni-user-run"></i>
                    <span>Keluar</span>
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
                        <h1 class="text-primary"><b>Kelurahan {{ $desa->nama_kelurahan }}</b></h1>
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
                <a class="nav-link @if(Request::segment(2) == 'dashboard') active @endif" href="{{ route('dashboard') }}">
                    <i class="fas fa-tachometer-alt text-blue"></i>
                    <span class="nav-link-inner--text">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home.index',['kelurahan_slug'=>$desa->slug]) }}" target="_blank">
                    <i class="fas fa-home text-blue"></i>
                    <span class="nav-link-inner--text">Beranda</span>
                </a>
            </li>
        </ul>
        <hr class="my-3">
        <ul class="navbar-nav accordion" id="accordionExample">
            <a class="nav-link @if (Request::segment(2) == 'organisasi' ||
                    Request::segment(2) == 'tambah-organisasi' ||
                    Request::segment(2) == 'pegawai' ||
                    Request::segment(2) == 'tambah-pegawai' ||
                    Request::segment(2) == 'lembaga' ||
                    Request::segment(2) == 'tambah-lembaga') active @endif" type="button" data-toggle="hidden"
                data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                <i class="fas fa-users text-info"></i>
                <span class="nav-link-inner--text">Organisasi</span>
            </a>
            <li class="nav-item" id="collapseOne" class="collapse" aria-labelledby="headingOne"
                data-parent="#accordionExample">
                <a class="nav-link child @if (Request::segment(2) == 'pegawai' || Request::segment(2) == 'tambah-pegawai') active @endif"
                    href="{{ route('pegawai.index') }}">
                    {{-- <i class="fas fa-users text-info"></i> --}}
                    <span class="nav-link-inner--text">Perangkat Desa</span>
                </a>
                <a class="nav-link child @if (Request::segment(2) == 'organisasi' || Request::segment(2) == 'tambah-organisasi') active @endif"
                    href="{{ route('organisasi.index') }}">
                    {{-- <i class="fas fa-users text-info"></i> --}}
                    <span class="nav-link-inner--text">Struktur Organisasi</span>
                </a>
                <a class="nav-link child @if (Request::segment(2) == 'lembaga' || Request::segment(2) == 'tambah-lembaga') active @endif"
                    href="{{ route('lembaga.index') }}">
                    {{-- <i class="fas fa-users text-info"></i> --}}
                    <span class="nav-link-inner--text">Lembaga Desa</span>
                </a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link @if (Request::segment(2) == 'penduduk' || Request::segment(2) == 'tambah-penduduk') active @endif"
                    href="{{ route('penduduk.index') }}">
                    <i class="fas fa-users text-info"></i>
                    <span class="nav-link-inner--text">Kelola Penduduk</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(2) == 'dusun' || Request::segment(2) == 'tambah-dusun') active @endif" href="{{ route('dusun.index') }}">
                    <i class="fas fa-map-marker-alt text-yellow"></i>
                    <span class="nav-link-inner--text">Kelola Dusun</span>
                </a>
            </li> --}}
        </ul>
        <hr class="my-3">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(2) == 'anggaran-realisasi' || Request::segment(2) == 'tambah-anggaran-realisasi') active @endif"
                    href="{{ url('admin/anggaran-realisasi?jenis=pendapatan&tahun=' . date('Y')) }}">
                    <i class="fas fa-coins text-success"></i>
                    <span class="nav-link-inner--text">Kelola APBDes</span>
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
                <a class="nav-link @if (Request::segment(2) == 'pages' ||
                        Request::segment(2) == 'tambah-pages' ||
                        Request::segment(2) == 'pemerintahan-desa') active @endif" href="{{ route('pages.index') }}">
                    <i class="fas fa-atlas text-success"></i>
                    <span class="nav-link-inner--text">Pages</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(2) == 'navbar' ||
                        Request::segment(2) == 'tambah-navbar') active @endif" href="{{ route('navbar.index') }}">
                    <i class="fas fa-bars text-success"></i>
                    <span class="nav-link-inner--text">Navigasi</span>
                </a>
            </li>
        </ul>
        <hr class="my-3">
        <ul class="navbar-nav accordion" id="accordionExample">
            <a class="nav-link @if (Request::segment(2) == 'kelola-berita' ||
                    Request::segment(2) == 'tambah-berita' ||
                    Request::segment(2) == 'berita' ||
                    Request::segment(2) == 'kelola-gallery' ||
                    Request::segment(2) == 'slider' ||
                    Request::segment(2) == 'pengumuman' ||
                    Request::segment(2) == 'tambah-pengumuman' ||
                    Request::segment(2) == 'agenda' ||
                    Request::segment(2) == 'tambah-agenda' ||
                    Request::segment(2) == 'layanan' ||
                    Request::segment(2) == 'tambah-layanan' ||
                    Request::segment(2) == 'tautan' ||
                    Request::segment(2) == 'tambah-tautan' ||
                    Request::segment(2) == 'download' ||
                    Request::segment(2) == 'tambah-download' ||
                    Request::segment(2) == 'potensi' ||
                    Request::segment(2) == 'tambah-potensi' ||
                    Request::segment(2) == 'produk' ||
                    Request::segment(2) == 'tambah-produk' ||
                    Request::segment(2) == 'pengumuman') active autofocus @endif" type="button" data-toggle="hidden"
                data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                <i class="fas fa-newspaper text-cyan"></i>
                <span class="nav-link-inner--text">Konten</span>
            </a>
            <li class="nav-item" id="collapseOne" class="collapse" aria-labelledby="headingOne"
            data-parent="#accordionExample">
                <a class="nav-link child @if (Request::segment(2) == 'kelola-berita' || Request::segment(2) == 'tambah-berita' || Request::segment(2) == 'berita') active @endif"
                    href="{{ route('berita.index') }}">
                    {{-- <i class="fas fa-newspaper text-cyan"></i> --}}
                    <span class="nav-link-inner--text">Kelola Berita</span>
                </a>
                <a class="nav-link child @if (Request::segment(2) == 'kelola-gallery') active @endif"
                    href="{{ route('gallery.index') }}">
                    {{-- <i class="fas fa-images text-orange"></i> --}}
                    <span class="nav-link-inner--text">Kelola Gallery</span>
                </a>
                <a class="nav-link child @if (Request::segment(2) == 'slider') active @endif"
                    href="{{ route('slider.index') }}">
                    {{-- <i class="fas fa-images text-purple"></i> --}}
                    <span class="nav-link-inner--text">Kelola Slider</span>
                </a>
                <a class="nav-link child @if (Request::segment(2) == 'pengumuman' || Request::segment(2) == 'tambah-pengumuman') active @endif"
                    href="{{ route('pengumuman.index') }}">
                    {{-- <i class="fas fa-images text-purple"></i> --}}
                    <span class="nav-link-inner--text">Kelola Pengumuman</span>
                </a>
                <a class="nav-link child @if (Request::segment(2) == 'agenda' || Request::segment(2) == 'tambah-agenda') active @endif"
                    href="{{ route('agenda.index') }}">
                    {{-- <i class="fas fa-images text-purple"></i> --}}
                    <span class="nav-link-inner--text">Kelola Agenda</span>
                </a>
                <a class="nav-link child @if (Request::segment(2) == 'layanan' || Request::segment(2) == 'tambah-layanan') active @endif"
                    href="{{ route('layanan.index') }}">
                    {{-- <i class="fas fa-images text-purple"></i> --}}
                    <span class="nav-link-inner--text">Kelola Layanan</span>
                </a>
                {{-- <a class="nav-link child @if (Request::segment(2) == 'tautan' || Request::segment(2) == 'tambah-tautan') active @endif"
                    href="{{ route('tautan.index') }}">
                    <span class="nav-link-inner--text">Kelola Tautan</span>
                </a> --}}
                <a class="nav-link child @if (Request::segment(2) == 'download' || Request::segment(2) == 'tambah-download') active @endif"
                    href="{{ route('download.index') }}">
                    {{-- <i class="fas fa-images text-purple"></i> --}}
                    <span class="nav-link-inner--text">Kelola Download</span>
                </a>
                <a class="nav-link child @if (Request::segment(2) == 'produk' || Request::segment(2) == 'tambah-produk') active @endif"
                    href="{{ route('produk.index') }}">
                    {{-- <i class="fas fa-images text-purple"></i> --}}
                    <span class="nav-link-inner--text">Kelola Produk</span>
                </a>
                <a class="nav-link child @if (Request::segment(2) == 'potensi' || Request::segment(2) == 'tambah-potensi') active @endif"
                    href="{{ route('potensi.index') }}">
                    {{-- <i class="fas fa-images text-purple"></i> --}}
                    <span class="nav-link-inner--text">Kelola Potensi</span>
                </a>
        </ul>
        <hr class="my-3">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(2) == 'profil-kelurahan') active @endif"
                    href="{{ route('profil-desa') }}">
                    <i class="fas fa-home text-yellow"></i>
                    <span class="nav-link-inner--text">Profil Desa</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(2) == 'profil' || Request::segment(2) == 'pengaturan') active @endif" href="{{ route('profil') }}">
                    <i class="ni ni-single-02 text-yellow"></i>
                    <span class="nav-link-inner--text">Profil Saya</span>
                </a>
            </li>
        </ul>
        <hr class="my-3">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('keluar') }}"
                    onclick="event.preventDefault(); document.getElementById('form-keluar').submit();">
                    <i class="ni ni-user-run text-red"></i>
                    <span class="nav-link-inner--text">Keluar</span>
                </a>
            </li>
        </ul>
    </div>
</div>

