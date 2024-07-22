<div>

  @php
  $configData = Helper::appClasses();
  use App\Models\Employee;
  use Carbon\Carbon;
  @endphp

  @section('title', 'Dashboard')

  @section('vendor-style')

  @endsection

  @section('page-style')
  <style>
    .match-height>[class*='col'] {
      display: flex;
      flex-flow: column;
    }

    .match-height>[class*='col']>.card {
      flex: 1 1 auto;
    }

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

  {{-- <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}">Dashboard</a>
      </li>
    </ol>
  </nav> --}}

  <div class="row match-height">
    <div class="col-xl-4 mb-4 col-lg-5 col-12">
      <div class="card h-100">
        <div class="card-header pb-0">
          <div class="d-flex justify-content-between">
            <div class="card-title mb-0">
              <h4 class="card-title mb-1">{{ __('Hi,') }} {{ Employee::find(Auth::user()->employee_id)->first_name }}! 👋</h4>
              <small class="text-muted">{{ __('Start your day with a smile') }}</small>
            </div>
          </div>

        </div>

        <div class="d-flex align-items-end row h-100">
          <div class="col-7">
            <div class="card-body text-nowrap">
              {{-- <h5 class="card-title mb-0">{{ __('Hi,') }} {{ Employee::find(Auth::user()->employee_id)->first_name
                }}! 👋</h5>
              <p class="mb-2">{{ __('Start your day with a smile') }}</p> --}}
              {{-- <h5 wire:poll.60s class="text-primary mt-3 mb-2">{{ now()->format('Y/m/d - H:i') }}</h5> --}}
              <h5 id="date" class="text-primary mt-3 mb-1"></h5>
              <h5 id="time" class="text-primary mb-2"></h5>
              <div class="btn-group dropend">
                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false"><i class="ti ti-menu-2 ti-xs me-1"></i>{{ __('Add New')
                  }}</button>
                <ul class="dropdown-menu">
                  @can('create employees')
                  <li><a class="dropdown-item" href="{{ route('structure-employees') }}"><i
                        class="ti ti-menu-2 ti-xs me-1"></i> {{ __('Employee') }}</a></li>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  @endcan
                  @can('create fingerprints')
                  <li><a class="dropdown-item" href="{{ route('attendance-fingerprints') }}"><i
                        class="ti ti-menu-2 ti-xs me-1"></i>{{ __('Fingerprint') }}</a></li>
                  @endcan
                  @can('create leaves')
                  <li><a wire:click='showCreateLeaveModal' class="dropdown-item" data-bs-toggle="modal"
                      data-bs-target="#leaveModal" href=""><i class="ti ti-menu-2 ti-xs me-1"></i>{{ __('Leave') }}</a>
                  </li>
                  @endcan
                </ul>
              </div>
            </div>
          </div>
          <div class="col-5 text-center text-sm-left h-100 d-flex align-items-end">
            <div class="card-body pb-0 px-0 px-md-4 w-100">
              <img src="{{asset('assets/img/illustrations/card-advance-sale.png')}}" class="img-fluid" alt="view sales"
                style="object-fit: contain; width: 100%; height: auto;">
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-8 mb-4 col-lg-7 col-12">
      <div class="card h-100">
        <div class="card-header">
          <div class="d-flex justify-content-between mb-3">
            <h5 class="card-title mb-0">{{ __('Statistics') }}</h5>
            @can('read sms')
            <small class="text-muted">{{ $accountBalance['status'] == 200 ? __('Updated recently') : __('Error, Update unavailable') }}</small>
            @endcan
          </div>
        </div>
        @can('read sms')
        <div class="card-body">
          <div class="row gy-3">
            <div class="col-md-3 col-6">
              <div class="d-flex align-items-center">
                <div class="badge rounded-pill bg-label-primary me-3 p-2"><i class="ti ti-activity ti-sm"></i></div>
                <div class="card-info">
                  <h5 class="mb-0">{{ $accountBalance['is_active'] }}</h5>
                  <small>{{ __('API Status') }}</small>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-6">
              <div class="d-flex align-items-center">
                <div class="badge rounded-pill bg-label-primary me-3 p-2"><i class="ti ti-calculator ti-sm"></i></div>
                <div class="card-info">
                  <h5 class="mb-0">{{ $accountBalance['balance'] }}</h5>
                  <small>{{ __('API Balance') }}</small>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-6">
              <div class="d-flex align-items-center">
                <div class="badge rounded-pill bg-label-success me-3 p-2"><i class="ti ti-speakerphone ti-sm"></i></div>
                <div class="card-info">
                  <h5 class="mb-0">{{ $messagesStatus['sent'] }}</h5>
                  <small>{{ __('Successful SMS') }}</small>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-6">
              <div class="d-flex align-items-center">
                <div wire:click='sendPendingMessages' class="badge rounded-pill bg-label-danger me-3 p-2"
                  style="cursor: pointer"><i class="ti ti-send ti-sm"></i></div>
                <div class="card-info">
                  <h5 class="mb-0">{{ $messagesStatus['unsent'] }}</h5>
                  <small>{{ __('Pending SMS') }}</small>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endcan
        @can('create leaves')
        <div class="card-body pt-0">
          <div class="row gy-3">
            <div class="col-md-3 col-6">
              <div class="d-flex align-items-center">
                <div class="badge rounded-pill bg-label-secondary me-3 p-2"><i class="ti ti-users ti-sm"></i></div>
                <div class="card-info">
                  <h5 class="mb-0">{{ count($activeEmployees) }}</h5>
                  <small>{{ __('Active Employees') }}</small>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-6">
              <div class="d-flex align-items-center">
                <div class="badge rounded-pill bg-label-secondary me-3 p-2"><i class="ti ti-calendar ti-sm"></i></div>
                <div class="card-info">
                  <h5 class="mb-0">{{ count($leaveRecords) }}</h5>
                  <small>{{ __('Today Records') }}</small>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endcan
      </div>
    </div>

    {{-- <div class="col-xl-4 col-12">
      <div class="row">
        <div class="col-xl-6 mb-4 col-md-3 col-6">
          <div class="card">
            <div class="card-header pb-0">
              <h5 class="card-title mb-0">82.5k</h5>
              <small class="text-muted">Expenses</small>
            </div>
            <div class="card-body">
              <div id="expensesChart"></div>
              <div class="mt-md-2 text-center mt-lg-3 mt-3">
                <small class="text-muted mt-3">$21k Expenses more than last month</small>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-6 mb-4 col-md-3 col-6">
          <div class="card">
            <div class="card-header pb-0">
              <h5 class="card-title mb-0">Profit</h5>
              <small class="text-muted">Last Month</small>
            </div>
            <div class="card-body">
              <div id="profitLastMonth"></div>
              <div class="d-flex justify-content-between align-items-center mt-3 gap-3">
                <h4 class="mb-0">624k</h4>
                <small class="text-success">+8.24%</small>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-12 mb-4 col-md-6">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between">
                <div class="d-flex flex-column">
                  <div class="card-title mb-auto">
                    <h5 class="mb-1 text-nowrap">Generated Leads</h5>
                    <small>Monthly Report</small>
                  </div>
                  <div class="chart-statistics">
                    <h3 class="card-title mb-1">4,350</h3>
                    <small class="text-success text-nowrap fw-semibold"><i class='ti ti-chevron-up me-1'></i>
                      15.8%</small>
                  </div>
                </div>
                <div id="generatedLeadsChart"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> --}}

    {{-- <div class="col-12 col-xl-8 mb-4 col-lg-7">
      <div class="card">
        <div class="card-header pb-3 ">
          <h5 class="m-0 me-2 card-title">Revenue Report</h5>
        </div>
        <div class="card-body">
          <div class="row row-bordered g-0">
            <div class="col-md-8">
              <div id="totalRevenueChart"></div>
            </div>
            <div class="col-md-4">
              <div class="text-center mt-4">
                <div class="dropdown">
                  <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" id="budgetId"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <script>
                      document.write(new Date().getFullYear())

                    </script>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="budgetId">
                    <a class="dropdown-item prev-year1" href="javascript:void(0);">
                      <script>
                        document.write(new Date().getFullYear() - 1)

                      </script>
                    </a>
                    <a class="dropdown-item prev-year2" href="javascript:void(0);">
                      <script>
                        document.write(new Date().getFullYear() - 2)

                      </script>
                    </a>
                    <a class="dropdown-item prev-year3" href="javascript:void(0);">
                      <script>
                        document.write(new Date().getFullYear() - 3)

                      </script>
                    </a>
                  </div>
                </div>
              </div>
              <h3 class="text-center pt-4 mb-0">$25,825</h3>
              <p class="mb-4 text-center"><span class="fw-semibold">Budget: </span>56,800</p>
              <div class="px-3">
                <div id="budgetChart"></div>
              </div>
              <div class="text-center mt-4">
                <button type="button" class="btn btn-primary">Increase Button</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> --}}
  </div>

  <div class="row">
    <div class="col">
      <div class="card">
        <h5 class="card-header">{{ __('Today Leaves')}}</h5>
        <div class="table-responsive text-nowrap">
          <table class="table table-hover">
            <thead>
              <tr>
                <th class="col-1">{{ __('ID') }}</th>
                <th>{{ __('Employee') }}</th>
                <th class="col-1">{{ __('Type') }}</th>
                <th style="text-align: center">{{ __('Details') }}</th>
                <th style="text-align: center">{{ __('Actions') }}</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              @forelse($leaveRecords as $leave)
              <tr>
                <td><strong>{{ $leave->id }}</strong></td>
                <td class="td">{{ $this->getEmployeeName($leave->employee_id) }}</td>
                <td>{{ $this->getLeaveType($leave->leave_id) }}</td>
                <td style="text-align: center">
                  <span class="badge bg-label-primary mb-2 me-1" style="font-size: 14px">{{ $leave->from_date . ' --> '
                    . $leave->to_date }}</span>
                  <br>
                  @if ($leave->start_at !== null)
                  <span class="badge bg-label-secondary me-1">{{ Carbon::parse($leave->start_at)->format('H:i') . ' -->
                    ' . Carbon::parse($leave->end_at)->format('H:i') }}</span>
                  @endif
                </td>
                <td style="text-align: center">
                  <button type="button"
                    class="btn btn-sm btn-tr rounded-pill btn-icon btn-outline-secondary waves-effect">
                    <span wire:click.prevent="showEditLeaveModal({{ $leave->id }})" data-bs-toggle="modal"
                      data-bs-target="#leaveModal" class="ti ti-pencil"></span>
                  </button>
                  <button type="button" class="btn btn-sm btn-tr rounded-pill btn-icon btn-outline-danger waves-effect">
                    <span wire:click.prevent="confirmDestroyLeave({{ $leave->id }})" class="ti ti-trash"></span>
                  </button>
                  @if ($confirmedId === $leave->id)
                  <button wire:click.prevent="destroyLeave" type="button"
                    class="btn btn-xs btn-danger waves-effect waves-light">
                    {{ __('Sure?') }}
                  </button>
                  @endif
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
                    <button class="btn btn-label-primary mb-4" data-bs-toggle="modal" data-bs-target="#leaveModal">
                      {{ __('Add New Leave') }}
                    </button>
                    <div>
                      <img src="{{ asset('assets/img/illustrations/page-misc-under-maintenance.png') }}" width="200"
                        class="img-fluid">
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
  </div>

  <div class="row mt-4">
    <div class="col">
      <div class="card">
        <h5 class="card-header">{{ __('Changelog') }}</h5>
        <div class="card-body">
          @foreach ($changelogs as $changelog)
          <small all class="text-light fw-semibold">{{ $changelog->version }}</small>
          <dl class="row mt-2">
            <dt class="col-sm-3">{{ $changelog->title }}</dt>
            <dd class="col-sm-9">{{ $changelog->description }}</dd>
          </dl>
          @endforeach
        </div>
      </div>
    </div>
  </div>

  {{-- Modals --}}
  @include('_partials/_modals/modal-leaveWithEmployee')

  @push('custom-scripts')
  <script>
    function updateClock() {
            const now = new Date();
            const dateOptions = {
                weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
            };
            const timeOptions = {
                hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false
            };

            const formattedDate = now.toLocaleDateString('en-US', dateOptions);
            const formattedTime = now.toLocaleTimeString('en-US', timeOptions);

            document.getElementById('date').innerHTML = formattedDate;
            document.getElementById('time').innerHTML = formattedTime;
        }

        setInterval(updateClock, 1000); // Update every second
        updateClock(); // Initial call to display clock immediately
  </script>
  @endpush
</div>
