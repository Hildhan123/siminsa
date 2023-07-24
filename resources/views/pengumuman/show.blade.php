@extends('home.layouts.app')

@section('title', 'Pengumuman')

@section('content')
    @include('home.layouts.header')

    <div class="container">
        <div class="row g-4">
            <div class="col-lg-8">
                @forelse ($pengumuman as $item)
                <div class="wow fadeInUp mb-4" data-wow-delay="0.3s">
                    <div class="row service-item p-4">
                        <div class="overflow-hidden mb-4 col">
                            <img class="img-fluid" @if ($item->gambar) src="{{ $item->gambar }}" @else src="{{ asset('storage/noimage.jpg') }}" @endif alt="">
                        </div>
                        <div class="col">
                            <h4 class="mb-3">{{$item->judul}}</h4>
                            <p class="text-muted mb-0">Posted on : {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y, H:i') }}</p><br>
                            <p>{{strip_tags(Illuminate\Support\Str::words($item->konten,25))}}</p>
                            <a class="btn-slide mt-2" href="{{route('pengumuman.detail', ['pengumuman' => $item->id, 'slug' => Str::slug($item->judul)])}}"><i class="fa fa-arrow-right"></i><span>Read More</span></a>
                        </div>
                    </div>
                </div>
            @empty
                Tidak ada Data
            @endforelse
                <div class="text-center wow fadeInUp">
                    {{$pengumuman->links()}}
                </div>
            </div>
            <div class="col-lg-4">
                @include('home.layouts.sidebar')
            </div>
        </div>
    </div>
@endsection
