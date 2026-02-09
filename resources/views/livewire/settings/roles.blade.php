<div>

  @php
    $configData = Helper::appClasses();
  @endphp

  @section('title', 'Roles - Settings')

  <div class="demo-inline-spacing">
    <button wire:click.prevent='showNewRoleModal' type="button" class="btn btn-primary"
      data-bs-toggle="modal" data-bs-target="#roleModal">
      <span class="ti-xs ti ti-plus me-1"></span>{{ __('Add New Role') }}
    </button>
  </div>
  <br>
  <div class="card">
    <h5 class="card-header"><i class="ti ti-shield ti-lg text-info me-3"></i>{{ __('Roles') }}</h5>
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr>
            <th>{{ __('ID') }}</th>
            <th>{{ __('Name') }}</th>
            <th>{{ __('Permissions') }}</th>
            <th>{{ __('Actions') }}</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @forelse($roles as $role)
            <tr>
              <td>{{ $role->id }}</td>
              <td><strong>{{ $role->name }}</strong></td>
              <td>{{ $role->getPermissionNames()->join(', ') }}</td>
              <td>
                <div style="display: flex">
                  <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                    <div class="dropdown-menu">
                      <a wire:click.prevent='showEditRoleModal({{ $role->id }})' data-bs-toggle="modal" data-bs-target="#roleModal" class="dropdown-item" href=""><i class="ti ti-pencil me-1"></i>{{ __('Edit') }}</a>
                      <a wire:click.prevent='confirmDeleteRole({{ $role->id }})' class="dropdown-item" href=""><i class="ti ti-trash me-1"></i>{{ __('Delete') }}</a>
                    </div>
                  </div>
                  @if ($confirmedId === $role->id)
                    <button wire:click.prevent='deleteRole({{ $role->id }})' type="button" class="btn btn-sm btn-danger waves-effect waves-light">{{ __('Sure?') }}</button>
                  @endif
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
                  <button class="btn btn-label-primary mb-4" data-bs-toggle="modal" data-bs-target="#roleModal">
                    {{ __('Add New Role') }}
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
  @include('_partials/_modals/modal-role')

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
      window.addEventListener('open-role-modal', function () {
        $('#roleModal').modal('show');
      });
    </script>
  @endpush
</div>
