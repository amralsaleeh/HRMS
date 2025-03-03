<div>

@php
  $configData = Helper::appClasses();
@endphp

@section('title', 'Employee Info - Structure')

@section('page-style')
  <style>
    .timeline-icon {
      cursor: pointer;
      opacity: 0;
    }

    .timeline-row:hover .timeline-icon {
      display: inline-block;
      opacity: 1;
    }
  </style>

  <style>
    .btn-tr {
      opacity: 0;
    }

    tr:hover .btn-tr {
      display: inline-block;
      opacity: 1;
    }

    tr:hover .td {
      color: #7367f0 !important;
    }
  </style>
@endsection

{{-- Alerts --}}
@include('_partials/_alerts/alert-general')

<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      {{-- <div class="user-profile-header-banner">
        <img src="{{ asset('assets/img/pages/profile-banner.png') }}" alt="Banner image" class="rounded-top">
      </div> --}}
      <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
        <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
          <img src="{{ Storage::disk("public")->exists($employee->profile_photo_path) ? Storage::disk("public")->url($employee->profile_photo_path) : Storage::disk("public")->url('profile-photos/.default-photo.jpg') }}" class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" width="100px">
        </div>
        <div class="flex-grow-1 mt-3 mt-sm-5">
          <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
            <div class="user-profile-info">
              <h4>{{ $employee->fullName }}</h4>
              <ul class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                <li class="list-inline-item">
                  <span class="badge rounded-pill bg-label-primary"><i class="ti ti-id"></i> {{ $employee->id }}</span>
                </li>
                <li class="list-inline-item">
                  <i class="ti ti-building-community"></i> {{ $employee->current_center }}
                </li>
                <li class="list-inline-item">
                  <i class="ti ti-building"></i> {{ $employee->current_department }}
                </li>
                <li class="list-inline-item">
                  <i class="ti ti-map-pin"></i> {{ $employee->current_position }}
                </li>
                <li class="list-inline-item">
                  <i class="ti ti-rocket"></i> {{ $employee->join_at_short_form }}
                </li>
                <li class="list-inline-item">
                  <i class="ti ti-player-track-next"></i> {{ __('Continuity') . ": " . $employee->worked_years . " " . __('years') }}
                </li>
              </ul>
            </div>
            <button wire:click='toggleActive' type="button" class="btn @if ($employee->is_active == 1)  btn-success @else btn-danger  @endif waves-effect waves-light">
              <span class="ti @if ($employee->is_active == 1) ti-user-check @else ti-user-x @endif me-1"></span>
              @if ($employee->is_active == 1) {{ __('Active') }} @else {{ __('Inactive') }}  @endif
            </button>
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

