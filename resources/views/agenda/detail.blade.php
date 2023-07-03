@extends('home.layouts.app')

@section('title', 'Agenda Kegiatan')

@section('content')
    @include('home.layouts.header')
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="card" style="width: 50em">
                <img @if ($agenda->gambar) src="{{ $agenda->gambar }}" @else src="{{ asset('storage/noimage.jpg') }}" @endif
                    class="card-img-top">
                <div class="card-body">
                    <h2 class="card-title">{{$agenda->nama}}</h2>
                    <blockquote class="text-muted text-right"> <small>{{ $agenda->created_at }}</small> </blockquote>
                    
                    <p class="card-text">
                        <table>
                            <tr>  
                                <td>Lokasi</td> <td>: {{$agenda->lokasi}}</td>
                            </tr>
                            <tr>  
                                <td>Tanggal Dimulai</td> <td>: {{$agenda->tanggalDimulai}}</td>
                            </tr>
                            <tr>  
                                <td>Tanggal Berakhir</td> <td>: {{$agenda->tanggalBerakhir}}</td>
                            </tr>
                        </table>
                        {!! $agenda->detail !!}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
