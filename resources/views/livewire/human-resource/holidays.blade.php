<div>

  @php
    $configData = Helper::appClasses();
  @endphp

  @section('title', 'Holidays')

  <div class="col-lg">
    <div class="card">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div class="card-title mb-0">
          {{-- @foreach ( $holidays as $holiday )
          <h5 class="mb-0 me-2"> {{ $holiday->count()}}</h5> @endforeach --}}
          <h5 class="mb-0 me-2"> {{  $this->holidays->count()}}</h5>
          <small>All Holidays</small>
        </div>
        <div class="card-icon">
          <span class="badge bg-label-success rounded-pill p-2">
            <i class="ti ti-server ti-sm"></i>
          </span>
        </div>
      </div>
    </div>
  </div>

  <div class="demo-inline-spacing">
    <button wire:click.prevent='showNewHolidayModal' type="button" class="btn btn-primary"
      data-bs-toggle="modal" data-bs-target="#holidayModal">
      <span class="ti-xs ti ti-plus me-1"></span>Add Holidays
    </button>
  </div>
  <br>
  <div class="card">
    <h5 class="card-header"><i class="ti ti-christmas-tree ti-lg text-info me-3"></i>Holidays</h5>
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>From-To</th>
            <th>Note</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @forelse($holidays as $holiday)
          <tr>
            <td>{{ $holiday->id }}</td>
            <td><strong>{{ $holiday->name }}</strong></td>
            <td><span class="badge bg-label-success me-1">{{ $holiday->from_date . ' / ' . $holiday->to_date }}</span></td>

            <td><strong>{{ $holiday->note }}</strong></td>

            <td>
              <div style="display: flex">
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                  <div class="dropdown-menu">
                    <a wire:click.prevent='showEditHolidayModal({{ $holiday }})' data-bs-toggle="modal" data-bs-target="#holidayModal" class="dropdown-item" href=""><i class="ti ti-pencil me-1"></i> Edit</a>
                    <a wire:click.prevent='confirmDeleteHoliday({{ $holiday->id }})' class="dropdown-item" href=""><i class="ti ti-trash me-1"></i> Delete</a>
                  </div>
                </div>
                @if ($confirmedId === $holiday->id)
                  <button wire:click.prevent='deleteHoliday({{ $holiday }})' type="button" class="btn btn-sm btn-danger waves-effect waves-light">Sure?</button>
                @endif
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="5">
              <div class="mt-2 mb-2" style="text-align: center">
                  <h3 class="mb-1 mx-2">Oopsie-doodle!</h3>
                  <p class="mb-4 mx-2">
                    No data found, please sprinkle some data in my virtual bowl, and let the fun begin!
                  </p>
                  {{-- <a href="{{url('/')}}" class="btn btn-primary mb-4">Back to home</a> --}}
                  <div>
                    <img src="{{ asset('assets/img/illustrations/page-misc-under-maintenance.png') }}" alt="page-misc-under-maintenance" width="200" class="img-fluid">
                  </div>
              </div>
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  {{-- Modal --}}
  @include('_partials/_modals/modal-holiday')
  </div>
