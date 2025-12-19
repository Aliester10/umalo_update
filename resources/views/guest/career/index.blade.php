@extends('layouts.guest.master3')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('assets/css/career.css') }}">

    @include('guest.career.sections.Hero')
    @include('guest.career.sections.Benefit')
    @include('guest.career.sections.Job-Opening')
    @include('guest.career.sections.CTA')
    @include('guest.career.sections.Application-Modal')
    @include('guest.career.sections.Sucess-modal')

<script src="{{ asset('assets/js/career.js') }}"></script>
@endsection