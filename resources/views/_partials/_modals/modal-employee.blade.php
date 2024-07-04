@push('custom-css')
  <style>
    input::-webkit-outer-spin-button,
      input::-webkit-inner-spin-button {
          -webkit-appearance: none;
          margin: 0;
      }

    input[type="number"] {
        -moz-appearance: textfield;
    }
  </style>
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
            <input wire:model='employeeInfo.id' @if($isEdit) disabled @endif class="form-control @error('employeeInfo.id') is-invalid @enderror" type="number"/>
          </div>
          <div class="col-md-3 col-12 mb-4">
            <label class="form-label w-100" for="employeeInfo.contractId" class="form-label">{{ __('Contract ID') }}</label>
            <select wire:model.defer="employeeInfo.contractId" class="form-select @error('employeeInfo.contractId') is-invalid @enderror" id="employeeInfo.contractId">
              <option value=""></option>
              @foreach($contracts as $contract)
              <option value="{{ $contract->id }}">{{ $contract->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-3 col-12 mb-4">
            <label class="form-label w-100" for="nationalNumber">{{ __('National Number') }}</label>
            <input wire:model.defer="employeeInfo.nationalNumber" class="form-control @error('employeeInfo.nationalNumber') is-invalid @enderror" id="employeeInfo.nationalNumber" placeholder="02000000000" type="text" maxlength="11">
            @error('employeeInfo.nationalNumber')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
          </div>
          <div class="col-md-3 col-12 mb-4">
            <label class="form-label w-100" for="mobile">{{ __('Mobile') }}</label>
            <input wire:model.defer="employeeInfo.mobileNumber" class="form-control @error('employeeInfo.mobileNumber') is-invalid @enderror" id="employeeInfo.mobile" placeholder="900000000" type="text" maxlength="9">
            @error('employeeInfo.mobileNumber')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
          </div>
          <div class="col-md-2 col-12 mb-4">
            <label class="form-label w-100">{{ __('First Name') }}</label>
            <input wire:model='employeeInfo.firstName' class="form-control @error('employeeInfo.firstName') is-invalid @enderror" type="text" />
          </div>
          <div class="col-md-2 col-12 mb-4">
            <label class="form-label w-100">{{ __('Father Name') }}</label>
            <input wire:model='employeeInfo.fatherName' class="form-control @error('employeeInfo.fatherName') is-invalid @enderror" type="text" />
          </div>
          <div class="col-md-2 col-12 mb-4">
            <label class="form-label w-100">{{ __('Last Name') }}</label>
            <input wire:model='employeeInfo.lastName' class="form-control @error('employeeInfo.lastName') is-invalid @enderror" type="text" />
          </div>
          <div class="col-md-2 col-12 mb-4">
            <label class="form-label w-100">{{ __('Mother Name') }}</label>
            <input wire:model='employeeInfo.motherName' class="form-control @error('employeeInfo.motherName') is-invalid @enderror" type="text" />
          </div>
          <div class="col-md-4 col-12 mb-4">
            <label class="form-label w-100" for="birthAndPlace">{{ __('Birth & Place') }}</label>
            <input wire:model.defer="employeeInfo.birthAndPlace" type="text" class="form-control @error('employeeInfo.birthAndPlace') is-invalid @enderror" id="employeeInfo.birthAndPlace">
          </div>
          <div class="col-md-2 col-12 mb-4">
            <label class="form-label w-100" for="employeeInfo.gender" class="form-label">{{ __('Gender') }}</label>
            <select  wire:model.defer="employeeInfo.gender" @error('employeeInfo.gender') is-invalid @enderror id="employeeInfo.gender" class="form-select">
              <option value=""></option>
              <option value="1">{{ __('Male') }}</option>
              <option value="0">{{ __('Female') }}</option>
            </select>
          </div>
          <div class="col-md-4 col-12 mb-4">
            <label class="form-label w-100" for="employeeInfo.degree">{{ __('Degree') }}</label>
            <input wire:model.defer="employeeInfo.degree" type="text" class="form-control @error('employeeInfo.degree') is-invalid @enderror" id="employeeInfo.degree">
          </div>
          <div class="col-md-6 col-12 mb-4">
            <label class="form-label w-100" for="address">{{ __('Address') }}</label>
            <input wire:model.defer="employeeInfo.address" type="text" class="form-control @error('employeeInfo.address') is-invalid @enderror" id="employeeInfo.address">
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
