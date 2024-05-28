@push('custom-css')

@endpush

<div wire:ignore.self class="modal fade" id="subCategoryModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog  modal-simple">
    <div class="modal-content p-3 p-md-5">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-4">
          <h3 class="mb-2"></h3>
          <h3 class="mb-2">{{ $isEdit ? 'Update SubCategory' : 'New SubCategory' }}</h3>
          <p class="text-muted">Please fill out the following information</p>
        </div>
        <form wire:submit="submitSubCategory" class="row g-3">
          <div class="col-12 mb-4">
            <label class="form-label w-100">Name</label>
            <input wire:model='subCategoryName' class="form-control @error('subCategoryName') is-invalid @enderror" type="text" />
          </div>
          <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
            <button type="reset" class="btn btn-label-secondary btn-reset" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@push('custom-scripts')

@endpush
