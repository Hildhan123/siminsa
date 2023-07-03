@extends('home.layouts.app')

@section('title', 'Pengumuman')

@section('content')
    @include('home.layouts.header')
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="card" style="width: 50em">
                <img @if ($pengumuman->gambar) src="{{ $pengumuman->gambar }}" @else src="{{ asset('storage/noimage.jpg') }}" @endif
                    class="card-img-top">
                <div class="card-body">
                    <h2 class="card-title">{{$pengumuman->judul}}</h2>
                    <blockquote class="text-muted text-right"> <small>{{ $pengumuman->created_at }}</small> </blockquote>
                    <p class="card-text">{!! $pengumuman->konten !!}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
