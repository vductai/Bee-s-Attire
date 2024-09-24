@extends('layouts.client.index')

@section('content')
@include('components.breadcrumb', ['title' => 'Product'])

  @include('client.page.product-detail.content')

  @include('client.page.product-detail.popular-product')
@endsection