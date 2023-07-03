@php $i=0 @endphp
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        @foreach ($gallery as $slider)
            <li data-target="#myCarousel" @if ($i == 0) class="active" @endif
                data-slide-to="{{ $i++ }}"></li>
        @endforeach
    </ol>
    <div class="carousel-inner">
        @php $i = 0 @endphp
        @forelse ($gallery as $slider)
            <div class="carousel-item @if ($i == 0) active @endif">
                <img src="{{ $slider->gallery }}">

                <div class="container">
                    <div class="carousel-caption text-left">
                        {{-- <h1>Example headline.</h1> --}}
                        <p>{{ $slider->caption }}</p>
                    </div>
                </div>
            </div>
            {{ $i++ }}
        @empty
        @endforelse
    </div>
    <button class="carousel-control-prev" type="button" data-target="#myCarousel" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-target="#myCarousel" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </button>
</div>