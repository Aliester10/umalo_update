<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>{{ $company->company_name ?? 'Umalo' }} - {{ $company->slogan ?? 'Way To Know' }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="{{ $company->keywords ?? '' }}" name="keywords">
    <meta content="{{ $company->description ?? '' }}" name="description">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset($company->logo ?? 'assets/img/logo.png') }}" type="image/png">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Inter:slnt,wght@-10..0,100..900&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('assets/lib/member/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/lib/member/lightbox/css/lightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/lib/member/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Flickity CSS -->
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('assets/css/member/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('assets/css/member/style.css') }}" rel="stylesheet">
    
    <!-- Loading Animation Stylesheet - TAMBAHAN BARU -->
    <link href="{{ asset('assets/css/member/loading-animation.css') }}" rel="stylesheet">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @stack('styles')
</head>

<body>
    {{-- Include Loader Component --}}
    @include('layouts.guest.loader')