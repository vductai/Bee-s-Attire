@extends('layouts.client.index')

@section('content')
  @include('components.breadcrumb', ['title' => 'Blog Details'])

  @include('pages.client.post-detail.content')
@endsection