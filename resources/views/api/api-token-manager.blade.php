<div>
  <!-- Generate API Token -->
  <x-form-section submit="createApiToken">
    <x-slot name="title">
      {{ __('Create API Token') }}
    </x-slot>

    <x-slot name="description">
      {{ __('API tokens allow third-party services to authenticate with our application on your behalf.') }}
    </x-slot>

    <x-slot name="form">
      <x-action-message on="created">
        {{ __('Created.') }}
      </x-action-message>

      <!-- Token Name -->
      <div class="mb-3">
        <x-label for="name" class="form-label" value="{{ __('Token Name') }}" />
        <x-input id="name" type="text" class="{{ $errors->has('name') ? 'is-invalid' : '' }}"
          wire:model="createApiTokenForm.name" autofocus />
        <x-input-error for="name" />
      </div>

      <!-- Token Permissions -->
      @if (Laravel\Jetstream\Jetstream::hasPermissions())
        <div>
          <x-label class="form-label" for="permissions" value="{{ __('Permissions') }}" />

          <div class="mt-2 row">
            @foreach (Laravel\Jetstream\Jetstream::$permissions as $permission)
              <div class="col-6">
                <div class="mb-3">
                  <div class="form-check">
                    <x-checkbox wire:model="createApiTokenForm.permissions"
                      id="{{ 'create-' . $permission }}" :value="$permission" />
                    <label class="form-check-label" for="{{ 'create-' . $permission }}">
                      {{ $permission }}
                    </label>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      @endif
    </x-slot>

    <x-slot name="actions">
      <x-button>
        {{ __('Create') }}
      </x-button>
    </x-slot>
  </x-form-section>

  @if ($this->user->tokens->isNotEmpty())

    <!-- Manage API Tokens -->
    <div class="mt-4">
      <x-action-section>
        <x-slot name="title">
          {{ __('Manage API Tokens') }}
        </x-slot>

        <x-slot name="description">
          {{ __('You may delete any of your existing tokens if they are no longer needed.') }}
        </x-slot>

        <!-- API Token List -->
        <x-slot name="content">
          <div>
            @foreach ($this->user->tokens->sortBy('name') as $token)
              <div class="d-flex justify-content-between">
                <div class="fw-medium">
                  {{ $token->name }}
                </div>

                <div class="d-flex">
                  @if ($token->last_used_at)
                    <div class="text-muted">
                      {{ __('Last used') }} {{ $token->last_used_at->diffForHumans() }}
                    </div>
                  @endif

                  @if (Laravel\Jetstream\Jetstream::hasPermissions())
                    <button class="btn btn-link text-secondary"
                      wire:click="manageApiTokenPermissions({{ $token->id }})">
                      {{ __('Permissions') }}
                    </button>
                  @endif

                  <button class="btn btn-link text-danger text-decoration-none"
                    wire:click="confirmApiTokenDeletion({{ $token->id }})">
                    {{ __('Delete') }}
                  </button>
                </div>
              </div>
            @endforeach
          </div>
        </x-slot>
      </x-action-section>
    </div>
  @endif

  <!-- Token Value Modal -->
  <x-dialog-modal wire:model.live="displayingToken">
    <x-slot name="title">
      {{ __('API Token') }}
    </x-slot>

    <x-slot name="content">
      <div>
        {{ __('Please copy your new API token. For your security, it won\'t be shown again.') }}
      </div>

      <div class="mb-3">
        <x-input x-ref="plaintextToken" type="text" readonly :value="$plainTextToken" autofocus autocomplete="off"
          autocorrect="off" autocapitalize="off" spellcheck="false"
          @showing-token-modal.window="setTimeout(() => $refs.plaintextToken.select(), 250)" />
      </div>
    </x-slot>

    <x-slot name="footer">
      <x-secondary-button wire:click="$set('displayingToken', false)" wire:loading.attr="disabled">
        {{ __('Close') }}
      </x-secondary-button>
    </x-slot>
  </x-dialog-modal>

  <!-- API Token Permissions Modal -->
  <x-dialog-modal wire:model.live="managingApiTokenPermissions">
    <x-slot name="title">
      {{ __('API Token Permissions') }}
    </x-slot>

    <x-slot name="content">
      <div class="mt-2 row">
        @foreach (Laravel\Jetstream\Jetstream::$permissions as $permission)
          <div class="col-6">
            <div class="mb-3">
              <div class="form-check">
                <x-checkbox wire:model="updateApiTokenForm.permissions" id="{{ 'update-' . $permission }}"
                  :value="$permission" />
                <label class="form-check-label" for="{{ 'update-' . $permission }}">
                  {{ $permission }}
                </label>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </x-slot>

    <x-slot name="footer">
      <x-secondary-button wire:click="$set('managingApiTokenPermissions', false)" wire:loading.attr="disabled">
        {{ __('Cancel') }}
      </x-secondary-button>

      <x-button wire:click="updateApiToken" wire:loading.attr="disabled">
        {{ __('Save') }}
      </x-button>
    </x-slot>
  </x-dialog-modal>

  <!-- Delete Token Confirmation Modal -->
  <x-confirmation-modal wire:model.live="confirmingApiTokenDeletion">
    <x-slot name="title">
      {{ __('Delete API Token') }}
    </x-slot>

    <x-slot name="content">
      {{ __('Are you sure you would like to delete this API token?') }}
    </x-slot>

    <x-slot name="footer">
      <x-secondary-button wire:click="$toggle('confirmingApiTokenDeletion')" wire:loading.attr="disabled">
        {{ __('Cancel') }}
      </x-secondary-button>

      <x-danger-button wire:loading.attr="disabled" wire:click="deleteApiToken">
        {{ __('Delete') }}
      </x-danger-button>
    </x-slot>
  </x-confirmation-modal>
</div>
