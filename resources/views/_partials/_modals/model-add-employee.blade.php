@push('custom-css')

@endpush

<div wire:ignore.self class="modal fade" id="employeeModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-simple">
    <div class="modal-content p-3 p-md-5">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-4">
          <h3 class="mb-2"></h3>
          <h3 class="mb-2">{{ $isEdit ? __('Update Employee') : __('New Employee') }}</h3>
          <p class="text-muted">{{ __('Please fill out the following information') }}</p>
        </div>
        <form wire:submit="submitEmployee" class="row g-3">
          <div class="col-md-6 col-12 mb-4">
            <label class="form-label">{{ __('ID') }}</label>
            <input wire:model='id' class="form-control @error('id') is-invalid @enderror" type="Number"/>
          </div>
          <div class="col-md-6 col-12 mb-4">
            <label class="form-label w-100">{{ __('Contract ID') }}</label>
            <input wire:model='contract_id' class="form-control @error('contract_id ') is-invalid @enderror" type="Number" />
          </div>
          <div class="col-md-4 col-12 mb-4">
            <label class="form-label w-100">{{ __('First Name') }}</label>
            <input wire:model='first_name' class="form-control @error('first name') is-invalid @enderror" type="text" />
          </div>
          <div class="col-md-4 col-12 mb-4">
            <label class="form-label w-100">{{ __('Father Name') }}</label>
            <input wire:model='father_name' class="form-control @error('father name') is-invalid @enderror" type="text" />
          </div>
          <div class="col-md-4 col-12 mb-4">
            <label class="form-label w-100">{{ __('Last Name') }}</label>
            <input wire:model='last_name' class="form-control @error('last name') is-invalid @enderror" type="text" />
          </div>
          <div class="col-md-4 col-12 mb-4">
            <label class="form-label w-100">{{ __('Mother Name') }}</label>
            <input wire:model='mother_name' class="form-control @error('mother name') is-invalid @enderror" type="text" />
          </div>
          <div class="col-md-3">
            <label class="form-label w-100" for="nationalNumber">{{ __('National Number') }}</label>
            <input wire:model.defer="national_number" type="text" class="form-control @error('nationalNumber') is-invalid @enderror" id="nationalNumber" placeholder="02000000000">
            @error('nationalNumber')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
          </div>
          <div class="col-md-3">
            <label class="form-label w-100" for="mobile">{{ __('Mobile') }}</label>
            <input wire:model.defer="mobile_number" type="text" class="form-control @error('mobile') is-invalid @enderror" id="mobile" placeholder="0900000000">
            @error('mobile')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
          </div>
          <div class="col-md-3">
            <label class="form-label w-100" for="birthAndPlace">{{ __('Birth & Place') }}</label>
            <input wire:model.defer="birth_and_place" type="text" class="form-control @error('birthAndPlace') is-invalid @enderror" id="birthAndPlace" placeholder="YYYY-Place">
            @error('birthAndPlace')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
            @enderror
          </div>
          <div class="col-md-3">
            <label class="form-label w-100" for="gender" class="form-label">{{ __('Gender') }}</label>
            <select  wire:model.defer="gender" @error('gender') is-invalid @enderror id="gender" class="form-select">
              <option>{{ __('Select Gender') }}</option>
              <option value="1">{{ __('Male') }}</option>
              <option value="0">{{ __('Female') }}</option>
            </select>
            @error('gender')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
            @enderror
          </div>
          <div class="col-md-3">
            <label class="form-label w-100" for="Degree">{{ __('Degree') }}</label>
            <input wire:model.defer="degree" type="text" class="form-control @error('degree') is-invalid @enderror" id="degree" placeholder="Degree">
            @error('degree')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
            @enderror
          </div>
          <div class="col-md-3">
            <label class="form-label w-100" for="startDate">{{ __('Start date') }}</label>
            <input wire:model.defer="perInfo.startDate" type="date" class="form-control @error('startDate') is-invalid @enderror" id="startDate" placeholder="YYYY-MM-DD">
            @error('startDate')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
            @enderror
          </div>
          <div class=" col-md-3">
            <label class="form-label w-100" for="quitDate">{{ __('Quit date') }}</label>
            <input wire:model.defer="perInfo.quitDate" type="date" class="form-control @error('quitDate') is-invalid @enderror" id="quitDate" placeholder="YYYY-MM-DD">
            @error('quitDate')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
            @enderror
          </div>
          <div class="col-3">
            <label class="form-label w-100" for="address">{{ __('Address') }}</label>
            <input wire:model.defer="address" type="text" class="form-control @error('address') is-invalid @enderror" id="address" placeholder="Martini">
            @error('address')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>
          <div class="col-md-3">
            <label class="form-label w-100" for="defaultSelect" class="form-label">{{ __('Is Active') }}</label>
            <select wire:model.defer="is_active" id="is_active" class="form-select">
              {{-- select  wire:model.defer="is_active" class="custom-select rounded-0 @error('is_active') is-invalid @enderror" id="gender" id="is_active" class="form-select" --}}
              <option>{{ __('Is Active?') }}</option>
              <option value="1">{{ __('Active') }}</option>
              <option value="0">{{ __('Inactive') }}</option>
            </select>
            @error('Active')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
            @enderror
          </div>
          <div class="col-3 mb-4">
            <label class="form-label w-100">{{ __('Max Leave Allowed') }}</label>
            <input wire:model='max_leave_allowed' class="form-control @error('Max Leave Allowed') is-invalid @enderror" type="Number"/>
          </div>
          <div class="col-md-12 col-10 mb-4">
            <label class="form-label w-100">{{ __('Note') }}</label>
            <input wire:model='notes' class="form-control @error('note') is-invalid @enderror" type="text" />
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
