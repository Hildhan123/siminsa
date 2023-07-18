@extends('home.layouts.app')

@section('title', 'Struktur Organisasi')

@section('style')
<link rel="stylesheet" href="{{ asset('css/jquery.fancybox.css') }}">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<style>
</style>
@endsection

@section('content')
    @include('home.layouts.header')

    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <ul class="nav nav-list flex-column mb-5">
                    @forelse ($organisasi as $index)
                    <li class="nav-item "> <a class="nav-link" href="{{route('organisasi.detail',['organisai' => $index->id])}}">{{$index->title}}</a></li>
                    @empty
                    Belum ada data
                    @endforelse
                </ul>
            </div>
            <div class="col-md-9">
                <div class="row">
                    @forelse ($gallery as $item)
                        {{-- <div class="col-md-12 img-scale-up">
                            <a href="{{ url(Storage::url($item->gallery)) }}" data-caption="{{ $item->caption }}" data-fancybox>
                                <img class="mw-200" src="{{ url(Storage::url($item->gallery)) }}" alt="">
                            </a>
                        </div> --}}
                        <div class="col-md-12">
                            <img class="img-fluid" src="{{ $item->gallery }}" alt="">
                            <br>
                                <strong><p class="text-center">{{$item->caption}}</p></strong>
                            <br>
                        </div>
                    @empty
                        Tidak Ada gambar
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
{{-- <script src="{{ asset('js/jquery.fancybox.js') }}"></script> --}}

@endpush

