<div>

  @php
    $configData = Helper::appClasses();
    use Carbon\Carbon;
  @endphp

  @section('title', 'Discounts')

  @section('vendor-style')
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/bs-stepper/bs-stepper.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}"/>
  @endsection

  @section('page-style')
    <style>
      .animation-rocket {
        animation: rocket-launch 1s ease-in-out infinite;
      }

      @keyframes rocket-launch {
        0% {
          transform: translateX(0);
        }
        25% {
          transform: translateX(-2px);
        }
        50% {
          transform: translateX(2px);
          transform: translateY(-1px);
        }
        75% {
          transform: translateX(-2px);
        }
        100% {
          transform: translateX(0);
          transform: translateY(0);
        }
      }
    </style>
  @endsection

  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
      </li>
      <li class="breadcrumb-item active">{{ __('Human Resource') }}</li>
      <li class="breadcrumb-item active">{{ __('Discounts') }}</li>
    </ol>
  </nav>

  <div class="col-12 mb-4">
    <div class="bs-stepper wizard-icons wizard-modern wizard-modern-icons-example mt-2">
      <div class="bs-stepper-header">
        <div class="step crossed" data-target="#holidays">
          <button type="button" class="step-trigger">
            <span class="bs-stepper-icon">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-christmas-tree" width="24" height="24" viewBox="0 0 24 24" stroke-width="1" stroke="#FFFFFF" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M12 3l4 4l-2 1l4 4l-3 1l4 4h-14l4 -4l-3 -1l4 -4l-2 -1z" />
                <path d="M14 17v3a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1v-3" />
              </svg>
            </span>
            <span class="bs-stepper-label">{{ __('Holidays') }}</span>
          </button>
        </div>
        <div class="line">
          <i class="ti ti-chevron-right"></i>
        </div>
        <div class="step" data-target="#fingerprints">
          <button type="button" class="step-trigger">
            <span class="bs-stepper-icon">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-hand-finger" width="24" height="24" viewBox="0 0 24 24" stroke-width="1" stroke="#FFFFFF" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M8 13v-8.5a1.5 1.5 0 0 1 3 0v7.5" />
                <path d="M11 11.5v-2a1.5 1.5 0 1 1 3 0v2.5" />
                <path d="M14 10.5a1.5 1.5 0 0 1 3 0v1.5" />
                <path d="M17 11.5a1.5 1.5 0 0 1 3 0v4.5a6 6 0 0 1 -6 6h-2h.208a6 6 0 0 1 -5.012 -2.7a69.74 69.74 0 0 1 -.196 -.3c-.312 -.479 -1.407 -2.388 -3.286 -5.728a1.5 1.5 0 0 1 .536 -2.022a1.867 1.867 0 0 1 2.28 .28l1.47 1.47" />
              </svg>
            </span>
            <span class="bs-stepper-label">{{ __('Fingerprints') }}</span>
          </button>
        </div>
        <div class="line">
          <i class="ti ti-chevron-right"></i>
        </div>
        <div class="step" data-target="#leaves">
          <button type="button" class="step-trigger">
            <span class="bs-stepper-icon">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plane-departure" width="24" height="24" viewBox="0 0 24 24" stroke-width="1" stroke="#FFFFFF" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M14.639 10.258l4.83 -1.294a2 2 0 1 1 1.035 3.863l-14.489 3.883l-4.45 -5.02l2.897 -.776l2.45 1.414l2.897 -.776l-3.743 -6.244l2.898 -.777l5.675 5.727z" />
                <path d="M3 21h18" />
              </svg>
            </span>
            <span class="bs-stepper-label">{{ __('Leaves') }}</span>
          </button>
        </div>
        <div class="line">
          <i class="ti ti-chevron-right"></i>
        </div>
        <div class="step" data-target="#submit">
          <button type="button" class="step-trigger">
            <span class="bs-stepper-icon">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-report-money" width="24" height="24" viewBox="0 0 24 24" stroke-width="1" stroke="#FFFFFF" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                <path d="M14 11h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5" />
                <path d="M12 17v1m0 -8v1" />
              </svg>
            </span>
            <span class="bs-stepper-label">{{ __('Review') }} &amp; {{ __('Submit') }}</span>
          </button>
        </div>
      </div>
      <div class="bs-stepper-content" id="bsContent">
        <form onsubmit="return false">
          <!-- Holidays Details -->
          <div id="holidays" class="content">
            <div class="content-header mb-3">
              <h6 class="mb-0">{{ __('Step 1') }}</h6>
              <small>1 / 4</small>
            </div>
            <div class="row g-3">
              <div class="mt-2 mb-2" style="text-align: center">
                  <h3 class="text-warning mb-1 mx-2">{{ __('Work matters, but Holidays matter more!') }}</h3>
                  <p class="mb-4 mx-2">
                    {{ __("Don't forget to add the") }} <strong>{{ __('Holidays') }}</strong>{{ __(". If you haven't added them yet!") }}
                  </p>
                  <a href="{{ route('holidays') }}" target="_blank" class="btn btn-label-secondary mb-4">
                    {{ __('Add New Holidays') }}
                  </a>
              </div>
              <div class="col-12 d-flex justify-content-between">
                <button class="btn btn-label-secondary btn-prev waves-effect" style="visibility: hidden"> <i class="ti ti-arrow-left me-sm-1"></i>
                  <span class="align-middle d-sm-inline-block d-none">{{ __('Previous') }}</span>
                </button>
                <button class="btn btn-primary btn-next waves-effect waves-light"> <span class="align-middle d-sm-inline-block d-none me-sm-1">{{ __('Next') }}</span> <i class="ti ti-arrow-right"></i></button>
              </div>
            </div>
          </div>
          <!-- Fingerprints Info -->
          <div id="fingerprints" class="content">
            <div class="content-header mb-3">
              <h6 class="mb-0">{{ __('Step 2') }}</h6>
              <small>2 / 4</small>
            </div>
            <div class="row g-3">
              <div class="mt-2 mb-2" style="text-align: center">
                  <h3 class="text-warning mb-1 mx-2">{{ __('The magic lies in Fingerprints! Import them and set off.') }}</h3>
                  <p class="mb-4 mx-2">
                    {{ __("Don't forget to import the") }} <strong>{{ __('Fingerprints') }}</strong> {{ __("file. If you haven't added them yet!") }}
                  </p>
                  <a href="{{ route('attendance-fingerprints') }}" target="_blank" class="btn btn-label-secondary mb-4">
                   {{ __('Import Fingerprints File') }}
                  </a>
              </div>
              <div class="col-12 d-flex justify-content-between">
                <button class="btn btn-label-secondary btn-prev waves-effect"> <i class="ti ti-arrow-left me-sm-1"></i>
                  <span class="align-middle d-sm-inline-block d-none">{{ __('Previous') }}</span>
                </button>
                <button class="btn btn-primary btn-next waves-effect waves-light"> <span class="align-middle d-sm-inline-block d-none me-sm-1">{{ __('Next') }}</span> <i class="ti ti-arrow-right"></i></button>
              </div>
            </div>
          </div>
          <!-- Leaves -->
          <div id="leaves" class="content">
            <div class="content-header mb-3">
              <h6 class="mb-0">{{ __('Step 3') }}</h6>
              <small>3 / 4</small>
            </div>
            <div class="row g-3">
              <div class="mt-2 mb-2" style="text-align: center">
                  <h3 class="text-warning mb-1 mx-2">{{ __('Employee Leaves is the crucial move! Import the Leaves file!') }}</h3>
                  <p class="mb-4 mx-2">
                    {{ __("Don't forget to import the") }} <strong>{{ __('Leaves') }}</strong> {{ __("file. If you haven't added them yet!") }}
                  </p>
                  <a href="{{ route('attendance-leaves') }}" target="_blank" class="btn btn-label-secondary mb-4">
                   {{ __('Import Leaves File') }}
                  </a>
              </div>
              <div class="col-12 d-flex justify-content-between">
                <button class="btn btn-label-secondary btn-prev waves-effect"> <i class="ti ti-arrow-left me-sm-1"></i>
                  <span class="align-middle d-sm-inline-block d-none">{{ __('Previous') }}</span>
                </button>
                <button class="btn btn-primary btn-next waves-effect waves-light"> <span class="align-middle d-sm-inline-block d-none me-sm-1">{{ __('Next') }}</span> <i class="ti ti-arrow-right"></i></button>
              </div>
            </div>
          </div>

          <!-- Submit -->
          <div id="submit" class="content active dstepper-block">
            <div class="content-header mb-3">
              <h6 class="mb-0">{{ __('Step 4') }}</h6>
              <small>4 / 4</small>
            </div>
            <div class="row g-3">
              @if (! $isProcessing)
              <div wire:transition class="mt-2 mb-2" style="text-align: center">
                  <h3 class="text-primary mb-1 mx-2">{{ __('Ready, set, launch!') }}</h3>
                  <p class="mb-4 mx-2">
                    {{ __('Choose the dates and take a sip of coffee while the rocket makes its touchdown.') }}
                  </p>
                  <div class="row justify-content-center">
                    <div class="col-3 m-2">
                      <input wire:model='batch' type="text" class="form-control flatpickr-input active text-center @error('batch') is-invalid @enderror"
                        id="flatpickr-range" placeholder="YYYY-MM-DD to YYYY-MM-DD" readonly="readonly">
                      @error('batch') <div class="invalid-feedback">{{ $message }}</div> @enderror
                      </div>
                  </div>
              </div>
              @endif
              <div class="row justify-content-center">
                <!-- Progress Bar -->
                @if ($isProcessing)
                  <div>
                    <div style="transform: scale(0.4); margin: -107px;">
                      @include('_partials/rocket')
                    </div>
                    <div class="row justify-content-center">
                      <div class="progress col-6 p-0" style="height: 20px;">
                        <div wire:poll.1s="updateProgressBar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: {{ $percentage }}%;" aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100">{{ $percentage }}%</div>
                      </div>
                    </div>
                  </div>
                  @else
                  <div class="row justify-content-center" style="text-align: center;">
                    @if (session()->has('success'))
                      <div class="nav-item mx-3 text-success">
                          {{ session('success') }}
                          <br><br>
                          ⚠️ {{ __('Make sure that all Employees Leaves are Checked Successfully') }} ⚠️
                          <br><br>
                          {{ __('Get into the') }} <a href="{{ route('statistics') }}">{{ __('statistics') }}</a> {{ __('for a deep dive into the juicy details!') }}
                      </div>
                    @endif
                    @if (session()->has('error'))
                      <div class="nav-item mx-3 text-danger">
                          {{ session('error') }}
                      </div>
                    @endif
                  </div>
                @endif
                <!-- Progress Bar -->
              </div>
              <div class="col-12 d-flex justify-content-between">
                <button class="btn btn-label-secondary btn-prev waves-effect"> <i class="ti ti-arrow-left me-sm-1"></i>
                  <span class="align-middle d-sm-inline-block d-none">{{ __('Previous') }}</span>
                </button>
                <button id="calculateDiscounts" wire:click.prevent='calculateDiscounts()' class="btn btn-success waves-effect waves-light">{{ __('Submit') }}</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  {{-- Employee discounts --}}
  {{-- @if ($showDiscounts)
    <div wire:transition class="card">
      <div class="card-header">
        Discounts info
      </div>
      <div class="card-body">
        @foreach ($employeeDiscounts as $employee)
        <div class="card card-action mb-4">
          <div class="card-header">
            <div class="card-action-title d-flex overflow-hidden align-items-center">
              <div class="avatar avatar-lg me-2">
                <a href="{{ route('structure-employees-info', $employee->id) }}">
                  <img src="{{ asset($employee->getEmployeePhoto()) }}" alt="Avatar" class="rounded">
                </a>
              </div>
              <div class="user-profile-info mx-3">
                <a href="{{ route('structure-employees-info', $employee->id) }}">
                  <h6 style="margin-bottom: 0.5rem;">{{ $employee->full_name }}</h6>
                </a>
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
            </div>
            <div class="card-title-elements">
                <i class="ti ti-phone-call d-sm-block me-3" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-original-title="{{'+'. implode(' ', str_split($employee->mobile_number, 3)) }}"></i>
                <span class="badge bg-danger">{{ count($employee->discounts) .' / '. $employee->cash_discounts_count }}</span>
                <a href="javascript:void(0);" class="card-collapsible text-danger"><i class="tf-icons ti ti-chevron-right scaleX-n1-rtl ti-sm"></i></a>
            </div>
          </div>

          <div class="collapse">
            <table class="table table-hover">
              <thead>
                <tr style="font-weight:bold">
                  <th>#</th>
                  <th>Date</th>
                  <th class="text-center">Rate</th>
                  <th>Reason</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                @foreach ($employee->discounts as $discount)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $discount->date }}</td>
                    <td class="text-center">
                      <div class="badge bg-label-danger me-1">
                        {{ $discount->rate }}
                      </div>
                    </td>
                    <td>
                      {{ $discount->reason }}
                      @if ($discount->is_auto)
                        <span class="badge badge-center rounded-pill bg-label-secondary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-primary" data-bs-original-title="Automatic"><i class="ti ti-settings"></i></span>
                      @endif
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  @endif --}}

  @section('vendor-script')
    <script src="{{asset('assets/vendor/libs/bs-stepper/bs-stepper.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js')}}"></script>
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{asset('assets/js/cards-actions.js')}}"></script>
  @endsection

  @push('custom-scripts')
    <script src="{{asset('assets/js/form-wizard-icons.js')}}"></script>

    <script>
      $(document).ready(function () {
        const flatpickrRange = document.querySelector('#flatpickr-range');
        if (typeof flatpickrRange != undefined) {
          flatpickrRange.flatpickr({
            mode: 'range',
            dateFormat: "Y-m-d",
            disable: [
                {
                    from: "1970-01-01",
                    to: "{{$disableDateLimit}}"
                },
            ]
          });
        }
      });
    </script>

    <script>
      document.getElementById("calculateDiscounts").addEventListener("click", function() {
        document.getElementById("bsContent").scrollIntoView();
      });
    </script>
  @endpush
</div>
