@php
    $menuItems = (new \App\Http\Controllers\Controller())->getMenuItems();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Kelurahan {{ $desa->nama_kelurahan }} - @yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{ asset(Storage::url($desa->logo)) }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Roboto:wght@500;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('tema1/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('tema1/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="https://getbootstrap.com/docs/4.6/examples/carousel/">
    <link href="{{ asset('tema1/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('tema1/css/style.css') }}" rel="stylesheet">

    <!-- Custom pages styles -->
    @yield('style')
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow border-top border-5 border-primary sticky-top p-0">
        <a href="/" class="navbar-brand bg-primary d-flex align-items-center px-4 px-lg-5">
            <img src="{{ asset(Storage::url($desa->logo)) }}" width="50" height="50" alt="">
            {{-- <h2 class="mb-2 text-white">Kelurahan {{ $desa->nama_kelurahan }}</h2> --}}
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                @foreach ($menuItems as $menu)
                    @php
                        $url = trim($menu['parent']->url, '/');
                        $isActive = false;
                    @endphp
                    @if ($menu['children']->isEmpty())
                        <a class="nav-item nav-link {{ Request::is(trim($url, '/')) ? 'active' : '' }}"
                            href="{{ $menu['parent']->url }}" target="{{ $menu['parent']->target }}">
                            {{ $menu['parent']->title }}
                        </a>
                    @else
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ $isActive ? 'active' : '' }}"
                                href="{{ $menu['parent']->url }}" role="button" data-toggle="dropdown"
                                aria-expanded="false">
                                {{ $menu['parent']->title }}
                            </a>
                            <div class="dropdown-menu fade-up m-0">
                                @foreach ($menu['children'] as $child)
                                    <a class="dropdown-item {{ Str::contains(Request::url(), url($child->url)) ? 'active' : '' }}"
                                        href="{{ $child->url }}" target="{{ $child->target }}">
                                        {{ $child->title }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            {{-- <h4 class="m-0 pe-lg-5 d-none d-lg-block"><i class="fa fa-headphones text-primary me-3"></i>+012 345 6789 --}}
            </h4>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- content -->
    @yield('content')

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer pt-5 wow fadeIn" data-wow-delay="0.1s"
        style="margin-top: 6rem;">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-10 col-md-6">
                    <h4 class="text-light mb-4">Kelurahan {{$desa->nama_kelurahan}}</h4>
                    <p class="mt-4 text-justify"> SELAMAT DATANG DI WEBSITE KELURAHAN {{ Str::upper($desa->nama_kelurahan) }}, KECAMATAN DEMAK,
                        KABUPATEN DEMAK, PROV JAWA TENGAH. <br><br> 
                        Alamat : {{$desa->alamat}} <br>
                        Kodepos : {{$desa->kodepos}} <br>
                        Kontak : {{$desa->kontak}}
                    </p>
                </div>
                <div class="col-lg-2 col-md-6">
                    <img src="{{asset('storage/logo.png')}}" class="img-fluid">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        © {{ date('Y') }} <p class="">
                            <a href="/" class="border-bottom"
                               >Kelurahan
                                {{ $desa->nama_kelurahan }}</a>
                        </p>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                        Powered By <a href="#" class="border-bottom">Dinas Komunikasi dan Informatika Kabupaten Demak</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-0 back-to-top"><i
            class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script> --}}
    <script src="{{ asset('tema1/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('tema1/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('tema1/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('tema1/lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('tema1/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('tema1/js/main.js') }}"></script>

    <!-- custom script pages -->
    @stack('scripts')
</body>

</html>
