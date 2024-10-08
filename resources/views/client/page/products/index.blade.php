@extends('layouts.client.index')

@section('content')
@include('components.breadcrumb', ['title' => 'Shop'])

  @include('client.page.products.content')
  
  @include('client.page.products.filter-sidebar')
@endsection