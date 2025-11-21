<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Admin</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport"/>
    <link rel="icon" href="{{ asset('assets/img/logo.png') }}" type="image/png">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Bootstrap Icons (WAJIB UNTUK ICON BI!) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{asset('assets/css/admin/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/admin/plugins.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/admin/kaiadmin.min.css')}}" />

    <link rel="stylesheet" href="{{asset('assets/css/admin/demo.css')}}" />
  </head>
  <body>
    <div class="wrapper">
