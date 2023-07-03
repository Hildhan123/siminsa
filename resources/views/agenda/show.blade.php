@extends('home.layouts.app')

@section('title', 'Agenda Kegiatan')

@section('content')
    @include('home.layouts.header')

    <div class="container">
        <div class="row">
            @forelse ($agenda as $item)
                <div class="col-lg-6 col-12 mb-4 pb-2">
                    <div class="card blog rounded border-0 shadow overflow-hidden h-100">
                        <div class="row align-items-center no-gutters">
                            <div class="col-md-6"> <img
                                    @if ($item->gambar) src="{{ $item->gambar }}" @else src="{{ asset('storage/noimage.jpg') }}" @endif
                                    class="img-fluid" alt="">
                                <div class="overlay bg-dark"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="card-body content">
                                    <h5><a href="{{ route('agenda.detail', ['agenda' => $item->id, 'kelurahan_slug' => $desa->slug, 'slug' => Str::slug($item->nama)]) }}"
                                            class="card-title title text-dark">{{ $item->nama }}</a></h5>
                                    <p class="text-muted mb-0">
                                        {{ strip_tags(Illuminate\Support\Str::words($item->detail, 25)) }}
                                    </p>
                                    <div class="post-meta d-flex justify-content-between mt-3"> <a
                                            href="{{ route('agenda.detail', ['agenda' => $item->id, 'kelurahan_slug' => $desa->slug, 'slug' => Str::slug($item->nama)]) }}"
                                            class="text-muted readmore">Read More <i class="mdi mdi-chevron-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                Tidak Ada Data
            @endforelse
        </div>
    </div>
@endsection
