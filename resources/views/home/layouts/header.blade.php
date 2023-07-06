<section class="jumbotron  d-table w-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 text-center">
                <div class="page-next-level">
                    <h4 class="title"> @yield('title') </h4>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="row justify-content-center" style="position: relative; top: -50px;">
    <nav aria-label="breadcrumb" class="d-inline-block">
        {{-- <ul class="breadcrumb bg-white rounded shadow mb-0">
            <li class="breadcrumb-item"><a href="http://sumberejo-mranggen.desa.id/"><i
                        class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item active">Produk Hukum</li>
        </ul> --}}
        <ul class="breadcrumb bg-white rounded shadow mb-0">
            <li class="breadcrumb-item"><a href="/"><i
                class="fas fa-home"></i></a></li>
            @foreach (Request::segments() as $segment)
                @php
                    $url = URL::to(implode('/', array_slice(Request::segments(), 0, $loop->index + 1)));
                @endphp
                <li class="breadcrumb-item"><a href="{{ $url }}">{{ ucfirst($segment) }}</a></li>
            @endforeach

        </ul>
    </nav>
</div>

