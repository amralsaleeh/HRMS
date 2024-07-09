<div>

@php
  $configData = Helper::appClasses();
@endphp

@section('title', 'Employees - Structure')

@section('page-style')
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

<div class="demo-inline-spacing">
  <button wire:click='showCreateEmployeeModal' type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#employeeModal">
    <span class="ti-xs ti ti-plus me-1"></span>{{ __('Add New Employee') }}
  </button>
</div>
<br>
<div class="card">
  <div class="card-header d-flex justify-content-between">
    <h5 class="card-title m-0 me-2">{{ __('Employees') }}</h5>
    <div class="col-4">
      <input wire:model.live="searchTerm" autofocus type="text" class="form-control" placeholder="{{ __('Search (ID, Name...)') }}">
    </div>
  </div>
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr>
          <th class="col-1">{{ __('ID') }}</th>
          <th class="col-5">{{ __('Name') }}</th>
          <th class="col-2">{{ __('Mobile') }}</th>
          <th class="col-2">{{ __('Status') }}</th>
          <th class="col-2">{{ __('Actions') }}</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @forelse($employees as $employee)
        <tr>
          <td>{{ $employee->id }}</td>
          <td>
            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
              <li class="avatar avatar-xs pull-up">
                <a href="{{ route('structure-employees-info', $employee->id) }}">
                  <img src="{{ Storage::disk("public")->url($employee->profile_photo_path) }}" alt="Avatar" class="rounded-circle">
                  {{ $employee->full_name }}
                </a>
              </li>
            </ul>
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
            <button type="button" class="btn btn-sm btn-tr rounded-pill btn-icon btn-outline-secondary waves-effect">
              <span wire:click='showEditEmployeeModal({{ $employee }})' data-bs-toggle="modal" data-bs-target="#employeeModal" class="ti ti-pencil"></span>
            </button>
            <button type="button" class="btn btn-sm btn-tr rounded-pill btn-icon btn-outline-danger waves-effect">
              <span wire:click.prevent='confirmDeleteEmployee({{ $employee->id }})' class="ti ti-trash"></span>
            </button>
            @if ($confirmedId === $employee->id)
            <button wire:click.prevent='deleteEmployee({{ $employee }})' type="button" class="btn btn-sm btn-danger waves-effect waves-light">{{ __('Sure?') }}</button>
          @endif
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
</div>
