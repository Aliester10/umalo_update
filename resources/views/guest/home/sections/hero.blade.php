<!-- Carousel Start -->
<div class="header-carousel owl-carousel">
    @if ($sliders->isEmpty())
        <div class="header-carousel-item bg-primary" style="background-image: url('{{ asset('assets/img/default_about.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
            <div class="carousel-caption text-start">
                <div class="container">
                    <div class="row g-4 align-items-center justify-content-center">
                        <div class="col-lg-12 animated fadeInLeft">
                            <div class="text-start">
                                <h4 class="text-white text-uppercase fw-bold mb-4">{{ __('messages.welcome') }}</h4>
                                <h1 class="display-1 text-white mb-4">{{ __('messages.slogan') }}</h1>

                                <div class="d-flex justify-content-start flex-shrink-0 mb-4 mt-5">
                                    <a class="btn btn-light rounded-pill py-3 px-4 px-md-5 ms-2"
                                       href="{{ route('about') }}">
                                        {{ __('messages.explore_services') }}
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        @foreach ($sliders as $slider)
            <div class="header-carousel-item bg-primary"
                 style="background-image: url('{{ asset($slider->image_url) }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">

                <div class="carousel-caption text-start">
                    <div class="container">
                        <div class="row g-4 align-items-center justify-content-center">
                            <div class="col-lg-12 animated fadeInLeft">
                                <div class="text-start">

                                    <h4 class="text-white text-uppercase fw-bold">{{ $slider->subtitle }}</h4>
                                    <h1 class="display-1 text-white">{{ $slider->title }}</h1>

                                    @if($slider->description)
                                        <p class="fs-5">{{ $slider->description }}</p>
                                    @endif

                                    @if($slider->button_text && $slider->button_url)
                                        <div class="d-flex justify-content-start flex-shrink-0">
                                            <a class="btn btn-light rounded-pill py-3 px-4 px-md-5 ms-2"
                                               href="{{ $slider->button_url }}">
                                                {{ $slider->button_text }}
                                            </a>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        @endforeach
    @endif
</div>
<!-- Carousel End -->
