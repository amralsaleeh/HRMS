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
    <h2 class="mb-1">{{ __('Under Maintenance!') }}</h2>
    <p>
      {{ __('Attention! The page is scheduled for a refined refresh in:') }}
    </p>
    <h3 id="timer">00:15:00:0</h3>
    <button class="btn btn-label-secondary mt-3" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
      {{ __('Logout') }}
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

@push('custom-scripts')
  <script>
    let totalMilliseconds = 900000;
    const timerElement = document.getElementById('timer');

    const countdown = setInterval(() => {
        let hours = Math.floor(totalMilliseconds / (1000 * 3600));
        let minutes = Math.floor((totalMilliseconds % (1000 * 3600)) / (1000 * 60));
        let seconds = Math.floor((totalMilliseconds % (1000 * 60)) / 1000);
        let milliseconds = totalMilliseconds % 1000;

        hours = hours < 10 ? "0" + hours : hours;
        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        let milliDisplay = Math.floor(milliseconds / 100);

        timerElement.textContent = `${hours}:${minutes}:${seconds}.${milliDisplay}`;

        if (totalMilliseconds <= 0) {
            clearInterval(countdown);
            window.location.reload();
        }

        totalMilliseconds -= 100;
    }, 100);
</script>
@endpush
