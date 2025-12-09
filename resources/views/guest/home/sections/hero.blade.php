<!-- Carousel Start -->
<div class="header-carousel owl-carousel">

    @if ($sliders->isEmpty())

        <div class="header-carousel-item bg-primary"
            style="
                --desktop-bg: url('{{ asset('assets/img/default_about.jpg') }}');
                --mobile-bg: url('{{ asset('assets/img/default_about.jpg') }}');
            "
            data-desktop="{{ asset('assets/img/default_about.jpg') }}"
            data-mobile="{{ asset('assets/img/default_about.jpg') }}">

            <div class="carousel-caption text-start">
                <div class="container">
                    <h1 class="text-white">Default Banner</h1>
                </div>
            </div>
        </div>

    @else

        @foreach ($sliders as $slider)

            @php
                $desktop = asset($slider->image_url);
                $mobile  = $slider->image_mobile ? asset($slider->image_mobile) : $desktop;
            @endphp

            <div class="header-carousel-item bg-primary"
                style="
                    --desktop-bg: url('{{ $desktop }}');
                    --mobile-bg: url('{{ $mobile }}');
                "
                data-desktop="{{ $desktop }}"
                data-mobile="{{ $mobile }}">

                <div class="carousel-caption text-start">
                    <div class="container">

                        @if($slider->subtitle)
                            <h4 class="text-white text-uppercase fw-bold">
                                {{ $slider->subtitle }}
                            </h4>
                        @endif

                        @if($slider->title)
                            <h1 class="display-1 text-white">
                                {{ $slider->title }}
                            </h1>
                        @endif

                        @if($slider->description)
                            <p class="fs-5 text-white">
                                {{ $slider->description }}
                            </p>
                        @endif

                        @if($slider->button_text && $slider->button_url)
                            <a class="btn btn-light rounded-pill py-3 px-4"
                               href="{{ $slider->button_url }}">
                                {{ $slider->button_text }}
                            </a>
                        @endif

                    </div>
                </div>
            </div>

        @endforeach

    @endif

</div>
<!-- Carousel End -->
