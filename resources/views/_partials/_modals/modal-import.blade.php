<div wire:ignore.self class="modal fade" id="importModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-simple">
    <div class="modal-content p-0 p-md-5">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-4">
          <h3 class="mb-2"></h3>
          <h3 class="mb-2">{{ __('Import File') }}</h3>
          <p class="text-muted">{{ __('Please select the file to upload') }}</p>
        </div>
        <form wire:submit="importFromExcel" class="row g-3">
          <div class="col-12 mb-4">
            <input wire:model='file' class="form-control @error('file') is-invalid @enderror" type="file" accept=".xlsx" />
            @error('file') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>
          <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary me-sm-3 me-1">{{ __('Submit') }}</button>
            <button type="reset" class="btn btn-label-secondary btn-reset" data-bs-dismiss="modal" aria-label="Close">{{ __('Cancel') }}</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
