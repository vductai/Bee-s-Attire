@extends('layouts.master.index')

@section('head')
  {{-- icon --}}
  <link rel="stylesheet" href="{{ asset('client/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('client/css/animate.css') }}">
  <link rel="stylesheet" href="{{ asset('client/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('client/css/aos.min.css') }}">
  <link rel="stylesheet" href="{{ asset('client/css/remixicon.css') }}">
  <link rel="stylesheet" href="{{ asset('client/css/range-slider.css') }}">
  <link rel="stylesheet" href="{{ asset('client/css/swiper-bundle.min.css') }}">
  <link rel="stylesheet" href="{{ asset('client/css/swiper-bundle.min.css') }}">
  <link rel="stylesheet" href="{{ asset('client/css/jquery.slick.css') }}">
  <link rel="stylesheet" href="{{ asset('client/css/slick-theme.css') }}">
  {{-- end icon --}}

  <link rel="stylesheet" href="{{ asset('client/css/style.css') }}">
@endsection

@section('header')
  @include('layouts.client.header') 
@endsection

@section('master-content')
  <div class="body-bg-6">
    <div id="cr-overlay">
      <span class="loader"></span>
    </div>
    
    @yield('content')
  </div>
@endsection

@section('footer')
  @include('layouts.client.footer') 

  <script src="{{ asset('client/js/vendor/jquery-3.6.4.min.js') }}"></script>
  <script src="{{ asset('client/js/vendor/jquery.zoom.min.js') }}"></script>
  <script src="{{ asset('client/js/vendor/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('client/js/vendor/mixitup.min.js') }}"></script>
  <script src="{{ asset('client/js/vendor/range-slider.js') }}"></script>
  <script src="{{ asset('client/js/vendor/aos.min.js') }}"></script>
  <script src="{{ asset('client/js/vendor/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('client/js/vendor/slick.min.js') }}"></script>
  <script src="{{ asset('client/js/main.js') }}"></script>
@endsection