@extends('layouts.layoutMaster')

@php
$breadcrumbs = [['link' => 'home', 'name' => 'Home'], ['link' => 'javascript:void(0)', 'name' => 'User'], ['name' => 'Profile']];
@endphp

@section('title', 'Profile')


@section('content')

  @if (Laravel\Fortify\Features::canUpdateProfileInformation())
   <div class="mb-4">
      @livewire('profile.update-profile-information-form')
   </div>
  @endif

  @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
    <div class="mb-4">
      @livewire('profile.update-password-form')
    </div>
  @endif

  @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
   <div class="mb-4">
      @livewire('profile.two-factor-authentication-form')
   </div>
  @endif

  <div class="mb-4">
    @livewire('profile.logout-other-browser-sessions-form')
  </div>

  @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
    @livewire('profile.delete-user-form')
  @endif

@endsection
