@extends('home.layouts.app')

@section('title', 'Lembaga Kelurahan')

@section('content')
    @include('home.layouts.header')
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="card" style="width: 50em">
                <img  @if ($lembaga->logo) src="{{ $lembaga->logo }}" @else src="{{ asset('storage/noimage.jpg') }}" @endif
                    class="card-img-top">
                <div class="card-body">
                    <h2 class="card-title">{{$lembaga->nama}}</h2>
                    <p class="card-text">
                        <table>
                            <tr>  
                                <td>Singkatan</td> <td>: {{$lembaga->singkatan}}</td>
                            </tr>
                            <tr>  
                                <td>Dasar Hukum</td> <td>: {{$lembaga->dasar_hukum}}</td>
                            </tr>
                            <tr>  
                                <td>Alamat</td> <td>: {{$lembaga->alamat}}</td>
                            </tr>
                        </table>
                    </p>
                    <h3>Profil</h3>
                    {!! $lembaga->profil !!}
                    <h3>Visi Misi</h3>
                    {!! $lembaga->visi_misi !!}
                    <h3>Tugas Pokok dan Fungsi</h3>
                    {!! $lembaga->tugas_dan_fungsi !!}
                    <h3>Kepengurusan</h3>
                    {!! $lembaga->kepengurusan !!}
                </div>
            </div>
        </div>
    </div>
@endsection