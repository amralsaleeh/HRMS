<div>

  @php
    $configData = Helper::appClasses();
  @endphp

  @section('title', 'Statistics')

  @section('vendor-style')

  @endsection

  @section('page-style')
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
  @endsection

  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}">Dashboard</a>
      </li>
      <li class="breadcrumb-item active">Human Resource</li>
      <li class="breadcrumb-item active">Statistics</li>
    </ol>
  </nav>

  <div class="row">
    <div class="nav-align-top mb-4">
      <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
        <li class="nav-item" role="presentation">
          <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-home" aria-controls="navs-pills-justified-home" aria-selected="true" tabindex="-1"><i class="tf-icons ti ti-coin ti-xs me-1"></i> Discount {{-- <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger ms-1">3</span> --}}</button>
        </li>
        {{-- <li class="nav-item" role="presentation">
          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-profile" aria-controls="navs-pills-justified-profile" aria-selected="false" tabindex="-1"><i class="tf-icons ti ti-user ti-xs me-1"></i> Profile</button>
        </li>
        <li class="nav-item" role="presentation">
          <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-messages" aria-controls="navs-pills-justified-messages" aria-selected="true"><i class="tf-icons ti ti-message-dots ti-xs me-1"></i> Messages</button>
        </li> --}}
      </ul>
      <div class="tab-content">
        <div class="tab-pane fade active show" id="navs-pills-justified-home" role="tabpanel">
          <div class="row">
            <form class="p-4">
              <div class="text-center">
                <p class="text-muted">Please select the timeframe to display discounts:</p>
              </div>
              <div wire:ignore class="mb-3" style="text-align: center">
                {{-- <label class="form-label">batch</label> --}}
                <select wire:model='selectedBatch' id="select2Batches" class="select2 form-select @error('selectedBatch') is-invalid @enderror">
                  <option value=""></option>
                  @foreach ($batches as $batche)
                      <option value="{{ $batche }}">{{ $batche }}</option>
                  @endforeach
                </select>
              </div>
            </form>
          </div>

          <div class="card">
            {{-- <div class="card-header">
              Discounts info
            </div> --}}
            <div class="card-body">
              @foreach ($employeeDiscounts as $employee)
              <div class="card card-action mb-4">
                <div class="card-header">
                  <div class="card-action-title d-flex overflow-hidden align-items-center">
                    {{-- <i class="ti ti-menu-2 ti-sm cursor-pointer d-lg-none d-block me-2" data-bs-toggle="sidebar" data-overlay="" data-target="#app-chat-contacts"></i>
                    <div class="flex-shrink-0 avatar">
                      <img src="{{ asset($employee->getEmployeePhoto()) }}" alt="Avatar" class="rounded-circle">
                    </div>
                    <div class="chat-contact-info flex-grow-1 ms-2">
                      <h6 class="m-0">{{ $employee->full_name }}</h6>
                      <small class="user-status text-muted">{{ $employee->current_position }}</small>
                    </div> --}}
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
                          {{-- <i class="ti ti-calendar"></i> {{ 'Joined ' . $employee->join_at }} --}}
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="card-title-elements">
                      <div class="d-flex text-muted">
                        <i class="ti ti-letter-b d-sm-block" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{ $employee->max_leave_allowed }}"></i>
                        <i class="ti ti-letter-h d-sm-block" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{ $employee->hourly_counter }}"></i>
                        <i class="ti ti-letter-d d-sm-block me-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{ $employee->delay_counter }}"></i>
                      </div>
                      <i class="ti ti-phone-call d-sm-block me-3 text-muted" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{'+'. implode(' ', str_split($employee->mobile_number, 3)) }}"></i>
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
        </div>
        {{-- <div class="tab-pane fade" id="navs-pills-justified-profile" role="tabpanel">
          <p>
            Donut dragée jelly pie halvah. Danish gingerbread bonbon cookie wafer candy oat cake ice cream. Gummies
            halvah
            tootsie roll muffin biscuit icing dessert gingerbread. Pastry ice cream cheesecake fruitcake.
          </p>
          <p class="mb-0">
            Jelly-o jelly beans icing pastry cake cake lemon drops. Muffin muffin pie tiramisu halvah cotton candy
            liquorice caramels.
          </p>
        </div> --}}
        {{-- <div class="tab-pane fade active show" id="navs-pills-justified-messages" role="tabpanel">
          <p>
            Oat cake chupa chups dragée donut toffee. Sweet cotton candy jelly beans macaroon gummies cupcake gummi
            bears
            cake chocolate.
          </p>
          <p class="mb-0">
            Cake chocolate bar cotton candy apple pie tootsie roll ice cream apple pie brownie cake. Sweet roll icing
            sesame snaps caramels danish toffee. Brownie biscuit dessert dessert. Pudding jelly jelly-o tart brownie
            jelly.
          </p>
        </div> --}}
      </div>
    </div>
  </div>

  @push('custom-scripts')
    <script src="{{ asset('assets/js/cards-actions.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>

    <script>
      'use strict';

      $(function () {
        const select2 = $('.select2');

        // Default
        if (select2.length) {
          select2.each(function () {
            var $this = $(this);
            $this.wrap('<div class="position-relative"></div>').select2({
              dropdownParent: $this.parent()
            });
          });
        }

        $('#select2Batches').on('change', function (e) {
            var data = $('#select2Batches').select2("val");
        @this.set('selectedBatch', data);
        });
      });
    </script>
  @endpush
</div>
