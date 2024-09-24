@extends('layouts.client.index')

@section('content')
  @include('components.breadcrumb', ['title' => 'Wishlist'])

  @include('client.page.wishlist.content')
@endsection