<div class="card">
  <div class="card-header d-flex justify-content-between">
    <h5 class="card-title m-0 me-2">Assets</h5>
    <div class="col-4">
      <input wire:model.live="search_term" type="text" class="form-control" placeholder="Search (ID, Old ID...)">
    </div>
  </div>
  <div class="table-responsive text-nowrap">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>ID</th>
          <th>Old ID</th>
          <th>Serial Number</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @forelse ($assets as $asset)
          <tr>
            <td><i class="ti ti-tag ti-sm text-danger me-3"></i> <strong>{{ $asset->id }}</strong></td>
            <td>{{ $asset->old_id }}</td>
            <td>{{ $asset->serial_number }}</td>
            <td><span class="badge bg-label-{{ $colors[$asset->status] }} me-1">{{ $asset->status }}</span></td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="javascript:void(0);"><i class="ti ti-pencil me-1"></i> Edit</a>
                  <a class="dropdown-item" href="javascript:void(0);"><i class="ti ti-trash me-1"></i> Delete</a>
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
                  <button class="btn btn-label-primary mb-4" data-bs-toggle="modal" data-bs-target="#assetModal">
                      Add New Asset
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
    {{ $assets->links() }}
  </div>

</div>
