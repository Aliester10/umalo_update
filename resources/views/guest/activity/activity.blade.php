@extends('layouts.guest.master')

@section('content')

<link rel="stylesheet" href="{{ asset('assets/css/activity.css') }}">

    {{-- activity-sections --}}
    @include('guest.activity.activity-sections.hero')
    @include('guest.activity.activity-sections.filter')
    @include('guest.activity.activity-sections.grid')
    @include('guest.activity.activity-sections.cta')

<script src="{{ asset('assets/js/activity.js') }}"></script>
@endsection