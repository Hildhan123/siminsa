@extends('home.layouts.app')

@section('title', 'Selamat Datang di Kelurahan ' . $desa->nama_kelurahan)

@section('content')
    @include('home.layouts.slider')
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div class="section-title mb-5 pb-2">
                    <h5>Website Resmi Kelurahan {{ $desa->nama_kelurahan }} - Kecamatan Demak - Kabupaten Demak
                    </h5>
                </div>
            </div>
            <div class="col-lg-4 col-md-5 col-12">
                <div class="sidebar sticky-bar pl-4 pr-4 pb-4 pt-1 rounded shadow">
                    <ul class="list-unstyled mb-0">
                        <li class="mt-1"><a href="#news" class="mouse-down text-dark">Berita</a></li>
                        <li class="mt-1"><a href="#attention" class="mouse-down text-dark">Pengumuman</a></li>
                        <li class="mt-1"><a href="#schedule" class="mouse-down text-dark">Agenda Kegiatan</a></li>
                        <li class="mt-1"><a href="#stucture" class="mouse-down text-dark">Struktur Organisasi</a></li>
                    </ul>
                    <hr>
                    <div class=""> <img
                            src="http://sumberejo-mranggen.desa.id/themes/landrick/layouts/images/illustrator/faq.svg"
                            alt=""> </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-7 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                <div class="section-title" id="news">
                    <h5 class="mb-2">Berita Terkini :</h5>
                </div>
                <div class="border-bottom pb-4">
                    @forelse ($berita as $item)
                        <div class="card rounded bg-light overflow-hidden p-2 border-0 mb-3">
                            <h5 class="text-primary mb-2">{{ $item->judul }}</h5>
                            <div class="row no-gutters">
                                <div class="col-md-3"> <img
                                        @if ($item->gambar) src="{{ $item->gambar }}" @else src="{{ asset('storage/noimage.jpg') }}" @endif
                                        class="img-fluid" alt=""> </div>
                                <div class="col-md-9">
                                    <div class="card-body align-items-top pt-0">
                                        <p class="text-muted para-desc mb-0 mx-auto">
                                            {{ strip_tags(Illuminate\Support\Str::words($item->konten, 35)) }}
                                            <a href="{{ route('berita.show', ['kelurahan_slug' => $desa->slug ,'berita' => $item, 'slug' => Str::slug($item->judul)]) }}">Selengkapnya</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-light" role="alert"> Saat ini kami tidak memiliki data untuk ditampilkan.
                        </div>
                    @endforelse
                </div>
                <div class="section-title" id="attention">
                    <h5 class="mt-5 mb-4">Pengumuman :</h5>
                </div>
                <div class="border-bottom pb-4">
                    @forelse ($pengumuman as $item)
                        <div class="card rounded bg-light overflow-hidden p-2 border-0 mb-3">
                            <h5 class="text-primary mb-2">{{ $item->judul }}</h5>
                            <div class="row no-gutters">
                                <div class="col-md-3"> <img
                                        @if ($item->gambar) src="{{ $item->gambar }}" @else src="{{ asset('storage/noimage.jpg') }}" @endif
                                        class="img-fluid" alt=""> </div>
                                <div class="col-md-9">
                                    <div class="card-body align-items-top pt-0">
                                        <p class="text-muted para-desc mb-0 mx-auto">
                                            {{ strip_tags(Illuminate\Support\Str::words($item->konten, 35)) }}
                                            <a href="{{ route('pengumuman.detail', ['pengumuman' => $item->id, 'kelurahan_slug' => $desa->slug, 'slug' => Str::slug($item->judul)]) }}">Selengkapnya</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-light" role="alert"> Saat ini kami tidak memiliki data untuk ditampilkan.
                        </div>
                    @endforelse
                </div>
                <div class="section-title" id="schedule">
                    <h5 class="mt-5 mb-4">Agenda Kegiatan :</h5>
                </div>
                <div class="border-bottom pb-4">
                    @forelse ($agenda as $item)
                        <div class="card rounded bg-light overflow-hidden p-2 border-0 mb-3">
                            <h5 class="text-primary mb-2">{{ $item->nama }}</h5>
                            <div class="row no-gutters">
                                <div class="col-md-3"> <img
                                        @if ($item->gambar) src="{{ $item->gambar }}" @else src="{{ asset('storage/noimage.jpg') }}" @endif
                                        class="img-fluid" alt=""> </div>
                                <div class="col-md-9">
                                    <div class="card-body align-items-top pt-0">
                                        <p class="text-muted para-desc mb-0 mx-auto">
                                            {{ strip_tags(Illuminate\Support\Str::words($item->detail, 35)) }}
                                            <a href="{{ route('agenda.detail', ['agenda' => $item->id,'kelurahan_slug' => $desa->slug, 'slug' => Str::slug($item->nama )]) }}">Selengkapnya</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-light" role="alert"> Saat ini kami tidak memiliki data untuk ditampilkan.
                        </div>
                    @endforelse
                </div>
                <div class="section-title" id="stucture">
                    <h5 class="mt-5 mb-3">Struktur Organisasi :</h5>
                    @if (!$organisasi)
                        <div class="alert alert-light" role="alert"> Saat ini kami tidak memiliki data untuk ditampilkan.
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
                                    <div class="carousel-item @if ($i == 0) active @endif" style="height: 10rem;">
                                        <center>
                                            <div class="card text-center" style="width: 25rem;">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <img @if ($item->photo) src="{{ $item->photo }}" @else src="{{ asset('storage/noimage.jpg') }}" @endif
                                                                width="100" height="100" alt="{{$i++}}">
                                                        </div>
                                                        <div class="col-8">
                                                            <h5 class="card-title">{{$item->title}}</h5>
                                                            <p class="card-text">{{$item->nama}}</p>
                                                            <p class="card-text">{{$item->nip}}</p>
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
                                <a href="{{ $item['gambar'] }}" data-fancybox
                                    data-caption="{{ $item['caption'] }}">
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
