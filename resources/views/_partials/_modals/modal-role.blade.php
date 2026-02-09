<div wire:ignore.self class="modal fade" id="roleModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-simple">
    <div class="modal-content p-0 p-md-5">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-4">
          <h3 class="mb-2">{{ $isEdit ? __('Update Role') : __('New Role') }}</h3>
          <p class="text-muted">{{ __('Please fill out the following information') }}</p>
        </div>
        <form wire:submit="submitRole" class="row g-3">
          <div class="col-12">
            <label class="form-label w-100">{{ __('Name') }}</label>
            <input wire:model='name' class="form-control @error('name') is-invalid @enderror" type="text" placeholder="{{ __('e.g. Admin') }}" />
          </div>
          <div class="col-12">
            <label class="form-label w-100">{{ __('Permissions') }}</label>
            <div class="border rounded p-3" style="max-height: 12rem; overflow-y: auto">
              @forelse($permissions as $permission)
                <div class="form-check">
                  <input wire:model="selectedPermissions" class="form-check-input" type="checkbox" value="{{ $permission->name }}" id="perm-{{ $permission->id }}">
                  <label class="form-check-label" for="perm-{{ $permission->id }}">{{ $permission->name }}</label>
                </div>
              @empty
                <p class="text-muted small mb-0">{{ __('No permissions yet.') }}</p>
              @endforelse
            </div>
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
