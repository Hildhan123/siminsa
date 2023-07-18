@php
    $menuItems = (new \App\Http\Controllers\Controller)->getMenuItems();
@endphp

<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <title>Kelurahan {{ $desa->nama_kelurahan }} - @yield('title')</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.6/examples/carousel/">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Icons -->
    <link href="{{ asset('/js/plugins/nucleo/css/nucleo.css') }}" rel="stylesheet" />
    <link href="{{ asset('/js/plugins/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet" />
    
    <!-- style custom -->
    @yield('style')

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>

    <link
        href="@if ($desa->logo) {{ asset(Storage::url($desa->logo)) }} @else {{ asset('storage/kominfo.png') }} @endif"
        rel="icon" type="image/png">
    <!-- Custom styles for this template -->
    <link href="{{ asset('/css/carousel.css') }}" rel="stylesheet">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top bg-light">
            <div class="container">
                <a class="navbar-brand" href="/{{$desa->slug }}">
                    <img src="{{ asset(Storage::url($desa->logo)) }}" width="50" height="50" alt="">
                    Kelurahan {{ $desa->nama_kelurahan }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                        </li> --}}
                        @foreach ($menuItems as $menu)
                            @php
                                $url = trim($menu['parent']->url, '/');
                                $isActive = false;
                            @endphp
                            @if ($menu['children']->isEmpty())
                                <li class="nav-item {{ Request::is(trim($url, '/')) ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ $menu['parent']->url }}"
                                        target="{{ $menu['parent']->target }}">{{ $menu['parent']->title }}</a>
                                </li>
                            @else
                                @foreach ($menu['children'] as $child)
                                    @php
                                        $childUrl = trim($child->url, '/');
                                        if (Str::contains(Request::url(), url($child->url))) {
                                            $isActive = true;
                                            break;
                                        }
                                    @endphp
                                @endforeach
                                <li
                                    class="nav-item dropdown {{ $isActive ? 'active' : ''}}">
                                    <a class="nav-link dropdown-toggle" href="{{$menu['parent']->url}}" role="button"
                                        data-toggle="dropdown" aria-expanded="false">
                                        {{ $menu['parent']->title }}
                                    </a>
                                    <div class="dropdown-menu">
                                        @foreach ($menu['children'] as $child)
                                            <a class="dropdown-item {{ Str::contains(Request::url(), url($child->url)) ? 'active' : '' }}"
                                                href="{{ $child->url }}"
                                                target="{{ $child->target }}">{{ $child->title }}</a>
                                        @endforeach
                                    </div>
                                </li>
                            @endif
                        @endforeach
                        {{-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                aria-expanded="false">
                                Pemerintahan
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item"
                                    href="{{ route('organisasi.show', ['kelurahan_slug' => $desa->slug]) }}">Struktur
                                    Organisasi</a>
                                <a class="dropdown-item"
                                    href="{{ route('pegawai.show', ['kelurahan_slug' => $desa->slug]) }}">Perangkat
                                    Desa</a>
                                <a class="dropdown-item"
                                    href="{{ route('lembaga.show', ['kelurahan_slug' => $desa->slug]) }}">Lembaga
                                    Desa</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('layanan.show', ['kelurahan_slug' => $desa->slug]) }}">Layanan</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                aria-expanded="false">
                                Informasi
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item"
                                    href="{{ route('berita', ['kelurahan_slug' => $desa->slug]) }}">Berita</a>
                                <a class="dropdown-item"
                                    href="{{ route('pengumuman.show', ['kelurahan_slug' => $desa->slug]) }}">Pengumuman</a>
                                <a class="dropdown-item"
                                    href="{{ route('agenda.show', ['kelurahan_slug' => $desa->slug]) }}">Agenda
                                    Kegiatan</a>
                                <a class="dropdown-item"
                                    href="{{ route('gallery', ['kelurahan_slug' => $desa->slug]) }}">Galeri</a>
                                <a class="dropdown-item"
                                    href="{{ route('download.show', ['kelurahan_slug' => $desa->slug]) }}">Download</a>
                                <a class="dropdown-item"
                                    href="{{ route('laporan-apbdes', ['kelurahan_slug' => $desa->slug]) }}">Laporan
                                    APBDesa</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('potensi.show', ['kelurahan_slug' => $desa->slug]) }}">Potensi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('produk.show', ['kelurahan_slug' => $desa->slug]) }}">Produk</a>
                        </li> --}}
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main role="main">
        @yield('content')
        <!-- FOOTER Copyright -->
        <footer class="py-5 bg-dark text-white">
            <div class="container">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-12 mb-0 mb-md-6 pb-0 pb-md-4">
                            <!-- <a class="logo-footer" href="#"><img src="images/logo-footer.png" alt="missing_logo" height="45"> SHREETHEMES<span class="text-primary">.</span></a> -->
                            <h5 class="text-light footer-head">Kelurahan {{ $desa->nama_kelurahan }}</h5>
                            <p class="mt-4 text-justify"> SELAMAT DATANG DI WEBSITE KELURAHAN {{ Str::upper($desa->nama_kelurahan) }}, KECAMATAN DEMAK,
                                KABUPATEN DEMAK, PROV JAWA TENGAH. <br><br> 
                                Alamat : {{$desa->alamat}} <br>
                                Kodepos : {{$desa->kodepos}} <br>
                                Kontak : {{$desa->kontak}}
                            </p>
                        </div>
                        <!--end col-->
                        <div class="col-lg-3 col-md-4 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0"></div>
                        <div class="col-lg-3 col-md-4 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                            <h4 class="text-light footer-head"></h4>
                            <img src="{{asset('storage/logo.png')}}" class="img-fluid">
                        </div>
                        <!--end col-->
                        <!-- <div class="col-lg-3 col-md-4 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0"> <h4 class="text-light footer-head">Usefull Links</h4> <ul class="list-unstyled footer-list mt-4"> <li><a href="#" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i> Terms of Services</a></li> <li><a href="#" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i> Privacy Policy</a></li> <li><a href="#" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i> Documentation</a></li> <li><a href="#" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i> Changelog</a></li> <li><a href="#" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i> Components</a></li> </ul> </div> -->
                        <!--end col-->
                        <!-- <div class="col-lg-3 col-md-4 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0"> <h4 class="text-light footer-head">Newsletter</h4> <p class="mt-4">Sign up and receive the latest tips via email.</p> <form> <div class="row"> <div class="col-lg-12"> <div class="foot-subscribe form-group position-relative"> <label>Write your email <span class="text-danger">*</span></label> <i data-feather="mail" class="fea icon-sm icons"></i> <input type="email" name="email" id="emailsubscribe" class="form-control pl-5 rounded" placeholder="Your email : " required> </div> </div> <div class="col-lg-12"> <input type="submit" id="submitsubscribe" name="send" class="btn btn-soft-primary btn-block" value="Subscribe"> </div> </div> </form> </div> -->
                    </div>
                </div>
                <div class="row align-items-center justify-content-xl-between">
                    <div class="col-xl-6">
                        <div class="copyright text-center text-xl-left text-muted">
                            © {{ date('Y') }} <p class="">
                                <a href="/{{$desa->slug }}" class="font-weight-bold ml-1"
                                   >Kelurahan
                                    {{ $desa->nama_kelurahan }}</a>.
                            </p>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="copyright text-center text-xl-right text-muted">
                            Powered By <a href="#" class="font-weight-bold ml-1">Dinas Komunikasi dan Informatika Kabupaten Demak</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        {{-- <footer class="">
            <div class="container">
                <p class="float-right"><a href="#">Back to top</a></p>
                <p>&copy; 2020-2023 © Kementerian Komunikasi dan Informatika RI</p>
            </div>
        </footer> --}}
    </main>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script>
        window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')
    </script>
    <script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>
    @stack('scripts')
</body>

</html>
