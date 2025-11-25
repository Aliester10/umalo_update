@extends('layouts.guest.master')

@section('content')

    {{-- CSS khusus home --}}
    <link rel="stylesheet" href="{{ asset('assets/css/home.css') }}">

    {{-- Sections --}}
    @include('guest.home.sections.hero')
    @include('guest.home.sections.about')
    @include('guest.home.sections.products')
    @include('guest.home.sections.services')
    @include('guest.home.sections.brands')
    @include('guest.home.sections.contact-form')
    @include('guest.home.sections.contact-info')
    @include('guest.home.sections.modals')

    {{-- JS khusus home --}}
    <script src="{{ asset('assets/js/home.js') }}"></script>

@endsection
