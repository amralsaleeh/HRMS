@push('custom-css')

@endpush

<div wire:ignore.self class="modal fade" id="employeeModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-simple">
    <div class="modal-content p-0 p-md-5">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-4">
          <h3 class="mb-2"></h3>
          <h3 class="mb-2">{{ $isEdit ? __('Update Employee') : __('New Employee') }}</h3>
          <p class="text-muted">{{ __('Please fill out the following information') }}</p>
        </div>
        <form wire:submit="submitEmployee" class="row g-3">
          <div class="col-md-3 col-12 mb-4">
            <label class="form-label">{{ __('ID') }}</label>
            <input wire:model='employeeInfo.id' class="form-control @error('employeeInfo.id') is-invalid @enderror" type="Number"/>
          </div>
          <div class="col-md-3 col-12 mb-4">
            <label class="form-label w-100">{{ __('Contract ID') }}</label>
            <input wire:model='employeeInfo.contract_id' class="form-control @error('employeeInfo.contract_id') is-invalid @enderror" type="Number" />
          </div>
          <div class="col-md-3 col-12 mb-4">
            <label class="form-label w-100" for="nationalNumber">{{ __('National Number') }}</label>
            <input wire:model.defer="employeeInfo.national_number" type="text" class="form-control @error('employeeInfo.national_number') is-invalid @enderror" id="employeeInfo.nationalNumber" placeholder="02000000000">
          </div>
          <div class="col-md-3 col-12 mb-4">
            <label class="form-label w-100" for="mobile">{{ __('Mobile') }}</label>
            <input wire:model.defer="employeeInfo.mobile_number" type="text" class="form-control @error('employeeInfo.mobile_number') is-invalid @enderror" id="employeeInfo.mobile" placeholder="0900000000">
          </div>
          <div class="col-md-2 col-12 mb-4">
            <label class="form-label w-100">{{ __('First Name') }}</label>
            <input wire:model='employeeInfo.first_name' class="form-control @error('employeeInfo.first_name') is-invalid @enderror" type="text" />
          </div>
          <div class="col-md-2 col-12 mb-4">
            <label class="form-label w-100">{{ __('Father Name') }}</label>
            <input wire:model='employeeInfo.father_name' class="form-control @error('employeeInfo.father_name') is-invalid @enderror" type="text" />
          </div>
          <div class="col-md-2 col-12 mb-4">
            <label class="form-label w-100">{{ __('Last Name') }}</label>
            <input wire:model='employeeInfo.last_name' class="form-control @error('employeeInfo.last_name') is-invalid @enderror" type="text" />
          </div>
          <div class="col-md-2 col-12 mb-4">
            <label class="form-label w-100">{{ __('Mother Name') }}</label>
            <input wire:model='employeeInfo.mother_name' class="form-control @error('employeeInfo.mother_name') is-invalid @enderror" type="text" />
          </div>
          <div class="col-md-4 col-12 mb-4">
            <label class="form-label w-100" for="birthAndPlace">{{ __('Birth & Place') }}</label>
            <input wire:model.defer="employeeInfo.birth_and_place" type="text" class="form-control @error('employeeInfo.birth_and_place') is-invalid @enderror" id="employeeInfo.birthAndPlace" placeholder="YYYY-Place">
          </div>
          <div class="col-md-2 col-12 mb-4">
            <label class="form-label w-100" for="employeeInfo.gender" class="form-label">{{ __('Gender') }}</label>
            <select  wire:model.defer="employeeInfo.gender" @error('employeeInfo.gender') is-invalid @enderror id="employeeInfo.gender" class="form-select">
              <option>{{ __('Select Gender') }}</option>
              <option value="1">{{ __('Male') }}</option>
              <option value="0">{{ __('Female') }}</option>
            </select>
          </div>
          <div class="col-md-4 col-12 mb-4">
            <label class="form-label w-100" for="employeeInfo.degree">{{ __('Degree') }}</label>
            <input wire:model.defer="employeeInfo.degree" type="text" class="form-control @error('employeeInfo.degree') is-invalid @enderror" id="employeeInfo.degree" placeholder="Degree">
          </div>
          <div class="col-md-6 col-12 mb-4">
            <label class="form-label w-100" for="address">{{ __('Address') }}</label>
            <input wire:model.defer="employeeInfo.address" type="text" class="form-control @error('employeeInfo.address') is-invalid @enderror" id="employeeInfo.address" placeholder="Martini">
          </div>

          <div class="col-12 mb-4">
            <label class="form-label w-100">{{ __('Note') }}</label>
            <input wire:model='employeeInfo.notes' class="form-control @error('employeeInfo.notes') is-invalid @enderror" type="text" />
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

@push('custom-scripts')

@endpush
