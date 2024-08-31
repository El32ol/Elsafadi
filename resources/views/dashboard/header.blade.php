<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="{{ App::currentLocale() }}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> {{ $title ?? 'default' }}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset ('assets/dashboard/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  @if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl' )
  <link rel="stylesheet" href="{{ asset('assets/dashboard/dist/css/adminltear.min.css') }}">
    @else
  <link rel="stylesheet" href="{{ asset('assets/dashboard/dist/css/adminlte.min.css') }}">
  @endif
  @yield('css')

</head>