@extends('layouts.client.index')

@section('content')
@include('components.breadcrumb', ['title' => 'Product'])

  @include('pages.client.product-detail.content')

  @include('pages.client.product-detail.popular-product')
@endsection