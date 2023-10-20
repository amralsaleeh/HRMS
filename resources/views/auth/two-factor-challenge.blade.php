@php
$customizerHidden = 'customizer-hide';
$configData = Helper::appClasses();
@endphp

@extends('layouts/blankLayout')

@section('title', '2 Factor Challenge')

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
        <img src="{{ asset('assets/img/illustrations/auth-two-step-illustration-'.$configData['style'].'.png') }}" alt="auth-two-steps-cover" class="img-fluid my-5 auth-illustration" data-app-light-img="illustrations/auth-two-step-illustration-light.png" data-app-dark-img="illustrations/auth-two-step-illustration-dark.png">

        <img src="{{ asset('assets/img/illustrations/bg-shape-image-'.$configData['style'].'.png') }}" alt="auth-two-steps-cover" class="platform-bg" data-app-light-img="illustrations/bg-shape-image-light.png" data-app-dark-img="illustrations/bg-shape-image-dark.png">
      </div>
    </div>
    <!-- /Left Text -->

    <!-- Two Steps Verification -->
    <div class="d-flex col-12 col-lg-5 align-items-center p-4 p-sm-5">
      <div class="w-px-400 mx-auto">
        <!-- Logo -->
        <div class="app-brand mb-4">
          <a href="{{url('/')}}" class="app-brand-link">
            <span class="app-brand-logo demo">@include('_partials.macros',['height'=>20,'withbg' => "fill: #fff;"])</span>
          </a>
        </div>
        <!-- /Logo -->
        <h3 class="mb-1">Two Step Verification 💬</h3>
        <div x-data="{ recovery: false }">
          <div class="mb-3" x-show="! recovery">
            Please confirm access to your account by entering the authentication code provided by your authenticator application.
          </div>

          <div class="mb-3" x-show="recovery">
            Please confirm access to your account by entering one of your emergency recovery codes.
          </div>

          <x-validation-errors class="mb-1" />

          <form method="POST" action="{{ route('two-factor.login') }}">
            @csrf

            <div class="mb-3" x-show="! recovery">
              <x-label class="form-label" value="{{ __('Code') }}" />
              <x-input class="{{ $errors->has('code') ? 'is-invalid' : '' }}" type="text" inputmode="numeric" name="code" autofocus x-ref="code" autocomplete="one-time-code" />
              <x-input-error for="code"></x-input-error>
            </div>

            <div class="mb-3" x-show="recovery">
              <x-label class="form-label" value="{{ __('Recovery Code') }}" />
              <x-input class="{{ $errors->has('recovery_code') ? 'is-invalid' : '' }}" type="text" name="recovery_code" x-ref="recovery_code" autocomplete="one-time-code" />
              <x-input-error for="recovery_code"></x-input-error>
            </div>

            <div class="d-flex justify-content-end my-2 gap-2">
              <div x-show="! recovery" x-on:click="recovery = true; $nextTick(() => { $refs.recovery_code.focus()})">
                <button type="button" class="btn btn-outline-secondary me-1">Use a recovery code</button>
              </div>
              <div x-cloak x-show="recovery" x-on:click="recovery = false; $nextTick(() => { $refs.code.focus() })">
                <button type="button" class="btn btn-outline-secondary me-1">Use an authentication code</button>
              </div>
              <x-button>Log in</x-button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- / Two Steps Verification -->
  </div>
</div>

@endsection