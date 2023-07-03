@extends('home.layouts.app')

@section('title', 'Berita')

@section('content')
    @include('home.layouts.header')
    <div class="container">
        <div class="row justify-content-center">
            @forelse ($berita as $item)
            <div class="col-lg-6 col-12 mb-4 pb-2">
                <div class="card blog rounded border-0 shadow overflow-hidden h-100">
                    <div class="row align-items-center no-gutters">
                        <div class="col-md-6"> <img
                            @if ($item->gambar) src="{{ $item->gambar }}" @else src="{{ asset('storage/noimage.jpg') }}" @endif
                                class="img-fluid" alt="">
                            <div class="overlay bg-dark"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-body content">
                                <h5><a href="{{route('berita.show', ['berita' => $item->id, 'slug' => Str::slug($item->judul),'kelurahan_slug' => $desa->slug])}}"
                                        class="card-title title text-dark">{{$item->judul}}</a></h5>
                                <p class="text-muted mb-0">{{strip_tags(Illuminate\Support\Str::words($item->konten,25))}}</p>
                                <div class="post-meta d-flex justify-content-between mt-3"> <a
                                        href="{{route('berita.show', ['berita' => $item->id, 'slug' => Str::slug($item->judul),'kelurahan_slug' => $desa->slug])}}"
                                        class="text-muted readmore">Read More <i class="mdi mdi-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
                Tidak ada Data
            @endforelse
        </div>
    </div>
@endsection


{{-- @extends('layouts.layout')
@section('title', 'Website Resmi Pemerintah Desa '. $desa->nama_desa . ' - Berita')

@section('styles')
<meta name="description" content="Macam-macam berita Desa {{ $desa->nama_desa }}, Kecamatan {{ $desa->nama_kecamatan }}, Kabupaten {{ $desa->nama_kabupaten }}.">

<style>
    .animate-up:hover {
        top: -5px;
    }
</style>
@endsection

@section('header')
<h1 class="text-white text-muted">BERITA</h1>
<p class="text-white">Berita Desa {{ $desa->nama_desa }}, masyarakat dapat dengan mudah mengetahui informasi seputar berita desa {{ $desa->nama_desa }}.</p>
@endsection

@section('content')
<div class="row justify-content-center">
    @forelse ($berita as $item)
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card animate-up shadow">
                <a href="{{ route('berita.show', ['berita' => $item, 'slug' => Str::slug($item->judul)]) }}">
                    <div class="card-img" style="background-image: url('{{ $item->gambar ? url(Storage::url($item->gambar)) : url(Storage::url('noimage.jpg')) }}'); background-size: cover; height: 200px;"></div>
                </a>
                <div class="card-body text-center">
                    <a href="{{ route('berita.show', ['berita' => $item, 'slug' => Str::slug($item->judul)]) }}">
                        <h3>{{ $item->judul }}</h3>
                        <div class="mt-3 d-flex justify-content-between text-sm text-muted">
                            <i class="fas fa-clock"> {{ $item->created_at->diffForHumans() }}</i>
                            <i class="fas fa-eye"> {{ $item->dilihat }} Kali Dibaca</i>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    @empty
        <div class="col">
            <div class="card">
                <div class="card-body text-center">
                    <h3>Data belum tersedia</h3>
                </div>
            </div>
        </div>
    @endforelse
</div>
@endsection --}}
