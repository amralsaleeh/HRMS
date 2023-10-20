@php
$customizerHidden = 'customizer-hide';
$configData = Helper::appClasses();
@endphp

@extends('layouts/blankLayout')

@section('title', 'Forgot Password')

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" href="{{ asset(mix('assets/vendor/css/pages/page-auth.css')) }}">
@endsection

@section('content')
<div class="authentication-wrapper authentication-cover authentication-bg">
  <div class="authentication-inner row">
    <!-- /Left Text -->
    <div class="d-none d-lg-flex col-lg-7 p-0">
      <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
        <img src="{{ asset('assets/img/illustrations/auth-forgot-password-illustration-'.$configData['style'].'.png') }}" alt="auth-forgot-password-cover" class="img-fluid my-5 auth-illustration" data-app-light-img="illustrations/auth-forgot-password-illustration-light.png" data-app-dark-img="illustrations/auth-forgot-password-illustration-dark.png">

        <img src="{{ asset('assets/img/illustrations/bg-shape-image-'.$configData['style'].'.png') }}" alt="auth-forgot-password-cover" class="platform-bg" data-app-light-img="illustrations/bg-shape-image-light.png" data-app-dark-img="illustrations/bg-shape-image-dark.png">
      </div>
    </div>
    <!-- /Left Text -->
    <!-- Forgot Password -->
    <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
      <div class="w-px-400 mx-auto">
        <!-- Logo -->
        <div class="app-brand mb-4">
          <a href="{{url('/')}}" class="app-brand-link">
            <span class="app-brand-logo demo">@include('_partials.macros',["height"=>20,"withbg"=>'fill: #fff;'])</span>
          </a>
        </div>
        <!-- /Logo -->
        <h3 class="mb-1">Forgot Password? 🔒</h3>
        <p class="mb-4">Enter your email and we'll send you instructions to reset your password</p>

        @if (session('status'))
        <div class="mb-1 text-success">
          {{ session('status') }}
        </div>
        @endif

        <form id="formAuthentication" class="mb-3" action="{{ route('password.email') }}" method="POST">
          @csrf
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="john@example.com" autofocus>
            @error('email')
            <span class="invalid-feedback" role="alert">
              <span class="fw-medium">{{ $message }}</span>
            </span>
            @enderror
          </div>
          <button type="submit" class="btn btn-primary d-grid w-100">Send Reset Link</button>
        </form>
        <div class="text-center">
          @if (Route::has('login'))
          <a href="{{ route('login') }}" class="d-flex align-items-center justify-content-center">
            <i class="ti ti-chevron-left scaleX-n1-rtl"></i>
            Back to login
          </a>
          @endif
        </div>
      </div>
    </div>
    <!-- /Forgot Password -->
  </div>
</div>
@endsection