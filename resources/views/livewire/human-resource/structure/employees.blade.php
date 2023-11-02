<div>

@php
  $configData = Helper::appClasses();
@endphp

@section('title', 'Employees')

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
          <th>ID</th>
          <th>Name</th>
          <th>Mobile</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @forelse($employees as $employee)
        <tr>
          <td></td>
          <td>
            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
              <li class="avatar avatar-xs pull-up">
                <a href="#">
                  <img src="{{asset('assets/img/avatars/5.png')}}" alt="Avatar" class="rounded-circle">
                  Name 2
                </a>
              </li>
            </ul>
          </td>
          <td></td>
          <td>
            <span class="badge bg-label-primary me-1">Active</span>
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
</div>
