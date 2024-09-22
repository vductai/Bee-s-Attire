@extends('layouts.client.index')

@section('content')
@include('components.breadcrumb', ['title' => 'Register'])

  @include('pages.client.register.content')
@endsection