<div class="p-4">
  <div class="d-flex align-items-center gap-3 mb-4">
    <div class="badge rounded-pill bg-label-primary p-3">
      <i class="ti ti-device-laptop ti-lg"></i>
    </div>
    <div>
      <h5 class="mb-1">{{ __('help.inventory.title') }}</h5>
      <p class="text-muted small mb-0">{{ __('help.inventory.intro') }}</p>
    </div>
  </div>

  <div class="card border shadow-none mb-4">
    <div class="card-header d-flex align-items-center gap-2 py-3">
      <span class="badge rounded-pill bg-label-info p-2"><i class="ti ti-search ti-sm"></i></span>
      <h6 class="mb-0">{{ __('help.common.search') }}</h6>
      <span class="badge bg-label-secondary ms-auto">{{ __('help.common.admin') }}/{{ __('help.common.am') }}</span>
    </div>
    <div class="card-body pt-2">
      <p class="text-body mb-0">{{ __('help.inventory.search_desc') }}</p>
    </div>
  </div>

  <div class="card border shadow-none mb-4">
    <div class="card-header d-flex align-items-center gap-2 py-3">
      <span class="badge rounded-pill bg-label-success p-2"><i class="ti ti-table ti-sm"></i></span>
      <h6 class="mb-0">{{ __('help.inventory.assets_table') }}</h6>
    </div>
    <div class="card-body pt-2">
      <p class="text-body mb-2">{{ __('help.common.columns') }} {{ __('help.common.id') }}, {{ __('help.common.old_id') }}, {{ __('help.common.serial_number') }}, {{ __('help.common.description') }}, {{ __('help.common.status') }}, {{ __('help.common.actions') }}. {{ __('help.common.status') }} {{ __('help.inventory.status_badge') }}</p>
      <ul class="list-unstyled mb-0">
        <li class="d-flex align-items-start gap-2 mb-2">
          <i class="ti ti-arrow-guide text-primary mt-1 flex-shrink-0"></i>
          <span>{{ __('help.inventory.click_id_details') }}</span>
        </li>
        <li class="d-flex align-items-start gap-2 mb-2">
          <i class="ti ti-pencil text-info mt-1 flex-shrink-0"></i>
          <span><strong>{{ __('help.common.edit') }}</strong> – {{ __('help.inventory.edit_asset_modal') }}</span>
        </li>
        <li class="d-flex align-items-start gap-2 mb-0">
          <i class="ti ti-trash text-danger mt-1 flex-shrink-0"></i>
          <span><strong>{{ __('help.common.delete') }}</strong> – {{ __('help.inventory.delete_confirm') }}</span>
        </li>
      </ul>
      <p class="text-muted small mt-2 mb-0">{{ __('help.inventory.pagination_empty_asset') }}</p>
    </div>
  </div>

  <div class="card border shadow-none mb-0">
    <div class="card-header d-flex align-items-center gap-2 py-3">
      <span class="badge rounded-pill bg-label-warning p-2"><i class="ti ti-forms ti-sm"></i></span>
      <h6 class="mb-0">{{ __('help.inventory.asset_form_modal') }}</h6>
    </div>
    <div class="card-body pt-2">
      <p class="text-body mb-0">{{ __('help.inventory.add_asset_modal') }}</p>
    </div>
  </div>
</div>
