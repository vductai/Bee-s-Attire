@extends('layouts.client.index')

@section('content')
  {{-- hero slider --}}
  @include('client.page.home.hero')
  
  {{-- categories --}}
  @include('client.page.home.categories')
  
  {{-- popular product --}}
  @include('client.page.home.popular-product')
  
  {{-- product banner --}}
  {{-- @include('client.page.home.product-banner') --}}
  
  {{-- service --}}
  @include('client.page.home.service')
  
  {{-- deal --}}
  @include('client.page.home.deal')
  
  {{-- popular product --}}
  @include('client.page.home.product-popular')
  
  {{-- testimonial --}}
  {{-- @include('client.page.home.testimonial') --}}
  
  {{-- blog --}}
  {{-- @include('client.page.home.blog') --}}
@endsection