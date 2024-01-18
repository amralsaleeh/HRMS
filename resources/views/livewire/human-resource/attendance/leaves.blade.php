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
                  <label class="form-label">Employee</label>
                  <select wire:model='selectedEmployeeId' class="select2 form-control" id="select2selectedEmployeeId">
                    @forelse ($employees as $employee)
                      <option value="{{ $employee->id }}">{{ $employee->id . ' - ' . $employee->full_name }}</option>
                    @empty
                      <option value="0" disabled>No Employees Found!</option>
                    @endforelse
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="border-bottom p-3 my-sm-0 mb-3">
          <div class="col-12">
            <div wire:ignore class="col-12">
              <label class="form-label">Type</label>
              <select wire:model='selectedLeaveId' class="select2 form-control" id="select2selectedLeaveId">
                <option value=""></option>
                @forelse ($leaveTypes as $leaveType)
                  <option value="{{ $leaveType->id }}">{{ $leaveType->name }}</option>
                @empty
                  <option value="0" disabled>No Leave Found!</option>
                @endforelse
              </select>
            </div>
          </div>
        </div>

        <div class="border-bottom p-3 my-sm-0 mb-3">
          <div class="col-12">
            <label class="form-label">Date Range</label>
            <input wire:model='dateRange' type="text" class="form-control flatpickr-input active"
                   id="flatpickr-range" placeholder="YYYY-MM-DD to YYYY-MM-DD" readonly="readonly">
          </div>
        </div>

        <div class="row p-5">
          <div class="d-grid gap-2 col-12 mx-auto">
            <button wire:click='applyFilter' class="btn btn-label-primary btn-xl waves-effect waves-light"
                    type="button">Apply
            </button>
          </div>
        </div>
      </div>
      <!-- /Sidebar -->

      <!-- Calendar -->
      <div class="col app-calendar-content">
        <div class="card shadow-none border-0">
          <div class="card-body pb-0">
            <div>
              <div class="row d-flex justify-content-between">
                <div class="col-8 d-flex overflow-hidden align-items-center">
                  <div class="flex-shrink-0 avatar">
                    <img src="{{ asset($selectedEmployee->getEmployeePhoto()) }}" class="rounded-circle" alt="Avatar">
                  </div>
                  <div class="chat-contact-info flex-grow-1 ms-2">
                    <h6 class="m-0">{{ $selectedEmployee->full_name }}</h6>
                    <small class="user-status text-muted">{{ $selectedEmployee->current_position }}</small>
                  </div>
                </div>
                <div class="col-4 btn-group d-flex justify-content-end">
                  <button wire:click.prevent='showNewLeaveModal' type="button" class="btn btn-primary"
      data-bs-toggle="modal" data-bs-target="#leaveModal">
      <span class="ti-xs ti ti-plus me-1"></span>Add New Record
    </button>
                  <button type="button"
                          class="btn btn-primary dropdown-toggle dropdown-toggle-split waves-effect waves-light"
                          data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="visually-hidden"></span>
                  </button>
                  <ul class="dropdown-menu">
                    <li>
                      <h6 class="dropdown-header text-uppercase">Import & Export</h6>
                    </li>
                    <li>
                      <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#importModal">
                        <i class="ti ti-table-import me-1"></i> Import From Excel
                      </button>
                    </li>
                    <li>
                      <button wire:click='exportToExcel()' class="dropdown-item" disabled>
                        <i class="ti ti-table-export me-1"></i> Export To Excel
                      </button>
                    </li>
                  </ul>
                </div>
              </div>

              <div class="table-responsive text-nowrap">
                <table class="table">
                  <thead>
                  <tr>
                    <th>Name</th>
                    <th>From Date</th>
                    <th>To Date</th>
                    <th>Start At</th>
                    <th>End At</th>
                    <th class="col-1">Actions</th>
                  </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                  @forelse($leaves as $leave)
                    <tr>
                      <td>{{ $leave->name }}</td>
                      <td>{{ $leave->pivot->from_date }}</td>
                      <td>{{ $leave->pivot->to_date }}</td>
                      <td>{{ $leave->pivot->start_at ? Carbon::parse($leave->pivot->start_at)->format('H:i') : '-' }}</td>
                      <td>{{ $leave->pivot->end_at ? Carbon::parse($leave->pivot->end_at)->format('H:i') : '-' }}</td>
                      <td>
                        <div>
                          <a wire:click.prevent="showEditLeaveModal({{ $leave->pivot->id }})"  data-bs-toggle="modal" data-bs-target="#leaveModal" href=""><i
                              class="ti ti-edit text-info"></i></a>
                          <a wire:click.prevent="confirmDeleteLeave({{ $leave->pivot->id }})" href=""><i
                              class="ti ti-trash text-danger"></i></a>
                          @if ($confirmedId === $leave->pivot->id)
                            <button wire:click.prevent='deleteLeave({{ $leave }})' type="button"
                                    class="btn btn-xs btn-danger waves-effect waves-light">Sure?
                            </button>
                          @endif
                        </div>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="6">
                        <div class="mt-2 mb-2" style="text-align: center">
                          <h3 class="mb-1 mx-2">Oopsie-doodle!</h3>
                          <p class="mb-4 mx-2">
                            No data found, please sprinkle some data in my virtual bowl, and let the fun begin!
                          </p>
                          <button class="btn btn-label-primary mb-4" data-bs-toggle="modal" data-bs-target="#importModal">
                            Import From Excel
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
              placeholder: 'Select..',
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
              placeholder: 'Select..',
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
