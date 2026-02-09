<div wire:ignore.self class="modal fade" id="userModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-simple">
    <div class="modal-content p-0 p-md-5">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-4">
          <h3 class="mb-2">{{ $isEdit ? __('Update User') : __('New User') }}</h3>
          <p class="text-muted">{{ __('Please fill out the following information') }}</p>
        </div>
        <form wire:submit="submitUser" class="row g-3">
          <div class="col-12">
            <label class="form-label w-100">{{ __('Name') }}</label>
            <input wire:model='name' class="form-control @error('name') is-invalid @enderror" type="text" />
          </div>
          <div class="col-12">
            <label class="form-label w-100">{{ __('Email') }}</label>
            <input wire:model='email' class="form-control @error('email') is-invalid @enderror" type="email" />
          </div>
          <div class="col-12">
            <label class="form-label w-100">{{ __('Username') }}</label>
            <input wire:model='username' class="form-control @error('username') is-invalid @enderror" type="text" />
          </div>
          <div class="col-12">
            <label class="form-label w-100">{{ __('Password') }}</label>
            <input wire:model='password' class="form-control @error('password') is-invalid @enderror" type="password"
              placeholder="{{ $isEdit ? __('Leave blank to keep current password') : '' }}" />
          </div>
          <div class="col-12">
            <label class="form-label w-100">{{ __('Role') }}</label>
            <select wire:model='role' class="form-select @error('role') is-invalid @enderror">
              <option value="">{{ __('No role') }}</option>
              @foreach ($roles as $roleName)
                <option value="{{ $roleName }}">{{ $roleName }}</option>
              @endforeach
            </select>
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
