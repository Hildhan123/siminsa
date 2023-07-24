@extends('home.layouts.app')

@section('title', 'Potensi')

@section('content')
    @include('home.layouts.header')

    <div class="container">
        <div class="row g-4">
            @forelse ($potensi as $item)
            <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.3s">
                <div class="service-item p-4">
                    <div class="overflow-hidden mb-4">
                        <img class="img-fluid" @if ($item->gambar) src="{{ $item->gambar }}" @else src="{{ asset('storage/noimage.jpg') }}" @endif alt="">
                    </div>
                    <h4 class="mb-3">{{$item->nama}}</h4>
                    <p>{{strip_tags(Illuminate\Support\Str::words($item->konten,25))}}</p>
                    <a class="btn-slide mt-2" href="{{route('potensi.detail',['potensi' => $item->id, 'slug' => Str::slug($item->nama)])}}"><i class="fa fa-arrow-right"></i><span>Read More</span></a>
                </div>
            </div>
            @empty
                Tidak ada Data
            @endforelse
        </div>
        <div class="text-center wow fadeInUp">
            {{$potensi->links()}}
        </div>
    </div>
@endsection
