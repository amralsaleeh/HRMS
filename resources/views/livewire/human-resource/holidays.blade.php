<div>

  @php
    $configData = Helper::appClasses();
  @endphp

  @section('title', 'Holidays')

  <div class="demo-inline-spacing">
    <button wire:click.prevent='showNewHolidayModal' type="button" class="btn btn-primary"
      data-bs-toggle="modal" data-bs-target="#holidayModal">
      <span class="ti-xs ti ti-plus me-1"></span>{{ __('Add New Holiday') }}
    </button>
  </div>
  <br>
  <div class="card">
    <h5 class="card-header"><i class="ti ti-christmas-tree ti-lg text-info me-3"></i>{{ __('Holidays') }}</h5>
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr>
            <th>{{ __('Name') }}</th>
            <th>{{ __('Center') }}</th>
            <th>{{ __('Date Range') }}</th>
            <th>{{ __('Note') }}</th>
            <th>{{ __('Actions') }}</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @forelse($holidays as $holiday)
          <tr>
            <td><strong>{{ $holiday->name }}</strong></td>
            <td style="text-wrap: balance;">
                @foreach($holiday->centers as $center)
                    <span class="badge bg-label-info">{{ $center->name }}</span>
                @endforeach
            </td>
            <td><span class="badge bg-label-success me-1">{{ $holiday->from_date . ' --> ' . $holiday->to_date }}</span></td>
            <td><strong>{{ $holiday->note }}</strong></td>
            <td>
              <div style="display: flex">
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                  <div class="dropdown-menu">
                    <a wire:click.prevent='showEditHolidayModal({{ $holiday }})' data-bs-toggle="modal" data-bs-target="#holidayModal" class="dropdown-item" href=""><i class="ti ti-pencil me-1"></i> {{ __('Edit') }}</a>
                    <a wire:click.prevent='confirmDeleteHoliday({{ $holiday->id }})' class="dropdown-item" href=""><i class="ti ti-trash me-1"></i> {{ __('Delete') }}</a>
                  </div>
                </div>
                @if ($confirmedId === $holiday->id)
                  <button wire:click.prevent='deleteHoliday({{ $holiday }})' type="button" class="btn btn-sm btn-danger waves-effect waves-light">{{ __('Sure?') }}</button>
                @endif
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="5">
              <div class="mt-2 mb-2" style="text-align: center">
                  <h3 class="mb-1 mx-2">{{ __('Oopsie-doodle!') }}</h3>
                  <p class="mb-4 mx-2">
                    {{ __('No data found, please sprinkle some data in my virtual bowl, and let the fun begin!') }}
                  </p>
                  <button class="btn btn-label-primary mb-4" data-bs-toggle="modal" data-bs-target="#holidayModal">
                    {{ __('Add New Holiday') }}
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

    <div class="row mt-4">
      {{ $holidays->links() }}
    </div>
  </div>

  {{-- Modal --}}
  @include('_partials/_modals/modal-holiday')
  </div>
