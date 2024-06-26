<div>

@php
  $configData = Helper::appClasses();
@endphp

@section('title', 'Employees - Structure')

<div class="demo-inline-spacing">
  <button wire:click='showNewEmployeeModal' type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#employeeModal">
    <span class="ti-xs ti ti-plus me-1"></span>{{ __('Add New Employee') }}
  </button>
</div>
<br>
<div class="card">
  <div class="card-header d-flex justify-content-between">
    <h5 class="card-title m-0 me-2">{{ __('Employees') }}</h5>
    <div class="col-4">
      <input wire:model.live="searchTerm" type="text" class="form-control" placeholder="{{ __('Search (ID, Name...)') }}">
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
          <td>{{ '0' . number_format($employee->mobile_number, 0, '', ' ') }}</td>
          <td>
            @if ($employee->is_active)
              <span class="badge bg-label-success me-1">{{ __('Active') }}</span>
            @else
              <span class="badge bg-label-danger me-1">{{ __('Out of work') }}</span>
            @endif
          </td>
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
              <div class="dropdown-menu">
                <a wire:click='showEditEmployeeModal({{ $employee }})' class="dropdown-item" data-bs-toggle="modal" data-bs-target="#employeeModal"><i class="ti ti-pencil me-1"></i> {{ __('Edit') }}</a>
                <a class="dropdown-item" href="#"><i class="ti ti-trash me-1"></i> {{ __('Delete') }}</a>
              </div>
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
@include('_partials/_modals/model-add-employee')
</div>
