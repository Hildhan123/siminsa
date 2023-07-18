@extends('home.layouts.app')

@section('title', 'Pegawai')

@section('content')
    @include('home.layouts.header')

    <div class="container">
        <div class="row g-4">
            @forelse ($pegawai as $item)
                {{-- <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                    <div class="media align-items-center"> <img
                            @if ($item->photo) src="{{ $item->photo }}" @else src="{{ asset('storage/noavatar.png') }}" @endif
                            class="avatar avatar-medium rounded-circle img-thumbnail" alt="" height="100"
                            width="100">
                        <div class="content ml-3">
                            <h5 class="mb-0"><a href="{{ route('pegawai.detail', ['kelurahan_slug' => $desa->slug, 'pegawai' => $item->id]) }}"
                                    class="text-dark">{{ $item->nama }}</a></h5> <small
                                class="position text-muted">{{ $item->jabatan }}</small>
                        </div>
                    </div>
                </div> --}}
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="team-item p-4">
                        <div class="overflow-hidden mb-4">
                            <img class="img-fluid" @if ($item->photo) src="{{ $item->photo }}" @else src="{{ asset('storage/noavatar.png') }}" @endif alt="">
                        </div>
                        <h5 class="mb-0">{{ $item->nama }}</h5>
                        <p>{{ $item->jabatan }}</p>
                        <div class="btn-slide mt-1">
                            <i class="fa fa-share"></i>
                            <span>
                                <a class="text-white" href="{{ route('pegawai.detail', ['pegawai' => $item->id]) }}">Detail</a>
                            </span>
                        </div>
                    </div>
                </div>
            @empty
                Tidak ada data
            @endforelse
        </div>
    </div>
@endsection
