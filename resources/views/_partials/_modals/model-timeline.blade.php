@push('custom-css')

@endpush

<div wire:ignore.self class="modal fade" id="timelineModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-simple">
    <div class="modal-content p-0 p-md-5">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-4">
          <h3 class="mb-2">New Timeline</h3>
          <p class="text-muted">Please fill out the following information</p>
        </div>
        <form wire:submit="storeTimeline" class="row g-3 mt-2">
          <div class="col-md-4 col-12">
            <label class="form-label">Center</label>
            <select wire:model.defer="employeeInfo.center" id="employeeInfo.center"
              class="form-select @error('employeeInfo.center') is-invalid @enderror">
              <option>Center:</option>
              @foreach ($centers as $Center)
              <option value="{{ $Center->id }}"> {{ $Center->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-4 col-12">
            <label class="form-label">Department</label>
            <select wire:model.defer="employeeInfo.department" id="employeeInfo.department"
              class="form-select @error('employeeInfo.department') is-invalid @enderror">
              <option>Department:</option>
              @foreach ($departments as $department)
              <option value="{{ $department->id }}"> {{ $department->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-4 col-12">
            <label class="form-label">Posation</label>
            <select wire:model.defer="employeeInfo.position" id="employeeInfo.position"
              class="form-select @error('employeeInfo.position') is-invalid @enderror">
              <option>Posation:</option>
              @foreach ($positions as $position)
              <option value="{{ $position->id }}"> {{ $position->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-4 col-12">
            <label class="form-label w-100" for="start_date">Start date</label>
            <input wire:model.defer="employeeInfo.start_date" type="date"
              class="form-control @error('employeeInfo.start_date') is-invalid @enderror" id="employeeInfo.start_date"
              placeholder="YYYY-MM-DD ">
          </div>
          <div class="col-md-4 col-12">
            <label class="form-label w-100" for="end_date">End date</label>
            <input wire:model.defer="employeeInfo.end_date" type="date"
              class="form-control @error('employeeInfo.end_date') is-invalid @enderror" id="end_date"
              placeholder="YYYY-MM-DD">
          </div>
          <div class="col-md-4 col-12">
            <label class="form-label">Sequential</label>
            <select wire:model.defer="employeeInfo.is_sequent" id="employeeInfo.is_sequent"
              class="form-select @error('employeeInfo.is_sequent') is-invalid @enderror">
              <option>Is Sequent?</option>
              <option value="1">Squential</option>
              <option value="0">Non-sequential</option>
            </select>
          </div>
          <div class="col-md-12 col-12 mb-4">
            <label class="form-label w-100">Note</label>
            <input wire:model='employeeInfo.notes' class="form-control @error('employeeInfo.note') is-invalid @enderror"
              type="text" />
          </div>

          <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
            <button type="reset" class="btn btn-label-secondary btn-reset" data-bs-dismiss="modal"
              aria-label="Close">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@push('custom-scripts')

@endpush