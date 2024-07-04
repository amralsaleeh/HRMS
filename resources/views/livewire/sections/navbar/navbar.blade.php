<div>

  @php
    $configData = Helper::appClasses();
    use App\Models\Employee;
  @endphp

  @push('custom-css')
    <style>
      .animation-fade {
          animation: fade 2s infinite;
      }
      .animation-rotate {
          animation: rotation 2s infinite;
      }
      @keyframes fade {
          0% {
              opacity: 1;
          }
          50% {
              opacity: 0;
          }
          100% {
              opacity: 1;
          }
      }
      @keyframes rotation {
          from {
              transform: rotate(0deg);
          }
          to {
              transform: rotate(360deg);
          }
      }
    </style>
  @endpush

  @php
    $containerNav = $containerNav ?? 'container-fluid';
    $navbarDetached = ($navbarDetached ?? 'navbar-detached');
    // $navbarDetached = ($navbarDetached ?? '');
    // $navbarHideToggle = ($navbarDetached ?? true);
    use Illuminate\Support\Facades\App;
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
          <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0{{ isset($menuHorizontal) ? ' d-xl-none ' : '' }} {{ isset($contentNavbar) ?' d-xl-none ' : '' }} d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
              <i class="ti ti-menu-2 ti-sm"></i>
            </a>
          </div>
        @endif

        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
          <div class="navbar-nav d-flex flex-row align-items-center">
            <!-- Style Switcher -->
            <a wire:ignore class="nav-link style-switcher-toggle hide-arrow" href="javascript:void(0);">
              <i class='ti ti-sm'></i>
            </a>
            <!--/ Style Switcher -->

            <!-- Offline Indicator -->
            <div wire:offline>
              <a class="nav-link dropdown-toggle hide-arrow">
                <i class="animation-fade ti ti-wifi-off fs-3 mx-2"></i>
              </a>
            </div>
            <!-- Offline Indicator -->
          </div>

          <ul class="navbar-nav flex-row align-items-center ms-auto">

            <!-- Progress Bar -->
            @if ($activeProgressBar)
              <li wire:poll.1s="updateProgressBar" class="nav-item mx-3" style="width: 250px;">
                <div class="progress" style="height: 20px;">
                  <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" style="width: {{ $percentage }}%;" aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100">{{ $percentage }}%</div>
                </div>
              </li>
            @else
              @if (session()->has('success'))
                <div class="nav-item mx-3 text-success">
                     {{ session('success') }}
                </div>
              @endif
              @if (session()->has('error'))
                <div class="nav-item mx-3 text-danger">
                     {{ session('error') }}
                </div>
              @endif
            @endif
            <!-- Progress Bar -->

            <!-- Language -->
            <li class="nav-item dropdown-language dropdown me-2 me-xl-1">
              <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                <i class="fi fi-us fis rounded-circle me-1 fs-3"></i>
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li>
                  <a class="dropdown-item {{ App::getLocale() == 'ar' ? 'selected' : '' }}" href="{{ url('lang/ar') }}" data-language="ar" data-text-direction="rtl">
                    <i class="fi fi-sy fis rounded-circle me-1 fs-3"></i>
                    <span class="align-middle">العربية</span>
                  </a>
                </li>
                <li>
                  <a class="dropdown-item {{ App::getLocale() == 'en' ? 'selected' : '' }}" href="{{ url('lang/en') }}" data-language="en" data-text-direction="ltr">
                    <i class="fi fi-us fis rounded-circle me-1 fs-3"></i>
                    <span class="align-middle">English</span>
                  </a>
                </li>
              </ul>
            </li>
            <!-- Language -->

            <!-- Notification -->
            <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-2">
              <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                <i class="ti ti-bell ti-md"></i>
                @if (count($unreadNotifications))
                  <span class="badge bg-danger rounded-pill badge-notifications">{{ count($unreadNotifications) }}</span>
                @endif
              </a>
              <ul wire:ignore.self class="dropdown-menu dropdown-menu-end py-0">
                <li class="dropdown-menu-header border-bottom">
                  <div class="dropdown-header d-flex align-items-center py-3">
                    <h5 class="text-body mb-0 me-auto">{{ __('Notifications') }}</h5>
                    @if (count($unreadNotifications))
                      <a wire:click.prevent='markAllNotificationsAsRead()' href="" class="dropdown-notifications-all text-body mx-2"><i class="ti ti-mail-opened fs-4"></i></a>
                    @endif
                    <div wire:loading.class='animation-rotate'>
                        <a wire:click.prevent='$refresh' href="" class="dropdown-notifications-all text-body"><i class="ti ti-refresh fs-4"></i></a>
                    </div>
                  </div>
                </li>
                <li class="dropdown-notifications-list scrollable-container ps">
                  <ul class="list-group list-group-flush">
                    @forelse ($unreadNotifications as $notification)
                      <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar">
                              @php
                                  $employee = Employee::find($notification->data['employee_id']);
                                  $imageSrc = Storage::disk("public")->exists($employee->profile_photo_path) ? Storage::disk("public")->url($employee->profile_photo_path) : Storage::disk("public")->url('profile-photos/.default-photo.jpg')
                              @endphp
                              <img src="{{ $imageSrc }}" class="h-auto rounded-circle">
                              {{-- <span class="avatar-initial rounded-circle bg-label-success"><i class="ti ti-chart-pie"></i></span> --}}
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <h6 class="mb-1">{{ $notification->data['user'] }}</h6>
                            <p class="mb-0">{{ __($notification->data['message']) }}</p>
                            <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                          </div>
                          <div class="flex-shrink-0 dropdown-notifications-actions">
                            <a wire:click="markNotificationAsRead('{{ $notification->id }}')" class="dropdown-notifications-read"><button class="btn btn-xs rounded-pill btn-outline-primary waves-effect">Mark as read</button></a>
                          </div>
                        </div>
                      </li>
                    @empty
                      <li class="border-top">
                        <p class="d-flex justify-content-center text-muted m-3 p-2 h-px-40 align-items-center" style="text-align: center">
                          {{ __('Time to relax!') }}
                          <br>
                          {{ __('No new updates to worry about') }}
                        </p>
                      </li>
                    @endforelse
                  </ul>
                <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></li>
                <li class="dropdown-menu-footer border-top">
                  <a href="#" class="dropdown-item d-flex justify-content-center text-primary p-2 h-px-40 mb-1 align-items-center"
                    style="opacity: 0.5;pointer-events: none;">
                    {{ __('View all notifications') }}
                  </a>
                </li>
              </ul>
            </li>
            <!-- Notification -->

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
                            !!No Name!!
                          @endif
                        </span>
                        <small class="text-muted">{{ Auth::user()->getRoleNames()->first() }}</small>
                      </div>
                    </div>
                  </a>
                </li>
                {{-- <li>
                  <div class="dropdown-divider"></div>
                </li> --}}
                {{-- <li>
                  <a class="dropdown-item" href="{{ Route::has('profile.show') ? route('profile.show') : 'javascript:void(0);' }}">
                    <i class="ti ti-user-check me-2 ti-sm"></i>
                    <span class="align-middle">My Profile</span>
                  </a>
                </li> --}}
                {{-- <li>
                  <a class="dropdown-item" href="javascript:void(0);">
                    <span class="d-flex align-items-center align-middle">
                      <i class="flex-shrink-0 ti ti-credit-card me-2 ti-sm"></i>
                      <span class="flex-grow-1 align-middle">Billing</span>
                      <span class="flex-shrink-0 badge badge-center rounded-pill bg-label-danger w-px-20 h-px-20">2</span>
                    </span>
                  </a>
                </li> --}}
                <li>
                  <div class="dropdown-divider"></div>
                </li>
                @if (Auth::check())
                  <li>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                      <i class='ti ti-logout me-2'></i>
                      <span class="align-middle">{{ __('Sign out') }}</span>
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
</div>
