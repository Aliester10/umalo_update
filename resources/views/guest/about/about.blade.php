@extends('layouts.guest.master')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/about.css') }}">

@include('guest.about.sections.hero')
@include('guest.about.sections.intro')
@include('guest.about.sections.vision-mission')
@include('guest.about.sections.brands')
@include('guest.about.sections.core-values')
@include('guest.about.sections.team')
@include('guest.about.sections.production')

<script src="{{ asset('assets/js/about.js') }}"></script>

@endsection

