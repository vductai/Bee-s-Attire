@extends('layouts.client.index')

@section('content')
  @include('components.breadcrumb', ['title' => 'Wishlist'])

  @include('pages.client.wishlist.content')
@endsection