<div class="row">
    <!-- Assets -->
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header">
        <h5 class="card-title mb-0">{{ __('Assets') }}</h5>
      </div>
      <div class="table-responsive text-nowrap">
        <table class="table table-hover">
          <thead>
            <tr>
              <th class="col-1">{{ __('ID') }}</th>
              <th class="col-1">{{ __('Category') }}</th>
              <th class="col-1">{{ __('Sub-Category') }}</th>
              <th>{{ __('Serial Number')}}</th>
              <th>{{ __('Handed Date')}}</th>
              <th>{{ __('Actions')}}</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            @forelse ($employeeAssets as $asset)
              <tr>
                <td wire:click='showAsset' class="td" style="cursor: pointer;"><i class="ti ti-tag ti-sm text-danger me-3"></i> <strong>{{ $asset->asset_id }}</strong></td>
                <td>{{ $asset->getCategory($asset->asset_id)->name }}</td>
                <td>{{ $asset->getSubCategory($asset->asset_id)->name }}</td>
                <td>{{ $asset->asset->serial_number }}</td>
                <td><span class="badge rounded-pill bg-label-secondary">{{ $asset->handed_date }}</span></td>
                <td>
                  <button type="button" class="btn btn-sm btn-tr rounded-pill btn-icon btn-outline-secondary waves-effect">
                    <span class="ti ti-arrow-guide"></span>
                  </button>
                  <button type="button" class="btn btn-sm btn-tr rounded-pill btn-icon btn-outline-secondary waves-effect">
                    <span wire:click.prevent='showEditAssetModal({{ $asset }})' data-bs-toggle="modal" data-bs-target="#assetModal" class="ti ti-pencil"></span>
                  </button>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6">
                  <div class="mt-2 mb-2" style="text-align: center">
                    <h3 class="mb-1 mx-2">{{ __('Oopsie-doodle!') }}</h3>
                    <p class="mb-4 mx-2">
                    {{ __('No data found, please sprinkle some data in my virtual bowl, and let the fun begin!') }}
                    </p>
                    <button class="btn btn-label-primary mb-4" data-bs-toggle="modal" data-bs-target="#assetModal">
                      {{ __('Add New Asset') }}
                    </button>
                    <div>
                      <img src="{{ asset('assets/img/illustrations/page-misc-under-maintenance.png') }}" width="200" class="img-fluid">
                    </div>
                  </div>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!--/ Assets -->

  <!-- Details -->
  <div class="col-xl-4 col-lg-5 col-md-5">
    <div class="card mb-4">
      <div class="card-body">
        <h5 class="card-action-title mb-0">{{ __('Details') }}</h5>
        <ul class="list-unstyled mb-4 mt-3">
          <li class="d-flex align-items-center mb-3"><i class="ti ti-home"></i><span class="fw-bold mx-2">{{ __('Address') }}:</span> <span>{{ $employee->address }}</span></li>
        </ul>
        <ul class="list-unstyled mb-4 mt-3">
          <li class="d-flex align-items-center mb-3"><i class="ti ti-phone-call"></i><span class="fw-bold mx-2">{{ __('Mobile') }}:</span> <span style="direction: ltr">{{ '+963 ' . number_format($employee->mobile_number, 0, '', ' ') }}</span></li>
        </ul>
        <ul class="list-unstyled mb-4 mt-3">
          <li class="d-flex align-items-center mb-3"><i class="ti ti-rocket"></i><span class="fw-bold mx-2">{{ __('Started') }}:</span> <span>{{ $employee->join_at }}</span></li>
        </ul>

        <h5 class="card-action-title mb-0">{{ __('Counters') }}</h5>
        <ul class="list-unstyled mb-0 mt-3">
          <li class="d-flex align-items-center mb-3"><i class="ti ti-calendar"></i><span class="fw-bold mx-2">{{ __('Leaves Balance') }}:</span> <span class="badge bg-label-secondary">{{ $employee->max_leave_allowed . " ".__('Day') }}</span></li>
          <li class="d-flex align-items-center mb-3"><i class="ti ti-alarm"></i><span class="fw-bold mx-2">{{ __('Hourly') }}:</span> <span class="badge bg-label-secondary">{{ $employee->hourly_counter }}</span></li>
          <li class="d-flex align-items-center mb-3"><i class="ti ti-hourglass"></i><span class="fw-bold mx-2">{{ __('Delay') }}:</span> <span class="badge bg-label-secondary">{{ $employee->delay_counter }}</span></li>
        </ul>
      </div>
    </div>
  </div>
  <!--/ Details -->

  <!-- Timeline -->
  <div class="col-xl-8 col-lg-7 col-md-7">
    <div class="card card-action mb-4">
      <div class="card-header align-items-center">
        <h5 class="card-action-title mb-0">{{ __('Timelines') }}</h5>
        <div class="card-action-element">
          <div class="dropdown">
            <button type="button" class="btn dropdown-toggle hide-arrow p-0" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-dots-vertical text-muted"></i></button>
            <ul class="dropdown-menu dropdown-menu-end">
              <li>
                <a wire:click='showStoreTimelineModal()' class="dropdown-item" data-bs-toggle="modal" data-bs-target="#timelineModal">{{ __('Add New Position') }}</a>
              </li>
              {{-- <li><a class="dropdown-item" href="javascript:void(0);">Edit timeline</a></li> --}}
            </ul>
          </div>
        </div>
      </div>
      <div class="card-body pb-0">
        <ul class="timeline ms-1 mb-0">
          @foreach ($employeeTimelines as $timeline)
            <li class="timeline-item timeline-item-transparent @if ($loop->last) border-0 @endif">
              <span class="timeline-point @if ($loop->first) timeline-point-primary @else timeline-point-info @endif"></span>
              <div class="timeline-event">
                <div class="timeline-header">
                  <div class="timeline-row d-flex m-0">
                    <h6 class="m-0">{{ $timeline->position->name }}</h6>
                    <i wire:click='setPresentTimeline({{ $timeline }})' class="timeline-icon text-success ti ti-refresh mx-1"></i>
                    <i wire:click='showUpdateTimelineModal({{ $timeline }})' class="timeline-icon text-info ti ti-edit" data-bs-toggle="modal" data-bs-target="#timelineModal"></i>
                    <i wire:click='confirmDeleteTimeline({{ $timeline }})' class="timeline-icon text-danger ti ti-trash mx-1"></i>
                    @if ($confirmedId === $timeline->id)
                      <button wire:click.prevent='deleteTimeline({{ $timeline }})' type="button"
                        class="btn btn-xs btn-danger waves-effect waves-light mx-1">{{ __('Sure?') }}
                      </button>
                    @endif
                  </div>
                  <small class="text-muted">@if ($timeline->end_date == null) {{ __('Present') }} @else {{ $timeline->start_date }} --> {{ $timeline->end_date }} @endif</small>
                </div>
                <p class="mb-2">{{ $timeline->center->name }}</p>
              </div>
            </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
  <!--/ Timeline -->
</div>

{{-- Modal --}}
@include('_partials\_modals\modal-timeline')

{{-- Scripts --}}
@push('custom-scripts')
  @if(session('openTimelineModal'))
    <script>
      document.addEventListener('DOMContentLoaded', function () {
          $('#timelineModal').modal('show');
      });
    </script>
  @endif
@endpush
</div>
