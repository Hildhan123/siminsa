@extends('home.layouts.app')

@section('title', 'Berita')

@section('content')
    @include('home.layouts.header')
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-8">
                @forelse ($berita as $item)
                <div class="wow fadeInUp mb-4" data-wow-delay="0.3s">
                    <div class="row service-item p-4">
                        <div class="overflow-hidden mb-4 col">
                            <img class="img-fluid" @if ($item->gambar) src="{{ $item->gambar }}" @else src="{{ asset('storage/noimage.jpg') }}" @endif alt="">
                        </div>
                        <div class="col">
                            <h4 class="mb-3">{{$item->judul}}</h4>
                            <p class="text-muted mb-0">Posted on : {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y, H:i') }}</p><br>
                            <p>{{strip_tags(Illuminate\Support\Str::words($item->konten,25))}}</p>
                            <a class="btn-slide mt-2" href="{{route('berita.show', ['berita' => $item->id, 'slug' => Str::slug($item->judul)])}}"><i class="fa fa-arrow-right"></i><span>Read More</span></a>
                        </div>
                    </div>
                </div>
            @empty
                Tidak ada Data
            @endforelse
            </div>
            <div class="col-lg-4">
                @include('home.layouts.sidebar')
            </div>
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
