@extends('home.layouts.app')

@section('title', 'Perangkat Kelurahan')

@section('content')
    @include('home.layouts.header')

    <div class="container">
        <div class="row">
            @forelse ($pegawai as $item)
                <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
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
                </div>
            @empty
                Tidak ada data
            @endforelse
        </div>
    </div>
@endsection
