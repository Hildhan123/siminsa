@extends('home.layouts.app')

@section('title', 'Agenda Kegiatan')

@section('content')
    @include('home.layouts.header')

    <div class="container">
        <div class="row g-4">
            <div class="col-lg-8">
                @forelse ($agenda as $item)
                <div class="wow fadeInUp mb-4" data-wow-delay="0.3s">
                    <div class="row service-item p-4">
                        <div class="overflow-hidden mb-4 col">
                            <img class="img-fluid" @if ($item->gambar) src="{{ $item->gambar }}" @else src="{{ asset('storage/noimage.jpg') }}" @endif alt="">
                        </div>
                        <div class="col">
                            <h4 class="mb-3">{{$item->nama}}</h4>
                            <p>{{strip_tags(Illuminate\Support\Str::words($item->detail,25))}}</p><br>
                            <h5 class="text-primary"><i class="fa fa-calendar mb-3"></i> : {{ \Carbon\Carbon::parse($item->tanggalDimulai)->format('d M Y') }}</h5>
                            <h5 class="text-primary"><i class="fa fa-home mb-3"></i> : {{ $item->lokasi }}</h5>
                            <a class="btn-slide mt-2" href="{{route('agenda.detail', ['agenda' => $item->id, 'slug' => Str::slug($item->nama)])}}"><i class="fa fa-arrow-right"></i><span>Read More</span></a>
                        </div>
                    </div>
                </div>
            @empty
                Tidak ada Data
            @endforelse
            </div>
            <div class="col-lg-4">
                @include('home.layouts.sidebar')
            </div>
        </div>
    </div>
@endsection
