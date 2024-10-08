@extends('layouts.client.index')

@section('content')
  @include('components.breadcrumb', ['title' => 'Login'])

  @include('client.page.login.content')
@endsection