@extends('home.layouts.app')

@section('title', 'Layanan Kelurahan')

@section('content')
    @include('home.layouts.header')
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="card" style="width: 50em">
                <img  @if ($layanan->gambar) src="{{ $layanan->gambar }}" @else src="{{ asset('storage/noimage.jpg') }}" @endif
                    class="card-img-top">
                <div class="card-body">
                    <h2 class="card-title">{{$layanan->judul}}</h2>
                    <blockquote class="text-muted text-right"> <small>{{ $layanan->created_at }}</small> </blockquote>
                    <p class="card-text">{!! $layanan->konten !!}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
