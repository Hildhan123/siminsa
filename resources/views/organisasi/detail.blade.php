@extends('home.layouts.app')

@section('title', 'Struktur Organisasi')

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
                    <div class="col-md-12">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th width="15%" nowrap="">Jabatan</th>
                                    <td width="1px">:</td>
                                    <td> {{$detail->title}} </td>
                                </tr>
                                <tr>
                                    <th width="15%" nowrap="">Nama Pejabat</th>
                                    <td width="1px">:</td>
                                    <td> <small>{{$detail->nama}}</small> </td>
                                </tr>
                                <tr>
                                    <th width="15%" nowrap="">NIP</th>
                                    <td width="1px">:</td>
                                    <td><small>{{$detail->nip}}</small></td>
                                </tr>
                            </tbody>
                        </table>
                        <blockquote class="text-muted"> <small>{!! $detail->deskripsi !!}</small> </blockquote>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
