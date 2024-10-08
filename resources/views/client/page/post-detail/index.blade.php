@extends('layouts.client.index')

@section('content')
  @include('components.breadcrumb', ['title' => 'Blog Details'])

  @include('client.page.post-detail.content')
@endsection