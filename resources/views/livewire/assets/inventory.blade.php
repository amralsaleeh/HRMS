<div>

@php
  $configData = Helper::appClasses();
@endphp

@section('title', 'Inventory - Assets')

@section('vendor-style')

@endsection

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

<div class="card">
  <div class="card-header d-flex justify-content-between">
    <h5 class="card-title m-0 me-2">Assets</h5>
    <div class="dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0 gap-2">
      <div id="DataTables_Table_0_filter" class="dataTables_filter">
        <label>
          <input autofocus wire:model.live="search_term" type="text" class="form-control" placeholder="Search (ID, Old ID, Serial Number...)">
        </label>
      </div>



      <div class="dt-buttons">
        <button wire:click.prevent='showNewAssetModal' type="button" class="btn btn-primary"
          data-bs-toggle="modal" data-bs-target="#assetModal">
          <span class="ti-xs ti ti-plus me-1"></span>Add New Asset
        </button>
      </div>
    </div>
  </div>
  <div class="table-responsive text-nowrap">
    <table class="table table-hover">
      <thead>
        <tr>
          <th class="col-1">ID</th>
          <th class="col-1">Old ID</th>
          <th class="col-1">Serial Number</th>
          <th>Discripton</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @forelse ($assets as $asset)
          <tr>
            <td wire:click='showAsset' class="td" style="cursor: pointer;"><i class="ti ti-tag ti-sm text-danger me-3"></i> <strong>{{ $asset->id }}</strong></td>
         {{-- wire:click='showAsset' --}}
          <tr class="cursor-pointer">
            <td><i class="ti ti-tag ti-sm text-danger me-3"></i> <strong>{{ $asset->id }}</strong></td>
            <td>{{ $asset->old_id }}</td>
            <td>{{ $asset->serial_number }}</td>
            <td>{{ $asset->description }}</td>
            <td><span class="badge bg-label-{{ $colors[$asset->status] }} me-1">{{ $asset->status }}</span></td>
            <td>
              <button type="button" class="btn btn-sm btn-tr rounded-pill btn-icon btn-outline-secondary waves-effect">
                <span class="ti ti-arrow-guide"></span>
              </button>
              <button type="button" class="btn btn-sm btn-tr rounded-pill btn-icon btn-outline-secondary waves-effect">
                <span wire:click.prevent='showEditAssetModal({{ $asset }})' data-bs-toggle="modal" data-bs-target="#assetModal" class="ti ti-pencil"></span>
              </button>
              <button type="button" class="btn btn-sm btn-tr rounded-pill btn-icon btn-outline-danger waves-effect">
                <span wire:click.prevent='confirmDeleteAsset({{ $asset }})' class="ti ti-trash"></span>
              </button>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                <div class="dropdown-menu">
                  <a wire:click.prevent='showEditAssetModal({{ $asset }})' data-bs-toggle="modal" data-bs-target="#assetModal" class="dropdown-item" href="javascript:void(0);"><i class="ti ti-pencil me-1"></i> Edit</a>
                  <a wire:click.prevent='confirmDeleteAsset({{ $asset }})' class="dropdown-item" href="javascript:void(0);"><i class="ti ti-trash me-1"></i> Delete</a>
                </div>
                @if ($confirmedId === $asset->id)
                  <button wire:click.prevent='deleteAsset({{ $asset }})' type="button" class="btn btn-sm btn-danger waves-effect waves-light">Sure?</button>
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
{{-- </> --}}

{{-- Modal --}}
@include('_partials/_modals/modal-inventory')
</div>
