<div class="container-fluid p-0 pb-5">
    <div class="owl-carousel header-carousel position-relative mb-5">
        @foreach ($gallery as $slider)
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="{{ $slider->gallery }}" alt="" style="height: 550px">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-10 col-lg-8">
                                <p class="fs-5 fw-medium text-white mb-4 pb-2">{{$slider->caption}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
{{-- 1500 675 --}}