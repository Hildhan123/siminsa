<!-- Page Header Start -->
<div class="container-fluid page-header py-5" style="margin-bottom: 6rem;">
    <div class="container py-5">
        <h1 class="display-3 text-white mb-3 animated slideInDown">@yield('title')</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-white" href="/">Home</a></li>
                    @foreach (Request::segments() as $segment)
                    @php
                        $url = URL::to(implode('/', array_slice(Request::segments(), 0, $loop->index + 1)));
                    @endphp
                    <li class="breadcrumb-item"><a class="text-white" href="{{ $url }}">{{ ucfirst($segment) }}</a></li>
                    @endforeach
                {{-- <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                <li class="breadcrumb-item text-white active" aria-current="page">About</li> --}}
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->

