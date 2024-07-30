<div>

  @php
    $configData = Helper::appClasses();
    use Carbon\Carbon;
  @endphp

  @section('title', 'Attendance - Leaves')

  @section('vendor-style')
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}"/>
  @endsection

  @section('page-style')
    <link rel="stylesheet" href="{{asset('assets/vendor/css/pages/app-calendar.css')}}"/>

    <style>
      tr.disabled {
        opacity: 0.5;
        pointer-events: none;
        text-decoration: line-through;
      }
      tr.disabled i {
          display: none;
      }
    </style>
  @endsection

  {{-- Alerts --}}
  @include('_partials/_alerts/alert-general')

  <div class="card app-calendar-wrapper">
    <div class="row g-0">

      <!-- Sidebar -->
      <div class="col app-calendar-sidebar" id="app-calendar-sidebar">
        <div class="border-bottom p-3 my-sm-0 mb-3">
          <div class="d-grid">
            <div class="sidebar-header">
              <div class="d-flex align-items-center me-3 me-lg-0">
                <div wire:ignore class="col-12">
                  <label class="form-label">{{ __('Employee') }}</label>
                  <select wire:model='selectedEmployeeId' class="select2 form-control" id="select2selectedEmployeeId">
                    @forelse ($activeEmployees as $employee)
                      <option value="{{ $employee->id }}">{{ $employee->id . ' - ' . $employee->first_name . ' ' . $employee->father_name . ' ' . $employee->last_name }}</option>
                    @empty
                      <option value="0" disabled>{{ __('No Employees Found!') }}</option>
                    @endforelse
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="border-bottom p-3 my-sm-0 mb-3">
          <div class="col-12">
            <label class="form-label">{{ __('Date Range') }}</label>
            <input wire:model='dateRange' type="text" class="form-control flatpickr-input active"
                   id="flatpickr-range" placeholder="YYYY-MM-DD {{ __('to') }} YYYY-MM-DD" readonly="readonly">
          </div>
        </div>

        <div class="border-bottom p-3 my-sm-0 mb-3">
          <div class="col-12">
            <div wire:ignore class="col-12">
              <label class="form-label">{{ __('Type') }}</label>
              <select wire:model='selectedLeaveId' class="select2 form-control" id="select2selectedLeaveId">
                <option value=""></option>
                @forelse ($leaveTypes as $leaveType)
                  <option value="{{ $leaveType->id }}">{{ $leaveType->name }}</option>
                @empty
                  <option value="0" disabled>{{ __('No Leave Found!') }}</option>
                @endforelse
              </select>
            </div>
          </div>
        </div>

        <div class="row p-5">
          <div class="d-grid gap-2 col-12 mx-auto">
            <button wire:click='applyFilter' class="btn btn-label-primary btn-xl waves-effect waves-light"
                    type="button">{{ __('Apply') }}
            </button>
          </div>
        </div>
      </div>
      <!-- /Sidebar -->

      <!-- Calendar -->
      <div class="col app-calendar-content">
        <div class="card shadow-none border-0">
          <div class="card-body pb-0" style="height: 464px;">
            <div>
              <div class="row d-flex justify-content-between">
                <div class="col-7 p-0 d-flex overflow-hidden align-items-center">
                  <a class="nav-item d-xl-none nav-link px-0 mx-2" href="javascript:void(0)" data-bs-toggle="sidebar" data-overlay="" data-target="#app-calendar-sidebar">
                    <i class="ti ti-menu-2 ti-sm"></i>
                  </a>
                  <div class="flex-shrink-0 avatar">
                    <img src="{{ Storage::disk("public")->url($selectedEmployee->profile_photo_path) }}" class="rounded-circle" alt="Avatar">
                  </div>
                  <div class="chat-contact-info flex-grow-1 ms-2">
                    <h6 class="m-0">{{ $selectedEmployee->full_name }}</h6>
                    <small class="user-status text-muted">{{ $selectedEmployee->current_position }}</small>
                  </div>
                </div>
                <div class="col-5 btn-group d-flex justify-content-end">
                  <button wire:click.prevent='showCreateLeaveModal' type="button" class="btn btn-primary"
                          data-bs-toggle="modal" data-bs-target="#leaveModal">
                    <span class="ti ti-plus me-1"></span>{{ __('Add New Record') }}
                  </button>
                  <button type="button"
                          class="btn btn-primary dropdown-toggle dropdown-toggle-split waves-effect waves-light"
                          data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="visually-hidden"></span>
                  </button>
                  <ul class="dropdown-menu">
                    <li>
                      <h6 class="dropdown-header text-uppercase">{{ __('Import & Export') }}</h6>
                    </li>
                    <li>
                      @can('Import leaves')
                      <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#importModal">
                        <i class="ti ti-table-import me-1"></i> {{ __('Import From Excel') }}
                      </button>
                      @endcan
                    </li>
                    <li>
                      <button wire:click='exportToExcel()' class="dropdown-item">
                        <i class="ti ti-table-export me-1"></i> {{ __('Export To Excel') }}
                      </button>
                    </li>
                  </ul>
                </div>
              </div>

              <div class="table-responsive text-nowrap">
                <table class="table">
                  <thead>
                  <tr>
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('From Date') }}</th>
                    <th>{{ __('To Date') }}</th>
                    <th>{{ __('Start At') }}</th>
                    <th>{{ __('End At') }}</th>
                    <th class="col-1">{{ __('Actions') }}</th>
                  </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                  @forelse($leaves as $leave)
                    <tr class="@if ($leave->pivot->is_checked) disabled @endif">
                      <td>{{ $leave->pivot->id }}</td>
                      <td>{{ $leave->name }}</td>
                      <td>{{ $leave->pivot->from_date }}</td>
                      <td>{{ $leave->pivot->to_date }}</td>
                      <td>{{ $leave->pivot->start_at ? Carbon::parse($leave->pivot->start_at)->format('H:i') : '-' }}</td>
                      <td>{{ $leave->pivot->end_at ? Carbon::parse($leave->pivot->end_at)->format('H:i') : '-' }}</td>
                      <td
                        >
                        <div>
                          <a wire:click.prevent="showUpdateLeaveModal({{ $leave->pivot->id }})"  data-bs-toggle="modal" data-bs-target="#leaveModal" href=""><i
                              class="ti ti-edit text-info"></i></a>
                          <a wire:click.prevent="confirmDestroyLeave({{ $leave->pivot->id }})" href=""><i
                              class="ti ti-trash text-danger"></i></a>
                          @if ($confirmedId === $leave->pivot->id)
                            <button wire:click.prevent='destroyLeave({{ $leave }})' type="button"
                                    class="btn btn-xs btn-danger waves-effect waves-light">{{ __('Sure?') }}
                            </button>
                          @endif
                        </div>
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
                          <button class="btn btn-label-primary mb-4"
                            data-bs-toggle="modal" data-bs-target="#leaveModal">
                            {{ __('Add New Record') }}
                          </button>
                          <div>
                            <img src="{{ asset('assets/img/illustrations/page-misc-under-maintenance.png') }}"
                                 alt="page-misc-under-maintenance" width="200" class="img-fluid">
                          </div>
                        </div>
                      </td>
                    </tr>
                  @endforelse
                  </tbody>
                </table>
              </div>
              {{ $leaves->links() }}
            </div>
          </div>
        </div>

        <div class="app-overlay"></div>
      </div>
      <!-- /Calendar-->
    </div>

    {{-- Modals --}}
    @include('_partials/_modals/modal-Leave')
    @include('_partials/_modals/modal-import')
  </div>

  @push('custom-scripts')
    <script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>

    <script>
      'use strict';

      $(function () {
        const select2selectedEmployeeId = $('#select2selectedEmployeeId');
        const select2selectedLeaveId = $('#select2selectedLeaveId');

        if (select2selectedEmployeeId.length) {
          select2selectedEmployeeId.each(function () {
            var $this = $(this);
            $this.wrap('<div class="position-relative"></div>').select2({
              placeholder: "{{ __('Select..') }}",
              dropdownParent: $this.parent()
            });
          });
        }

        $('#select2selectedEmployeeId').on('change', function (e) {
          var data = $('#select2selectedEmployeeId').select2("val");
          @this.set('selectedEmployeeId', data);
        });

        if (select2selectedLeaveId.length) {
          select2selectedLeaveId.each(function () {
            var $this = $(this);
            $this.wrap('<div class="position-relative"></div>').select2({
              placeholder: "{{ __('Select..') }}",
              allowClear: true,
              dropdownParent: $this.parent()
            });
          });
        }

        $('#select2selectedLeaveId').on('change', function (e) {
          var data = $('#select2selectedLeaveId').select2("val");
          @this.set('selectedLeaveId', data);
        });
      });
    </script>

    <script>
      $(document).ready(function () {
        const flatpickrRange = document.querySelector('#flatpickr-range');
        if (typeof flatpickrRange != undefined) {
          flatpickrRange.flatpickr({
            mode: 'range'
          });
        }
      });
    </script>
  @endpush
</div>
