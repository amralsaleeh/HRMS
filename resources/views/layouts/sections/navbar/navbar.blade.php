@php
  $containerNav = $containerNav ?? 'container-fluid';
  $navbarDetached = ($navbarDetached ?? '');
@endphp

<!-- Navbar -->
@if(isset($navbarDetached) && $navbarDetached == 'navbar-detached')
  <nav class="layout-navbar {{$containerNav}} navbar navbar-expand-xl {{$navbarDetached}} align-items-center bg-navbar-theme" id="layout-navbar">
@endif

@if(isset($navbarDetached) && $navbarDetached == '')
  <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="{{$containerNav}}">
@endif

  <!--  Brand demo (display only for navbar-full and hide on below xl) -->
  @if(isset($navbarFull))
  <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-4">
    <a href="{{url('/')}}" class="app-brand-link gap-2">
      <span class="app-brand-logo demo">
        @include('_partials.macros',["height"=>20])
      </span>
      <span class="app-brand-text demo menu-text fw-bold">{{config('variables.templateName')}}</span>
    </a>
  </div>
  @endif

  <!-- ! Not required for layout-without-menu -->
  @if(!isset($navbarHideToggle))
  <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0{{ isset($menuHorizontal) ? ' d-xl-none ' : '' }} {{ isset($contentNavbar) ?' d-xl-none ' : '' }}">
    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
      <i class="ti ti-menu-2 ti-sm"></i>
    </a>
  </div>
  @endif

  <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

    <!-- Style Switcher -->
    <div class="navbar-nav align-items-center">
      <a class="nav-link style-switcher-toggle hide-arrow" href="javascript:void(0);">
        <i class='ti ti-sm'></i>
      </a>
    </div>
    <!--/ Style Switcher -->

    <ul class="navbar-nav flex-row align-items-center ms-auto">

      <!-- User -->
      <li class="nav-item navbar-dropdown dropdown-user dropdown">
        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
          <div class="avatar avatar-online">
            <img src="{{ Auth::user() ? Auth::user()->profile_photo_url : asset('assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle">
          </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
          <li>
            <a class="dropdown-item" href="{{ Route::has('profile.show') ? route('profile.show') : 'javascript:void(0);' }}">
              <div class="d-flex">
                <div class="flex-shrink-0 me-3">
                  <div class="avatar avatar-online">
                    <img src="{{ Auth::user() ? Auth::user()->profile_photo_url : asset('assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle">
                  </div>
                </div>
                <div class="flex-grow-1">
                  <span class="fw-semibold d-block">
                    @if (Auth::check())
                      {{ Auth::user()->name }}
                    @else
                      John Doe
                    @endif
                  </span>
                  <small class="text-muted">Admin</small>
                </div>
              </div>
            </a>
          </li>
          <li>
            <div class="dropdown-divider"></div>
          </li>
          <li>
            <a class="dropdown-item" href="{{ Route::has('profile.show') ? route('profile.show') : 'javascript:void(0);' }}">
              <i class="ti ti-user-check me-2 ti-sm"></i>
              <span class="align-middle">My Profile</span>
            </a>
          </li>
          @if (Auth::check() && Laravel\Jetstream\Jetstream::hasApiFeatures())
          <li>
            <a class="dropdown-item" href="{{ route('api-tokens.index') }}">
              <i class='ti ti-key me-2 ti-sm'></i>
              <span class="align-middle">API Tokens</span>
            </a>
          </li>
          @endif
          <li>
            <a class="dropdown-item" href="javascript:void(0);">
              <span class="d-flex align-items-center align-middle">
                <i class="flex-shrink-0 ti ti-credit-card me-2 ti-sm"></i>
                <span class="flex-grow-1 align-middle">Billing</span>
                <span class="flex-shrink-0 badge badge-center rounded-pill bg-label-danger w-px-20 h-px-20">2</span>
              </span>
            </a>
          </li>
          @if (Auth::User() && Laravel\Jetstream\Jetstream::hasTeamFeatures())
          <li>
            <div class="dropdown-divider"></div>
          </li>
          <li>
            <h6 class="dropdown-header">Manage Team</h6>
          </li>
          <li>
            <div class="dropdown-divider"></div>
          </li>
          <li>
            <a class="dropdown-item" href="{{ Auth::user() ? route('teams.show', Auth::user()->currentTeam->id) : 'javascript:void(0)' }}">
              <i class='ti ti-settings me-2'></i>
              <span class="align-middle">Team Settings</span>
            </a>
          </li>
          @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
          <li>
            <a class="dropdown-item" href="{{ route('teams.create') }}">
              <i class='ti ti-user me-2'></i>
              <span class="align-middle">Create New Team</span>
            </a>
          </li>
          @endcan
          <li>
            <div class="dropdown-divider"></div>
          </li>
          <lI>
            <h6 class="dropdown-header">Switch Teams</h6>
          </lI>
          <li>
            <div class="dropdown-divider"></div>
          </li>
          @if (Auth::user())
            @foreach (Auth::user()->allTeams() as $team)
              {{-- Below commented code read by artisan command while installing jetstream. !! Do not remove if you want to use jetstream. --}}
              <x-switchable-team :team="$team" />
            @endforeach
          @endif
          @endif
          <li>
            <div class="dropdown-divider"></div>
          </li>
          @if (Auth::check())
            <li>
              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class='ti ti-logout me-2'></i>
                <span class="align-middle">Logout</span>
              </a>
            </li>
            <form method="POST" id="logout-form" action="{{ route('logout') }}">
              @csrf
            </form>
          @else
            <li>
              <a class="dropdown-item" href="{{ Route::has('login') ? route('login') : url('auth/login-basic') }}">
                <i class='ti ti-login me-2'></i>
                <span class="align-middle">Login</span>
              </a>
            </li>
          @endif
        </ul>
      </li>
      <!--/ User -->
    </ul>
  </div>

  @if(!isset($navbarDetached))
  </div>
  @endif
  </nav>
  <!-- / Navbar -->
