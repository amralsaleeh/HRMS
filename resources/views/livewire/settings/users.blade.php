<div>

  @php
    $configData = Helper::appClasses();
  @endphp

  @section('title', 'Users - Settings')

  <div class="demo-inline-spacing">
    <button wire:click.prevent='showNewUserModal' type="button" class="btn btn-primary"
      data-bs-toggle="modal" data-bs-target="#userModal">
      <span class="ti-xs ti ti-plus me-1"></span>{{ __('Add New User') }}
    </button>
  </div>
  <br>
  <div class="card">
    <h5 class="card-header"><i class="ti ti-users ti-lg text-info me-3"></i>{{ __('Users') }}</h5>
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr>
            <th>{{ __('ID') }}</th>
            <th>{{ __('Name') }}</th>
            <th>{{ __('Email') }}</th>
            <th>{{ __('Username') }}</th>
            <th>{{ __('Roles') }}</th>
            <th>{{ __('Actions') }}</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @forelse($users as $user)
            <tr>
              <td>{{ $user->id }}</td>
              <td><strong>{{ $user->name }}</strong></td>
              <td>{{ $user->email }}</td>
              <td>{{ $user->username }}</td>
              <td>{{ $user->getRoleNames()->join(', ') }}</td>
              <td>
                <div style="display: flex">
                  <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                    <div class="dropdown-menu">
                      <a wire:click.prevent='showEditUserModal({{ $user->id }})' data-bs-toggle="modal" data-bs-target="#userModal" class="dropdown-item" href=""><i class="ti ti-pencil me-1"></i>{{ __('Edit') }}</a>
                      <a wire:click.prevent='confirmDeleteUser({{ $user->id }})' class="dropdown-item" href=""><i class="ti ti-trash me-1"></i>{{ __('Delete') }}</a>
                    </div>
                  </div>
                  @if ($confirmedId === $user->id)
                    <button wire:click.prevent='deleteUser({{ $user->id }})' type="button" class="btn btn-sm btn-danger waves-effect waves-light">{{ __('Sure?') }}</button>
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
                  <button class="btn btn-label-primary mb-4" data-bs-toggle="modal" data-bs-target="#userModal">
                    {{ __('Add New User') }}
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
  @include('_partials/_modals/modal-user')

  @push('custom-scripts')
    <style>
      /* Allow dropdown menu to extend outside table when open (avoids clipping Edit/Delete) */
      .table-responsive.dropdown-open { overflow: visible !important; }
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
      window.addEventListener('open-user-modal', function () {
        $('#userModal').modal('show');
      });
    </script>
  @endpush
</div>
