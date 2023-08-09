@extends('home.layouts.app')

@section('title', 'Selamat Datang di Kelurahan ' . $desa->nama_kelurahan)

@section('style')
    <link rel="stylesheet" href="{{ asset('css/jquery.fancybox.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')

    @include('home.layouts.slider')

    <!-- About Start -->
    <div class="container">

        <!-- About End -->

        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="section-title mb-5 pb-2">
                        <h2>Website Resmi Kelurahan {{ $desa->nama_kelurahan }} - Kecamatan Demak - Kabupaten Demak
                        </h2>
                    </div>
                </div>
                @if($selayang->active == 1)
                <div class="container-fluid overflow-hidden py-5 px-lg-0">
                    <div class="container about py-5 px-lg-0">
                        <div class="row g-5 mx-lg-0">
                            <div class="col-lg-6 ps-lg-0 wow fadeInLeft" data-wow-delay="0.1s" style="min-height: 400px;">
                                <div class="position-relative h-100">
                                    <img class="position-absolute img-fluid" @if($selayang->photo) src="{{$selayang->photo}}" @else src="{{ asset('tema1/img/pejabat.png') }}" @endif
                                        style="object-fit: cover;" alt="">
                                </div>
                            </div>
                            
                            <div class="col-lg-6 about-text wow fadeInUp" data-wow-delay="0.3s">
                                {{-- <h6 class="text-secondary text-uppercase mb-3">Selayang Pandang</h6> --}}
                                <h1 class="mb-5">{{$selayang->title}}</h1>
                                {!! $selayang->konten !!}
                                {{-- <div class="row g-4 mb-5">
                                <div class="col-sm-6 wow fadeIn" data-wow-delay="0.5s">
                                    <i class="fa fa-globe fa-3x text-primary mb-3"></i>
                                    <h5>Global Coverage</h5>
                                    <p class="m-0">Stet stet justo dolor sed duo. Ut clita sea sit ipsum diam lorem diam justo.</p>
                                </div>
                                <div class="col-sm-6 wow fadeIn" data-wow-delay="0.7s">
                                    <i class="fa fa-shipping-fast fa-3x text-primary mb-3"></i>
                                    <h5>On Time Delivery</h5>
                                    <p class="m-0">Stet stet justo dolor sed duo. Ut clita sea sit ipsum diam lorem diam justo.</p>
                                </div>
                            </div> --}}
                                {{-- <a href="" class="btn btn-primary py-3 px-5">Telusuri lebih dalam</a> --}}
                            </div>
                           
                        </div>
                    </div>
                </div>
                <hr>
                @endif
                <div class="col-lg-4 col-md-5 col-12">
                    @include('home.layouts.sidebar')
                    <hr>
                    <div class="container pl-4 pr-4 pb-4 pt-1 rounded shadow text-center wow fadeInUp">
                        <ul class="list-unstyled mb-0">
                            <li class="mt-1"><a href="#news" class="mouse-down text-primary">Berita</a></li>
                            <li class="mt-1"><a href="#attention" class="mouse-down text-primary">Pengumuman</a></li>
                            <li class="mt-1"><a href="#schedule" class="mouse-down text-primary">Agenda Kegiatan</a></li>
                            <li class="mt-1"><a href="#stucture" class="mouse-down text-primary">Struktur Organisasi</a></li>
                        </ul>
                        {{-- <div class=""> <img src="{{ asset('storage/faq.svg') }}" alt=""> </div> --}}
                    </div>
                </div>
                <div class="col-lg-8 col-md-7 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                    <div class="section-title" id="news">
                        <h3 class="mb-2 text-center">Berita Terkini :</h3>
                    </div>
                    <div class="border-bottom pb-4">
                        @forelse ($berita as $item)
                            <div class="wow fadeInRight mb-4" data-wow-delay="0.3s">
                                <div class="row service-item p-4">
                                    <div class="overflow-hidden mb-4 col">
                                        <img class="img-fluid" @if ($item->gambar) src="{{ $item->gambar }}" @else src="{{ asset('storage/noimage.jpg') }}" @endif alt="">
                                    </div>
                                    <div class="col">
                                        <h4 class="mb-3">{{$item->judul}}</h4>
                                        <p class="text-muted mb-0">Posted on : {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y, H:i') }}</p><br>
                                        <p>{{strip_tags(Illuminate\Support\Str::words($item->konten,25))}}</p>
                                        <a class="btn-slide mt-2" href="{{route('berita.show', ['berita' => $item->id, 'slug' => Str::slug($item->judul),'kelurahan_slug' => $desa->slug])}}"><i class="fa fa-arrow-right"></i><span>Read More</span></a>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="service-item wow fadeInUp">
                                <div class="card rounded overflow-hidden p-2 border-0 mb-3">
                                    <h5 class="text-primary mb-2">{{ $item->judul }}</h5>
                                    <div class="row no-gutters">
                                        <div class="col-md-3"> <img
                                                @if ($item->gambar) src="{{ $item->gambar }}" @else src="{{ asset('storage/noimage.jpg') }}" @endif
                                                class="img-fluid" alt=""> </div>
                                        <div class="col-md-9">
                                            <div class="card-body align-items-top pt-0">
                                                <p class="text-muted para-desc mb-0 mx-auto">
                                                    {{ strip_tags(Illuminate\Support\Str::words($item->konten, 35)) }}
                                                    <a
                                                        href="{{ route('berita.show', ['kelurahan_slug' => $desa->slug, 'berita' => $item, 'slug' => Str::slug($item->judul)]) }}">Selengkapnya</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        @empty
                            <div class="alert alert-light" role="alert"> Saat ini kami tidak memiliki data untuk
                                ditampilkan.
                            </div>
                        @endforelse
                    </div>
                    <div class="section-title" id="attention">
                        <h3 class="mt-5 mb-4 text-center">Pengumuman :</h3>
                    </div>
                    <div class="border-bottom pb-4">
                        @forelse ($pengumuman as $item)
                            <div class="wow fadeInRight mb-4" data-wow-delay="0.3s">
                                <div class="row service-item p-4">
                                    <div class="overflow-hidden mb-4 col">
                                        <img class="img-fluid" @if ($item->gambar) src="{{ $item->gambar }}" @else src="{{ asset('storage/noimage.jpg') }}" @endif alt="">
                                    </div>
                                    <div class="col">
                                        <h4 class="mb-3">{{$item->judul}}</h4>
                                        <p class="text-muted mb-0">Posted on : {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y, H:i') }}</p><br>
                                        <p>{{strip_tags(Illuminate\Support\Str::words($item->konten,25))}}</p>
                                        <a class="btn-slide mt-2" href="{{route('pengumuman.detail', ['pengumuman' => $item->id, 'slug' => Str::slug($item->judul),'kelurahan_slug' => $desa->slug])}}"><i class="fa fa-arrow-right"></i><span>Read More</span></a>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="service-item wow fadeInUp">
                                <div class="card rounded overflow-hidden p-2 border-0 mb-3">
                                    <h5 class="text-primary mb-2">{{ $item->judul }}</h5>
                                    <div class="row no-gutters">
                                        <div class="col-md-3"> <img
                                                @if ($item->gambar) src="{{ $item->gambar }}" @else src="{{ asset('storage/noimage.jpg') }}" @endif
                                                class="img-fluid" alt=""> </div>
                                        <div class="col-md-9">
                                            <div class="card-body align-items-top pt-0">
                                                <p class="text-muted para-desc mb-0 mx-auto">
                                                    {{ strip_tags(Illuminate\Support\Str::words($item->konten, 35)) }}
                                                    <a
                                                        href="{{ route('pengumuman.detail', ['pengumuman' => $item->id, 'kelurahan_slug' => $desa->slug, 'slug' => Str::slug($item->judul)]) }}">Selengkapnya</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        @empty
                            <div class="alert alert-light" role="alert"> Saat ini kami tidak memiliki data untuk
                                ditampilkan.
                            </div>
                        @endforelse
                    </div>
                    <div class="section-title" id="schedule">
                        <h3 class="mt-5 mb-4 text-center">Agenda Kegiatan :</h3>
                    </div>
                    <div class="border-bottom pb-4">
                        @forelse ($agenda as $item)
                            <div class="wow fadeInRight mb-4" data-wow-delay="0.3s">
                                <div class="row service-item p-4">
                                    <div class="overflow-hidden mb-4 col">
                                        <img class="img-fluid" @if ($item->gambar) src="{{ $item->gambar }}" @else src="{{ asset('storage/noimage.jpg') }}" @endif alt="">
                                    </div>
                                    <div class="col">
                                        <h4 class="mb-3">{{$item->nama}}</h4>
                                        <p>{{strip_tags(Illuminate\Support\Str::words($item->detail,25))}}</p><br>
                                        <h5 class="text-primary"><i class="fa fa-calendar mb-3"></i> : {{ \Carbon\Carbon::parse($item->tanggalDimulai)->format('d M Y') }}</h5>
                                        <h5 class="text-primary"><i class="fa fa-home mb-3"></i> : {{ $item->lokasi }}</h5>
                                        <a class="btn-slide mt-2" href="{{route('agenda.detail', ['agenda' => $item->id, 'slug' => Str::slug($item->nama),'kelurahan_slug' => $desa->slug])}}"><i class="fa fa-arrow-right"></i><span>Read More</span></a>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="service-item wow fadeInUp">
                                <div class="card rounded overflow-hidden p-2 border-0 mb-3">
                                    <h5 class="text-primary mb-2">{{ $item->nama }}</h5>
                                    <div class="row no-gutters">
                                        <div class="col-md-3"> <img
                                                @if ($item->gambar) src="{{ $item->gambar }}" @else src="{{ asset('storage/noimage.jpg') }}" @endif
                                                class="img-fluid" alt=""> </div>
                                        <div class="col-md-9">
                                            <div class="card-body align-items-top pt-0">
                                                <p class="text-muted para-desc mb-0 mx-auto">
                                                    {{ strip_tags(Illuminate\Support\Str::words($item->detail, 35)) }}
                                                    <a
                                                        href="{{ route('agenda.detail', ['agenda' => $item->id, 'kelurahan_slug' => $desa->slug, 'slug' => Str::slug($item->nama)]) }}">Selengkapnya</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        @empty
                            <div class="alert alert-light" role="alert"> Saat ini kami tidak memiliki data untuk
                                ditampilkan.
                            </div>
                        @endforelse
                    </div>
                    <div class="section-title" id="stucture">
                        <h5 class="mt-5 mb-3">Struktur Organisasi :</h5>
                        @if (!$organisasi)
                            <div class="alert alert-light" role="alert"> Saat ini kami tidak memiliki data untuk
                                ditampilkan.
                            </div>
                        @else
                            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    @php $i=0 @endphp
                                    @foreach ($organisasi as $item)
                                        <li data-target="#carouselExampleControls"
                                            class="bg-dark @if ($i == 0) active @endif"
                                            data-slide-to="{{ $i++ }}">
                                        </li>
                                    @endforeach
                                </ol>
                                <div class="carousel-inner">
                                    @php $i = 0 @endphp
                                    @foreach ($organisasi as $item)
                                        <div class="carousel-item @if ($i == 0) active @endif"
                                            style="height: 10rem;">
                                            <center>
                                                <div class="card text-center service-item" style="width: 25rem;">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-4">
                                                                <img @if ($item->photo) src="{{ $item->photo }}" @else src="{{ asset('storage/noimage.jpg') }}" @endif
                                                                    width="100" height="100"
                                                                    alt="{{ $i++ }}">
                                                            </div>
                                                            <div class="col-8">
                                                                <h5 class="card-title">{{ $item->title }}</h5>
                                                                <p class="card-text">{{ $item->nama }}</p>
                                                                <p class="card-text">{{ $item->nip }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </center>
                                        </div>
                                    @endforeach
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                                    data-slide="prev">
                                    <span class="carousel-control-prev-icon bg-dark" aria-hidden="false"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                                    data-slide="next">
                                    <span class="carousel-control-next-icon bg-dark" aria-hidden="false"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (count($galleries) > 0)
        <section class="mb-5">
            <div class="row">
                <div class="col-md">
                    <div class="header-body text-center mt-5 mb-3">
                        <div class="row justify-content-center">
                            <div class="col-lg-6 col-md-6 border-bottom">
                                <h2 class="text-dark">GALLERY</h2>
                                <p class="text-dark">Gallery Kelurahan {{ $desa->nama_kelurahan }}, masyarakat dapat
                                    dengan
                                    mudah mengetahui gallery kelurahan {{ $desa->nama_kelurahan }}.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                @foreach ($galleries as $key => $item)
                    @if ($key < 3)
                        @if ($item['jenis'] == 1)
                            <div class="col-lg-4 col-md-6 mb-3 img-scale-up">
                                <a href="{{ $item['gambar'] }}" data-fancybox data-caption="{{ $item['caption'] }}">
                                    <img class="mw-100" src="{{ $item['gambar'] }}" alt="">
                                </a>
                            </div>
                        @else
                            <div class="col-lg-4 col-md-6 mb-3 img-scale-up">
                                <a href="https://www.youtube.com/watch?v={{ $item['id'] }}" data-fancybox
                                    data-caption="{{ $item['caption'] }}">
                                    <i class="fas fa-play fa-2x" style="position: absolute; top:43%; left:46%;"></i>
                                    <img class="mw-100" src="{{ $item['gambar'] }}" alt="">
                                </a>
                            </div>
                        @endif
                    @endif
                @endforeach
            </div>
            @if (count($galleries) > 6)
                <div class="text-center">
                    <a href="{{ route('gallery') }}" class="btn btn-primary">Lebih Banyak Gallery</a>
                </div>
            @endif

        </section>
    @endif

@endsection
@push('scripts')
    <script src="{{ asset('js/jquery.fancybox.js') }}"></script>
@endpush
