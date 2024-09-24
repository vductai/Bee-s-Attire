@extends('layouts.client.index')

@section('content')
@include('components.breadcrumb', ['title' => 'Register'])

  @include('client.page.register.content')
@endsection