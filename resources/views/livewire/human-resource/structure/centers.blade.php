<div>

@php
  $configData = Helper::appClasses();
@endphp

@section('title', 'Centers')

<div class="demo-inline-spacing">
  <button wire:click.prevent='showNewCenterModal' type="button" class="btn btn-primary"
    data-bs-toggle="modal" data-bs-target="#centerModal">
    <span class="ti-xs ti ti-plus me-1"></span>Add New Center
  </button>
</div>
<br>
<div class="card">
  <h5 class="card-header"><i class="ti ti-building-community ti-lg text-info me-3"></i>Centers</h5>
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          {{-- <th>Supervisor</th> --}}
          <th>Members count</th>
          <th>Working hours</th>
          <th>Weekends</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @forelse($centers as $center)
        <tr>
          <td>{{ $center->id }}</td>
          <td><strong>{{ $center->name }}</strong></td>
          {{-- <td>
            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
              <li class="avatar avatar-xs pull-up">
                <a href="#">
                  <img src="{{asset('assets/img/avatars/5.png')}}" alt="Avatar" class="rounded-circle">
                  {{ $this->getSupervisor(5) }}
                </a>
              </li>
            </ul>
          </td> --}}
          <td>
            {{ $this->getMembersCount($center->id) }}
          </td>
          <td><span class="badge bg-label-success me-1">{{ $center->start_work_hour . ' - ' . $center->end_work_hour }}</span></td>
          <td>{{ $this->getDaysName($center->weekends) }}</td>
          <td>
            <div style="display: flex">
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                <div class="dropdown-menu">
                  <a wire:click.prevent='showEditCenterModal({{ $center }})' data-bs-toggle="modal" data-bs-target="#centerModal" class="dropdown-item" href=""><i class="ti ti-pencil me-1"></i> Edit</a>
                  <a wire:click.prevent='confirmDeleteCenter({{ $center->id }})' class="dropdown-item" href=""><i class="ti ti-trash me-1"></i> Delete</a>
                </div>
              </div>
              @if ($confirmedId === $center->id)
                <button wire:click.prevent='deleteCenter({{ $center }})' type="button" class="btn btn-sm btn-danger waves-effect waves-light">Sure?</button>
              @endif
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="6">
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
@include('_partials/_modals/modal-center')
</div>
