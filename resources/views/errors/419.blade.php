@php
  $customizerHidden = 'customizer-hide';
  $configData = Helper::appClasses();
@endphp

@extends('layouts/blankLayout')

@section('title', 'Page Expired')

@section('page-style')
  <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-misc.css') }}">
@endsection

@section('content')
<div class="container-xxl container-p-y">
  <div class="misc-wrapper">
    <h2 class="mb-1 mt-4">{{ __('Page Expired ⏳') }}</h2>
    <p class="mb-4 mx-2">{{ __('It seems the page has expired or the request was submitted incorrectly. Please try reloading the page.') }}</p>
    <a href="{{ url()->previous() }}" class="btn btn-primary mb-4">{{ __('Go Back') }}</a>
    <div class="mt-4">
      <img src="{{ asset('assets/img/illustrations/page-misc-error.png') }}" alt="page-misc-error" width="150" class="img-fluid">
    </div>
  </div>
</div>
<div class="container-fluid misc-bg-wrapper">
  <img src="{{ asset('assets/img/illustrations/bg-shape-image-'.$configData['style'].'.png') }}" alt="page-misc-error" data-app-light-img="illustrations/bg-shape-image-light.png" data-app-dark-img="illustrations/bg-shape-image-dark.png">
</div>
@endsection
