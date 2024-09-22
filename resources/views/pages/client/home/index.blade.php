@extends('layouts.client.index')

@section('content')
  {{-- hero slider --}}
  @include('pages.client.home.hero')
  
  {{-- categories --}}
  @include('pages.client.home.categories')
  
  {{-- popular product --}}
  @include('pages.client.home.popular-product')
  
  {{-- product banner --}}
  @include('pages.client.home.product-banner')
  
  {{-- service --}}
  @include('pages.client.home.service')
  
  {{-- deal --}}
  @include('pages.client.home.deal')
  
  {{-- popular product --}}
  @include('pages.client.home.product-popular')
  
  {{-- testimonial --}}
  @include('pages.client.home.testimonial')
  
  {{-- blog --}}
  @include('pages.client.home.blog')
@endsection