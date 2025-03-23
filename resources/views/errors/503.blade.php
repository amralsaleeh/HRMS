@php
  $customizerHidden = 'customizer-hide';
  $configData = Helper::appClasses();
@endphp

@extends('layouts/blankLayout')

@section('title', 'Under Maintenance')

@section('page-style')
  <link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-misc.css')}}">
@endsection

@section('content')
<!--Under Maintenance -->
<div class="container-xxl">
  <div class="misc-wrapper">
    <h2 class="mb-1 mx-2">Under Maintenance!</h2>
    <p class="mb-4 mx-2">
      Sorry for the inconvenience but we're performing some maintenance at the moment
    </p>
    <button class="btn btn-label-secondary" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
      Logout
    </button>
    <form method="POST" id="logout-form" action="{{ route('logout') }}">
      @csrf
    </form>
    {{-- <a href="{{url('/')}}" class="btn btn-primary mb-4">Back to home</a> --}}
    <div class="mt-4">
      <img src="{{ asset('assets/img/illustrations/page-misc-under-maintenance.png') }}" alt="page-misc-under-maintenance" width="400" class="img-fluid">
    </div>
  </div>
</div>
<div class="container-fluid misc-bg-wrapper misc-under-maintenance-bg-wrapper">
  <img src="{{ asset('assets/img/illustrations/bg-shape-image-'.$configData['style'].'.png') }}" alt="page-misc-under-maintenance" data-app-light-img="illustrations/bg-shape-image-light.png" data-app-dark-img="illustrations/bg-shape-image-dark.png">
</div>
<!-- /Under Maintenance -->
@endsection
