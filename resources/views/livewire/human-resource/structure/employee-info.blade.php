<div>

  @php
    $configData = Helper::appClasses();
  @endphp

  @section('title', 'Employee Info')

  @section('vendor-style')

  @endsection

  @section('page-style')

  @endsection

<!-- Header -->
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      {{-- <div class="user-profile-header-banner">
        <img src="{{ asset('assets/img/pages/profile-banner.png') }}" alt="Banner image" class="rounded-top">
      </div> --}}
      <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
        <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
          <img src="{{ asset($employee->getEmployeePhoto()) }}" class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" width="100px">
        </div>
        <div class="flex-grow-1 mt-3 mt-sm-5">
          <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
            <div class="user-profile-info">
              <h4>{{ $employee->fullName }}</h4>
              <ul class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                <li class="list-inline-item">
                    <i class="ti ti-id"></i> {{ $employee->id }}
                  </li>
                  <li class="list-inline-item">
                    <i class="ti ti-map-pin"></i> {{ $employee->current_position }}
                  </li>
                  <li class="list-inline-item">
                    <i class="ti ti-building"></i> {{ $employee->current_department }}
                  </li>
                  <li class="list-inline-item">
                    <i class="ti ti-building-community"></i> {{ $employee->current_center }}
                  </li>
                  <li class="list-inline-item">
                    <i class="ti ti-calendar"></i> {{ $employee->join_at }}
                  </li>
              </ul>
            </div>
            <a href="javascript:void(0)" class="btn btn-primary">
              <i class='ti ti-user-check me-1'></i>@if ($employee->is_active == 1) <span> Active </span>@else <span> Not Active </span> @endif
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--/ Header -->

<!-- Navbar pills -->
{{-- <div class="row">
  <div class="col-md-12">
    <ul class="nav nav-pills flex-column flex-sm-row mb-4">
      <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i class='ti-xs ti ti-user-check me-1'></i> Profile</a></li>
      <li class="nav-item"><a class="nav-link" href="{{url('pages/profile-teams')}}"><i class='ti-xs ti ti-users me-1'></i> Teams</a></li>
      <li class="nav-item"><a class="nav-link" href="{{url('pages/profile-projects')}}"><i class='ti-xs ti ti-layout-grid me-1'></i> Projects</a></li>
      <li class="nav-item"><a class="nav-link" href="{{url('pages/profile-connections')}}"><i class='ti-xs ti ti-link me-1'></i> Connections</a></li>
    </ul>
  </div>
</div> --}}
<!--/ Navbar pills -->

<!-- User Profile Content -->
<div class="row">
  <div class="col-xl-4 col-lg-5 col-md-5">
    <!-- About User -->
    <div class="card mb-4">
      <div class="card-body">
        <h5 class="card-action-title mb-0">About</h5>
        <ul class="list-unstyled mb-4 mt-3">
          <li class="d-flex align-items-center mb-3"><i class="ti ti-flag"></i><span class="fw-bold mx-2">Address:</span> <span>{{ $employee->address }}</span></li>
        </ul>
        <small class="card-text text-uppercase">Contacts</small>
        <ul class="list-unstyled mb-4 mt-3">
          <li class="d-flex align-items-center mb-3"><i class="ti ti-phone-call"></i><span class="fw-bold mx-2">Mobile:</span> <span>{{'+963 '. $employee->mobile_number }}</span></li>
        </ul>
      </div>
    </div>
    <!--/ About User -->
    <!-- Profile Overview -->
    <div class="card mb-4">
      <div class="card-body">
        <h5 class="card-action-title mb-0">Counters</h5>
        <ul class="list-unstyled mb-0 mt-3">
          <li class="d-flex align-items-center mb-3"><i class="ti ti-check"></i><span class="fw-bold mx-2">Hourly:</span> <span>{{ $employee->hourly_counter }}</span></li>
          <li class="d-flex align-items-center mb-3"><i class="ti ti-layout-grid"></i><span class="fw-bold mx-2">Delay:</span> <span>{{ $employee->delay_counter }}</span></li>
      </div>
    </div>
    <!--/ Profile Overview -->
  </div>
  <div class="col-xl-8 col-lg-7 col-md-7">
    <!-- Activity Timeline -->
    <div class="card card-action mb-4">
      <div class="card-header align-items-center">
        <h5 class="card-action-title mb-0">Timeline</h5>
        <div class="card-action-element">
          <div class="dropdown">
            <button type="button" class="btn dropdown-toggle hide-arrow p-0" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-dots-vertical text-muted"></i></button>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#add-timeline">Add timeline</a></li>
              <li><a class="dropdown-item" href="javascript:void(0);">Edit history</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="card-body pb-0">
        <ul class="timeline ms-1 mb-0">
          @foreach ($timelines as $timeline)
            <li class="timeline-item timeline-item-transparent">
              <span class="timeline-point timeline-point-primary"></span>
              <div class="timeline-event">
                <div class="timeline-header">
                  <h6 class="mb-0">{{ $timeline->position->name }}</h6>
                  <small class="text-muted">10 day ago</small>
                </div>
                <p class="mb-2">{{ $timeline->start_date }} --> {{ $timeline->end_date }}</p>
              </div>
            </li>
          @endforeach
          <li class="timeline-item timeline-item-transparent border-0">
            <span class="timeline-point timeline-point-info"></span>
            <div class="timeline-event">
              <div class="timeline-header">
                <h6 class="mb-0">Project status updated</h6>
                <small class="text-muted">10 Day Ago</small>
              </div>
              <p class="mb-0">Woocommerce iOS App Completed</p>
            </div>
          </li>
        </ul>
      </div>
    </div>
    <!--/ Activity Timeline -->
  </div>
</div>
<!--/ User Profile Content -->

  @push('custom-scripts')

  @endpush
  @include('_partials\_modals\model-add-timeline')
</div>
