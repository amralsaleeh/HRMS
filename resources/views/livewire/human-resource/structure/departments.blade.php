<div>

@php
  $configData = Helper::appClasses();
@endphp

@section('title', 'Departments - Structure')

<div class="demo-inline-spacing">
  <button wire:click.prevent='showNewDepartmentModal' type="button" class="btn btn-primary"
    data-bs-toggle="modal" data-bs-target="#departmentModal">
    <span class="ti-xs ti ti-plus me-1"></span>{{ __('Add New Department') }}
  </button>
</div>
<br>
<div class="card">
  <h5 class="card-header"><i class="ti ti-building ti-lg text-info me-3"></i>{{ __('Departments') }}</h5>
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr>
          <th>{{ __('ID') }}</th>
          <th>{{ __('Name') }}</th>
          {{-- <th>Coordinator</th> --}}
          <th>{{ __('Members Count') }}</th>
          <th>{{ __('Actions') }}</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @forelse($departments as $department)
        <tr>
          <td>{{ $department->id }}</td>
          <td><strong>{{ $department->name }}</strong></td>
          {{-- <td>
            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
              <li class="avatar avatar-xs pull-up"> Name 2
                <a href="#">
                  <img src="{{asset('assets/img/avatars/5.png')}}" alt="Avatar" class="rounded-circle">

                </a>
              </li>
            </ul>
          </td> --}}
          <td>
            {{ $this->getMembersCount($department->id) }}
          </td>
          <td>
            <div style="display: flex">
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                <div class="dropdown-menu">
                  <a wire:click.prevent='showEditDepartmentModal({{ $department }})' data-bs-toggle="modal" data-bs-target="#departmentModal" class="dropdown-item" href=""><i class="ti ti-pencil me-1"></i> {{ __('Edit') }}</a>
                  <a wire:click.prevent='confirmDeleteDepartment({{ $department->id }})' class="dropdown-item" href=""><i class="ti ti-trash me-1"></i> {{ __('Delete') }}</a>
                </div>
              </div>
              @if ($confirmedId === $department->id)
                <button wire:click.prevent='deleteDepartment({{ $department }})' type="button" class="btn btn-sm btn-danger waves-effect waves-light">Sure?</button>
              @endif
            </div>
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
                <button class="btn btn-label-primary mb-4" data-bs-toggle="modal" data-bs-target="#departmentModal">
                    {{ __('Add New Department') }}
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
</div>

{{-- Modal --}}
@include('_partials/_modals/modal-department')
</div>
