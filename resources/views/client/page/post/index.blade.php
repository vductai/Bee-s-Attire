@extends('layouts.client.index')

@section('content')
  @include('components.breadcrumb', ['title' => 'Blog'])

  @include('client.page.post.content')
@endsection