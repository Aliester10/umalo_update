@extends('layouts.guest.master')

@section('content')
                   <!-- Header Start -->
                   <div class="container-fluid bg-breadcrumb" style="background: linear-gradient(rgb(7, 51, 7), rgba(0, 0, 0, 0.2)), url('{{ asset('assets/img/default_about.jpg') }}');     position: relative; overflow: hidden; background-position: center center; background-repeat: no-repeat; background-size: cover; padding: 60px 0; transition: 0.5s;">
                    <div class="container text-center py-5" style="max-width: 900px;">
                        <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">{{ __('messages.company_activity') }}</h4>
                        <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                            <li class="breadcrumb-item"><a href="{{ route('home')  }}">{{ __('messages.home') }}</a></li>
                            <li class="breadcrumb-item active text-primary">{{ __('messages.detail_activity') }}</li>            
                        </ol>    
                    </div>
                </div>
                <!-- Header End -->

    <!-- Activity 2 Start -->
    <div id="act-1" class="container-fluid appointment py-5">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-12 wow fadeInLeft" data-wow-delay="0.2">
                    <div class="section-title text-start">
                        <h1 class="display-4 mb-4">{{ $activity->title }}</h1>
                        <p class="mb-4"
                            style="
                                font-size: 0.875rem;
                                color: #6c757d;
                                margin: 0;
                                line-height: 1.5;
                                overflow: hidden;
                                white-space: normal;
                                word-wrap: break-word;
                                text-align: justify;
                            ">
                            <i class="fa fa-calendar-alt text-primary"></i>
                            {{ $activity->date->format('d M Y') }}
                        </p>
                        <div class="row g-4">
                            <div class="col-sm-12">
                                <div class="video h-100">
                                    <img src="{{ asset($activity->images) }}"
                                        class="img-fluid rounded w-100 h-100"
                                        style="object-fit: cover; margin-bottom: 20px;" alt="">
                                </div>
                            </div>
                        </div>
                        <p class="mb-4"
                            style="
                                font-size: 1rem;
                                color: #6c757d;
                                margin: 0;
                                line-height: 1.5;
                                text-align: justify;
                                margin-top: 20px; /* Jarak antara gambar dan deskripsi */
                            ">
                            {{ $activity->description }}
                        </p>
                    </div>
                </div>
                <div class="text-center mt-5 wow fadeInRight" data-wow-delay="0.2">
                    <a href="{{ route('activity') }} " class="btn btn-primary">{{ __('messages.back') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
