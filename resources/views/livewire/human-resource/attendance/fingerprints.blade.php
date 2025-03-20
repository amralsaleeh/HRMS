<div>

  @php
    $configData = Helper::appClasses();
  @endphp

  @section('title', 'Attendance - Fingerprints')

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
                  <label class="form-label">{{ __('Employee') }}</label>
                  <select wire:model='selectedEmployeeId' class="select2 form-control" id="select2selectedEmployeeId">
                    @forelse ($employees as $employee)
                      <option value="{{ $employee->id }}">{{ $employee->id . ' - ' . $employee->full_name }}</option>
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
                   id="flatpickr-range" placeholder="YYYY-MM-DD to YYYY-MM-DD" readonly="readonly">
          </div>
        </div>

        <div class="border-bottom p-3 my-sm-0 mb-3">
          <div class="col-12">
            <label class="form-label">{{ __('Options') }}</label>
          </div>
          <div class="ms-3">
            <div class="form-check form-check-danger mb-2">
              <input wire:model='isAbsence' class="form-check-input input-filter" type="checkbox" id="isAbsence">
              <label class="form-check-label" for="isAbsence">{{ __('Absence') }}</label>
            </div>
            <div class="form-check form-check-warning mb-2">
              <input wire:model='isOneFingerprint' class="form-check-input input-filter" type="checkbox" id="isOneFingerprint">
              <label class="form-check-label" for="isOneFingerprint">{{ __('One Fingerprint') }}</label>
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
          <div class="card-body pb-0" style="height: 500px;">
            <div>
              <div class="row d-flex justify-content-between">
                <div class="col-7 p-0 d-flex overflow-hidden align-items-center">
                  <a class="nav-item d-xl-none nav-link px-0 mx-2" href="javascript:void(0)" data-bs-toggle="sidebar" data-overlay="" data-target="#app-calendar-sidebar">
                    <i class="ti ti-menu-2 ti-sm"></i>
                  </a>
                  <div class="flex-shrink-0 avatar">
                    <img src="{{ Storage::disk("public")->exists($selectedEmployee->profile_photo_path) ? Storage::disk("public")->url($selectedEmployee->profile_photo_path) : Storage::disk("public")->url('profile-photos/.default-photo.jpg') }}" class="rounded-circle" alt="Avatar">
                  </div>
                  <div class="chat-contact-info flex-grow-1 ms-2">
                    <h6 class="m-0">{{ $selectedEmployee->full_name }}</h6>
                    <small class="user-status text-muted">{{ $selectedEmployee->current_position }}</small>
                  </div>
                </div>

                <div class="col-5 btn-group d-flex justify-content-end">
                  <button {{ Auth::user()->hasRole('Admin') ? "" : "disabled" }}  wire:click.prevent='showNewFingerprintModal' type="button" class="btn btn-primary waves-effect waves-light"
                          data-bs-toggle="offcanvas" data-bs-target="#addRecordSidebar" aria-controls="addRecordSidebar"><i
                          class="ti ti-plus me-1"></i> {{ __('Add New Record') }}
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
                      <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#importModal">
                        <i class="ti ti-table-import me-1"></i> {{ __('Import From Excel') }}
                      </button>
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
                    <th>{{ __('Date') }}</th>
                    <th>{{ __('Check In') }}</th>
                    <th>{{ __('Check Out') }}</th>
                    <th>{{ __('Excuse') }}</th>
                    <th class="col-1">{{ __('Actions') }}</th>
                  </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                  @forelse($fingerprints as $fingerprint)
                    <tr>
                      <td>{{ $fingerprint->date }}</td>
                      <td >
                        <div class="badge rounded-pill bg-label-secondary">{{ $fingerprint->check_in }}</div>
                      </td>
                      <td>
                        <div class="badge rounded-pill bg-label-secondary">{{ $fingerprint->check_out }}</div>
                      </td>
                      <td>
                        <div class="badge rounded-pill bg-label-secondary">{{ $fingerprint->excuse }}</div>
                      </td>
                      <td>
                        <div>
                          <a wire:click.prevent="showEditFingerprintModal({{ $fingerprint }})" data-bs-toggle="offcanvas" data-bs-target="#addRecordSidebar" href=""><i
                              class="ti ti-edit text-info"></i></a>
                          <a wire:click.prevent="confirmDeleteFingerprint({{ $fingerprint->id }})" href=""><i
                              class="ti ti-trash text-danger"></i></a>
                          @if ($confirmedId === $fingerprint->id)
                            <button wire:click.prevent='deleteFingerprint({{ $fingerprint }})' type="button"
                                    class="btn btn-xs btn-danger waves-effect waves-light">{{ __('Sure?') }}
                            </button>
                          @endif
                        </div>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="4">
                        <div class="mt-2 mb-2" style="text-align: center">
                          <h3 class="mb-1 mx-2">{{ __('Oopsie-doodle!') }}</h3>
                          <p class="mb-4 mx-2">
                            {{ __('No data found, please sprinkle some data in my virtual bowl, and let the fun begin!') }}
                          </p>
                          <button class="btn btn-label-primary mb-4" data-bs-toggle="modal" data-bs-target="#importModal">
                            {{ __('Import From Excel') }}
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
              {{ $fingerprints->links() }}
            </div>
          </div>
        </div>

        <div class="app-overlay"></div>
      </div>
      <!-- /Calendar-->
    </div>

    {{-- Modals --}}
    @include('_partials/_modals/modal-fingerprint')
    @include('_partials/_modals/modal-import')
  </div>

  @push('custom-scripts')
    <script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>

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

    <script>
      'use strict';

      $(function () {
        const selectPicker = select2 = $('.select2');

        if (select2.length) {
          select2.each(function () {
            var $this = $(this);
            $this.wrap('<div class="position-relative"></div>').select2({
              placeholder: 'Select value..',
              dropdownParent: $this.parent()
            });
          });
        }

        $('#select2selectedEmployeeId').on('change', function (e) {
          var data = $('#select2selectedEmployeeId').select2("val");
          @this.set('selectedEmployeeId', data);
        });
      });
    </script>
  @endpush
</div>
