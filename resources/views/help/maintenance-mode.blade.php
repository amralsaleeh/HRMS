<div class="p-4">
  <div class="d-flex align-items-center gap-3 mb-4">
    <div class="badge rounded-pill bg-label-primary p-3">
      <i class="ti ti-tooltip ti-lg"></i>
    </div>
    <div>
      <h5 class="mb-1">{{ __('help.maintenance_mode.title') }}</h5>
      <p class="text-muted small mb-0">{{ __('help.maintenance_mode.intro') }}</p>
    </div>
  </div>

  <div class="card border shadow-none mb-4">
    <div class="card-header d-flex align-items-center gap-2 py-3">
      <span class="badge rounded-pill bg-label-info p-2"><i class="ti ti-info-circle ti-sm"></i></span>
      <h6 class="mb-0">{{ __('help.maintenance_mode.what_you_see') }}</h6>
    </div>
    <div class="card-body pt-2">
      <p class="text-body mb-2">{{ __('help.maintenance_mode.when_maintenance') }}</p>
      <ul class="list-unstyled mb-0">
        <li class="d-flex align-items-start gap-2 mb-1">
          <i class="ti ti-alert-triangle text-warning mt-1 flex-shrink-0"></i>
          <span>{{ __('help.maintenance_mode.under_maintenance_msg') }}</span>
        </li>
        <li class="d-flex align-items-start gap-2 mb-1">
          <i class="ti ti-clock text-muted mt-1 flex-shrink-0"></i>
          <span>{{ __('help.maintenance_mode.countdown_timer') }}</span>
        </li>
        <li class="d-flex align-items-start gap-2 mb-0">
          <i class="ti ti-mail text-muted mt-1 flex-shrink-0"></i>
          <span>{{ __('help.maintenance_mode.contact_it_note') }}</span>
        </li>
      </ul>
    </div>
  </div>

  <div class="card border shadow-none mb-0">
    <div class="card-header d-flex align-items-center gap-2 py-3">
      <span class="badge rounded-pill bg-label-success p-2"><i class="ti ti-toggle-right ti-sm"></i></span>
      <h6 class="mb-0">{{ __('help.maintenance_mode.who_toggle') }}</h6>
      <span class="badge bg-label-secondary ms-auto">{{ __('help.common.admin_hr') }}</span>
    </div>
    <div class="card-body pt-2">
      <p class="text-body mb-0">{{ __('help.maintenance_mode.only_admin_hr_toggle') }}</p>
    </div>
  </div>
</div>
