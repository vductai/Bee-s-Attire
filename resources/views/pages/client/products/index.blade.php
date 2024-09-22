@extends('layouts.client.index')

@section('content')
@include('components.breadcrumb', ['title' => 'Shop'])

  @include('pages.client.products.content')
  
  @include('pages.client.products.filter-sidebar')
@endsection