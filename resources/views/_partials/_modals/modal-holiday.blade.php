@push('custom-css')

@endpush

<div wire:ignore.self class="modal fade" id="holidayModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-simple">
    <div class="modal-content p-3 p-md-5">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-4">
          <h3 class="mb-2"></h3>
          <h3 class="mb-2">{{ $isEdit ? 'Update Holiday' : 'New Holiday' }}</h3>
          <p class="text-muted">Please fill out the following information</p>
        </div>
        <form wire:submit="submitHoliday" class="row g-3">
          <div class="col-12 mb-4">
            <label class="form-label w-100">Name</label>
            <input wire:model='name' class="form-control @error('name') is-invalid @enderror" type="text" />
          </div>
            <div class="col-md-6 col-12 mb-4">
              <label class="form-label">From Date</label>
              <input wire:model='fromDate' type="date" class="form-control @error('fromDate') is-invalid @enderror" placeholder="YYYY/MM/DD" id="fromDate" autocomplete="off" />
            </div>
            <div class="col-md-6 col-12 mb-4">
              <label class="form-label">To Date</label>
              <input wire:model='toDate' type="date" class="form-control @error('toDate') is-invalid @enderror" placeholder="YYYY/MM/DD" id="toDate" autocomplete="off" />
            </div>

            <div class="col-12 mb-4">
              <label class="form-label w-100">Note</label>
              <input wire:model='note' class="form-control @error('note') is-invalid @enderror" type="text" />
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
