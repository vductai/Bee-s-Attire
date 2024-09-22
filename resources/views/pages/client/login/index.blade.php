@extends('layouts.client.index')

@section('content')
  @include('components.breadcrumb', ['title' => 'Login'])

  @include('pages.client.login.content')
@endsection