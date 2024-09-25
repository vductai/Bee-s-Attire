@extends('layouts.master.index')

@section('head')
    {{-- icon --}}
    <link rel="stylesheet" href="{{ asset('css/fonts/vendor/dematerializations.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fonts/vendor/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fonts/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fonts/vendor/aos.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fonts/icon/remix icon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/range-slider.css') }}">
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.slick.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slick-theme.css') }}">
    {{-- end icon --}}

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
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

    <script src="{{ asset('js/vendor/jquery-3.6.4.min.js') }}"></script>
    <script src="{{ asset('js/vendor/jquery.zoom.min.js') }}"></script>
    <script src="{{ asset('js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/vendor/mixitup.min.js') }}"></script>
    <script src="{{ asset('js/vendor/range-slider.js') }}"></script>
    <script src="{{ asset('js/vendor/aos.min.js') }}"></script>
    <script src="{{ asset('js/vendor/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('js/vendor/slick.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
@endsection
