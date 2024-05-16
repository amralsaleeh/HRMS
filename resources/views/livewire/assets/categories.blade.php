<div>

@php
  $configData = Helper::appClasses();
@endphp

@section('title', 'Categories')

@section('vendor-style')

@endsection

@section('page-style')

@endsection

{{-- <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('dashboard') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Human Resource</li>
    <li class="breadcrumb-item active">HERE</li>
  </ol>
</nav> --}}

<div class="row justify-content-between">
  <div class="col-6">
    <div class="card">
      <div class="card-header d-flex justify-content-between">
        <h5 class="card-title m-0 me-2">Categories</h5>
        <div class="col-6">
          <input wire:model.live="search_term_categories" type="text" class="form-control" placeholder="Search (ID, Category...)">
        </div>
      </div>
      <div class="table-responsive text-nowrap">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            @forelse ($categories as $category)
              <tr>
                <td><i class="ti ti-tag ti-sm text-danger me-3"></i> <strong>{{ $category->id }}</strong></td>
                <td>{{ $category->name }}</td>
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
                <td colspan="5" style="text-wrap: balance;">
                  <div class="mt-2 mb-2" style="text-align: center">
                      <h3 class="mb-1 mx-2">Oopsie-doodle!</h3>
                      <p class="mb-4 mx-2">
                        No data found, please sprinkle some data in my virtual bowl, and let the fun begin!
                      </p>
                      <button class="btn btn-label-primary mb-4" data-bs-toggle="modal" data-bs-target="#categoryModal">
                          Add New category
                        </button>
                      <div>
                        <img src="{{ asset('assets/img/illustrations/page-misc-under-maintenance.png') }}" width="150" class="img-fluid">
                      </div>
                  </div>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      {{-- <div class="row mt-4">
        {{ $categories->links() }}
      </div> --}}
    </div>
  </div>

  <div class="col-6">
    <div class="card">
      <div class="card-header d-flex justify-content-between">
        <h5 class="card-title m-0 me-2">Sub-Categories</h5>
        <div class="col-6">
          <input wire:model.live="search_term_sub_categories" type="text" class="form-control" placeholder="Search (ID, Sub-Category...)">
        </div>
      </div>
      <div class="table-responsive text-nowrap">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            @forelse ($subCategories as $subCategory)
              <tr>
                <td><i class="ti ti-tag ti-sm text-danger me-3"></i> <strong>{{ $subCategory->id }}</strong></td>
                <td>{{ $subCategory->name }}</td>
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
                <td colspan="5" style="text-wrap: balance;">
                  <div class="mt-2 mb-2" style="text-align: center">
                      <h3 class="mb-1 mx-2">Oopsie-doodle!</h3>
                      <p class="mb-4 mx-2">
                        No data found, please sprinkle some data in my virtual bowl, and let the fun begin!
                      </p>
                      <button class="btn btn-label-primary mb-4" data-bs-toggle="modal" data-bs-target="#subCategoryModal">
                          Add New Sub-Category
                        </button>
                      <div>
                        <img src="{{ asset('assets/img/illustrations/page-misc-under-maintenance.png') }}" width="150" class="img-fluid">
                      </div>
                  </div>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      {{-- <div class="row mt-4">
        {{ $categories->links() }}
      </div> --}}
    </div>
  </div>
</div>

@push('custom-scripts')

@endpush
</div>
