<div>

@php
  $configData = Helper::appClasses();
@endphp

@section('title', 'Employees - Structure')

<div class="demo-inline-spacing">
  <button wire:click='showCreateEmployeeModal' type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#employeeModal">
    <span class="ti-xs ti ti-plus me-1"></span>{{ __('Add New Employee') }}
  </button>
</div>
<br>
<div class="card">
  <div class="card-header d-flex flex-wrap align-items-center gap-2">
    <h5 class="card-title m-0 me-2"><i class="ti ti-users ti-lg text-info me-3"></i>{{ __('Employees') }}</h5>
    <div class="order-2 order-md-0 mt-2 mt-md-0 ms-md-auto" style="width: 100%; max-width: 300px;">
      <input wire:model.live="searchTerm" autofocus type="text" class="form-control" placeholder="{{ __('Search (ID, Name...)') }}">
    </div>
  </div>
  <div class="table-responsive text-nowrap">
    <table class="table table-layout-employees">
      <thead>
        <tr>
          <th>{{ __('ID') }}</th>
          <th>{{ __('Avatar') }}</th>
          <th class="employee-name-cell">{{ __('Name') }}</th>
          <th>{{ __('Mobile') }}</th>
          <th>{{ __('Status') }}</th>
          <th>{{ __('Actions') }}</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @forelse($employees as $employee)
        <tr>
          <td>{{ $employee->id }}</td>
          <td>
            <a href="{{ route('structure-employees-info', $employee->id) }}" class="d-inline-block text-decoration-none">
              <img src="{{ Storage::disk('public')->exists($employee->profile_photo_path) ? Storage::disk('public')->url($employee->profile_photo_path) : '/storage/'.config('app.default_profile_photo_path', 'profile-photos/.default-photo.jpg') }}" alt="Avatar" class="rounded-circle" width="32" height="32">
            </a>
          </td>
          <td class="employee-name-cell">
            <a href="{{ route('structure-employees-info', $employee->id) }}" class="d-block text-decoration-none text-body text-truncate">{{ $employee->full_name }}</a>
          </td>
          <td style="direction: ltr">{{ '+963 ' . number_format($employee->mobile_number, 0, '', ' ') }}</td>
          <td>
            @if ($employee->is_active)
              <span class="badge bg-label-success me-1">{{ __('Active') }}</span>
            @else
              <span class="badge bg-label-danger me-1">{{ __('Out of work') }}</span>
            @endif
          </td>
          <td>
            <div style="display: flex">
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                <div class="dropdown-menu">
                  <a wire:click.prevent='showEditEmployeeModal({{ $employee }})' data-bs-toggle="modal" data-bs-target="#employeeModal" class="dropdown-item" href=""><i class="ti ti-pencil me-1"></i>{{ __('Edit') }} </a>
                  <a wire:click.prevent='confirmDeleteEmployee({{ $employee->id }})' class="dropdown-item" href=""><i class="ti ti-trash me-1"></i> {{ __('Delete') }}</a>
                </div>
              </div>
              @if ($confirmedId === $employee->id)
                <button wire:click.prevent='deleteEmployee({{ $employee }})' type="button" class="btn btn-sm btn-danger waves-effect waves-light">{{ __('Sure?') }}</button>
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
                <button class="btn btn-label-primary mb-4" data-bs-toggle="modal" data-bs-target="#employeeModal">
                    {{ __('Add New Employee') }}
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
    {{ $employees->links() }}
  </div>

</div>

{{-- Modal --}}
@include('_partials/_modals/modal-employee')

@push('custom-scripts')
  <style>
    /* Allow dropdown menu to extend outside table when open (avoids clipping Edit/Delete) */
    .table-responsive.dropdown-open { overflow: visible !important; }
    /* Constrain Name column so long names don't overflow into Mobile on large screens */
    .table-layout-employees .employee-name-cell { max-width: 20rem; overflow: hidden; }
    .table-layout-employees .employee-name-cell a { min-width: 0; display: block; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
  </style>
  <script>
    $(function () {
      $(document).on('show.bs.dropdown', function (e) {
        var $wrap = $(e.target).closest('.table-responsive');
        if ($wrap.length) $wrap.addClass('dropdown-open');
      });
      $(document).on('hide.bs.dropdown', function (e) {
        var $wrap = $(e.target).closest('.table-responsive');
        if ($wrap.length) $wrap.removeClass('dropdown-open');
      });
    });
  </script>
@endpush
</div>
