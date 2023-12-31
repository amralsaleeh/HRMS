<div>

@php
  $configData = Helper::appClasses();
@endphp

@section('title', 'Employees - Structure')

<div class="demo-inline-spacing">
  <button type="button" class="btn btn-primary">
    <span class="ti-xs ti ti-plus me-1"></span>Add New Employee
  </button>
</div>
<br>
<div class="card">
  <h5 class="card-header">Employees</h5>
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr>
          <th class="col-1">ID</th>
          <th class="col-5">Name</th>
          <th class="col-2">Mobile</th>
          <th class="col-2">Status</th>
          <th class="col-2">Actions</th>
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
                  <img src="{{ asset($employee->getEmployeePhoto()) }}" alt="Avatar" class="rounded-circle">
                  {{ $employee->full_name }}
                </a>
              </li>
            </ul>
          </td>
          <td>{{ $employee->mobile_number }}</td>
          <td>
            @if ($employee->is_active)
              <span class="badge bg-label-success me-1">Active</span>
            @else
              <span class="badge bg-label-danger me-1">Out of work</span>
            @endif
          </td>
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="#"><i class="ti ti-pencil me-1"></i> Edit</a>
                <a class="dropdown-item" href="#"><i class="ti ti-trash me-1"></i> Delete</a>
              </div>
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
                <button class="btn btn-label-primary mb-4" data-bs-toggle="modal" data-bs-target="#employeeModal">
                    Add New Employee
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
</div>
