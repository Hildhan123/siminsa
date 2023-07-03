@extends('home.layouts.app')

@section('title', 'Potensi')

@section('content')
    @include('home.layouts.header')
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="card" style="width: 50em">
                <img  @if ($potensi->gambar) src="{{ $potensi->gambar }}" @else src="{{ asset('storage/noimage.jpg') }}" @endif
                    class="card-img-top">
                <div class="card-body">
                    <h2 class="card-title">{{$potensi->nama}}</h2>
                    <blockquote class="text-muted text-right"> <small>{{ $potensi->created_at }}</small> </blockquote>
                    <p class="card-text">{!! $potensi->konten !!}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
