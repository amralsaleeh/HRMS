<div>

@php
  $configData = Helper::appClasses();
@endphp

<div class="demo-inline-spacing">
  <button type="button" class="btn btn-primary">
    <span class="ti-xs ti ti-plus me-1"></span>Add New Position
  </button>
</div>
<br>
<div class="card">
  <h5 class="card-header">Positions</h5>
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Vacancies count</th>
          <th>Members count</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @forelse($positions as $position)
        <tr>
          <td><i class="ti ti-building-community ti-lg text-info me-3"></i> <strong>Name 1</strong></td>
          <td>
            Count
          </td>
          <td>
            Count
          </td>
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
