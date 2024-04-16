@push('custom-css')

@endpush

<div wire:ignore.self class="modal fade" id="add-timeline" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-simple">
    <div class="modal-content p-3 p-md-5">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-4">
          <h3 class="mb-2"></h3>

          <p class="text-muted">Please fill out the following information</p>
        </div>
        <form wire:submit="submitTimeline" class="row g-3">
          <div class="col-md-12 col-12 mb-4">
            <label class="form-label">Posation</label>
            {{-- <input wire:model='posation' class="form-select" @error('posation') is-invalid @enderror type="text"/> --}}
            <select wire:model.defer="employeePosition" id="employeePosition" class="form-select">
              @foreach ($positions as $position)
                <option value="{{ $position->id }}">  {{ $position->name }}</option>
              @endforeach
          </select>
          </div>
          <div class="col-md-6 col-12 mb-4">
            <label class="form-label">Department</label>
            <select wire:model.defer="employeeDepartment" id="employeeDepartment" class="form-select">
              @foreach ($departments as $department)
              <option value="{{ $department->id }}">  {{ $department->name }}</option>
            @endforeach
          </select>
          </div>

          <div class="col-md-6 col-12 mb-4">
            <label class="form-label">Center</label>
            <select wire:model="employeeCenter" id="employeeCenter" class="form-select">
              @foreach ($Centers as $Center)
                <option value="{{ $Center->id }}">  {{ $Center->name }}</option>
              @endforeach

          </select>
          </div>


    <div class="col-md-6">
        <label class="form-label w-100" for="startDate">Start date</label>
        <input wire:model.defer="startDate" type="date" class="form-control @error('startDate') is-invalid @enderror" id="startDate" placeholder="YYYY-MM-DD">
        @error('startDate')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class=" col-md-6">
        <label class="form-label w-100" for="quitDate">Quit date</label>
        <input wire:model.defer="quitDate" type="date" class="form-control @error('quitDate') is-invalid @enderror" id="quitDate" placeholder="YYYY-MM-DD">
        @error('quitDate')
        <div class="invalid-feedback">
            {{ $message }}
        </div>

        @enderror



  </div>
  <div class="col-md-12 col-12 mb-4">
    <label class="form-label w-100">Note</label>
    <input wire:model='notes' class="form-control @error('note') is-invalid @enderror" type="text" />
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
