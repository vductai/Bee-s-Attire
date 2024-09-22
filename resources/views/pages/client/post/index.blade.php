@extends('layouts.client.index')

@section('content')
  @include('components.breadcrumb', ['title' => 'Blog'])

  @include('pages.client.post.content')
@endsection