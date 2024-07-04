<div>

@php
  $configData = Helper::appClasses();
@endphp

@section('title', 'Categories')

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
    <div class="d-flex justify-content-start mb-2">
      <button wire:click.prevent='showNewCategoryModal' type="button" data-bs-toggle="modal" data-bs-target="#categoryModal" class="btn btn-primary waves-effect"><span class="ti-xs ti ti-plus me-1"></span>{{ __('Add New Category') }}</button>
    </div>
    <div class="card">
      <div class="card-header d-flex justify-content-between">
        <h5 class="card-title m-0 me-2">{{ __('Categories') }}</h5>
        <div class="col-6">
          <input wire:model.live="search_term_categories" type="text" class="form-control" placeholder="{{ __('Search (ID, Category...)') }}">
        </div>
      </div>
      <div class="table-responsive text-nowrap">
        <table class="table table-hover">
          <thead>
            <tr>
              <th class="col-1">{{ __('ID') }}</th>
              <th>{{ __('Name') }}</th>
              <th>{{-- Actions --}}</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            @forelse ($categories as $category)
              <tr>
                <td><i class="ti ti-tag ti-sm text-primary me-3"></i> <strong>{{ $category->id }}</strong></td>
                <td wire:click='showCategoryInfo({{ $category->id }})' data-bs-toggle="modal" data-bs-target="#categoryInfoModal" class="td" style="cursor: pointer;">{{ $category->name }}</td>
                <td>
                  <button type="button" class="btn btn-sm btn-tr rounded-pill btn-icon btn-outline-secondary waves-effect">
                    <span wire:click.prevent='showEditCategoryModal({{ $category }})' data-bs-toggle="modal" data-bs-target="#categoryModal" class="ti ti-pencil"></span>
                  </button>
                  <button type="button" class="btn btn-sm btn-tr rounded-pill btn-icon btn-outline-danger waves-effect">
                    <span wire:click.prevent='confirmDeleteCategory({{ $category->id }})' class="ti ti-trash"></span>
                  </button>
                  @if ($confirmedCategoryId === $category->id)
                    <button wire:click.prevent='deleteCategory({{ $category }})' type="button" class="btn btn-sm btn-danger waves-effect waves-light">{{ __('Sure?') }}</button>
                  @endif
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" style="text-wrap: balance;">
                  <div class="mt-2 mb-2" style="text-align: center">
                      <h3 class="mb-1 mx-2">{{ __('Oopsie-doodle!') }}</h3>
                      <p class="mb-4 mx-2">
                        {{ __('No data found, please sprinkle some data in my virtual bowl, and let the fun begin!') }}
                      </p>
                      <button class="btn btn-label-primary mb-4" data-bs-toggle="modal" data-bs-target="#categoryModal">
                         {{ __('Add New category') }}
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
    <div class="d-flex justify-content-start mb-2">
      <button wire:click='showNewSubCategoryModal' type="button" data-bs-toggle="modal" data-bs-target="#subCategoryModal" class="btn btn-primary waves-effect"><span class="ti-xs ti ti-plus me-1"></span>{{ __('Add New Sub-Category') }}</button>
    </div>
    <div class="card">
      <div class="card-header d-flex justify-content-between">
        <h5 class="card-title m-0 me-2">{{ __('Sub-Categories') }}</h5>
        <div class="col-6">
          <input wire:model.live="search_term_sub_categories" type="text" class="form-control" placeholder="{{ __('Search (ID, Sub-Category...)') }}">
        </div>
      </div>
      <div class="table-responsive text-nowrap">
        <table class="table table-hover">
          <thead>
            <tr>
              <th class="col-1">{{ __('ID') }}</th>
              <th>{{ __('Name') }}</th>
              <th>{{-- Actions --}}</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            @forelse ($subCategories as $subCategory)
              <tr>
                <td><i class="ti ti-tag ti-sm text-primary me-3"></i> <strong>{{ $subCategory->id }}</strong></td>
                <td wire:click='showSubCategoryInfo' class="td" style="cursor: pointer;">{{ $subCategory->name }}</td>
                <td>
                  <button type="button" class="btn btn-sm btn-tr rounded-pill btn-icon btn-outline-secondary waves-effect">
                    <span wire:click.prevent='showEditSubCategoryModal({{ $subCategory }})' data-bs-toggle="modal" data-bs-target="#subCategoryModal" class="ti ti-pencil"></span>
                  </button>
                  <button type="button" class="btn btn-sm btn-tr rounded-pill btn-icon btn-outline-danger waves-effect">
                    <span wire:click.prevent='confirmDeleteSubCategory({{ $subCategory->id }})' class="ti ti-trash"></span>
                  </button>
                  @if ($confirmedSubCategoryId === $subCategory->id)
                    <button wire:click.prevent='deleteSubCategory({{ $subCategory }})' type="button" class="btn btn-sm btn-danger waves-effect waves-light">{{ __('Sure?') }}</button>
                  @endif
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" style="text-wrap: balance;">
                  <div class="mt-2 mb-2" style="text-align: center">
                      <h3 class="mb-1 mx-2">{{ __('Oopsie-doodle!') }}</h3>
                      <p class="mb-4 mx-2">
                       {{ __('No data found, please sprinkle some data in my virtual bowl, and let the fun begin!') }}
                      </p>
                      <button class="btn btn-label-primary mb-4" data-bs-toggle="modal" data-bs-target="#subCategoryModal">
                          {{ __('Add New Sub-Category') }}
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

{{-- Modal --}}
@include('_partials/_modals/modal-category')
@include('_partials/_modals/modal-categoryInfo')
@include('_partials/_modals/modal-sub-category')

@push('custom-scripts')

@endpush

</div>
