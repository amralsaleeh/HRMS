<div class="p-4">
  <div class="d-flex align-items-center gap-3 mb-4">
    <div class="badge rounded-pill bg-label-primary p-3">
      <i class="ti ti-discount ti-lg"></i>
    </div>
    <div>
      <h5 class="mb-1">{{ __('help.common.discounts') }}</h5>
      <p class="text-muted small mb-0">{{ __('help.discounts.intro') }}</p>
    </div>
  </div>

  <div class="card border shadow-none mb-4">
    <div class="card-header d-flex align-items-center gap-2 py-3">
      <span class="badge rounded-pill bg-label-info p-2"><i class="ti ti-steps ti-sm"></i></span>
      <h6 class="mb-0">{{ __('help.discounts.four_step_wizard') }}</h6>
      <span class="badge bg-label-secondary ms-auto">{{ __('help.common.admin_hr') }}</span>
    </div>
    <div class="card-body pt-2">
      <p class="text-body mb-2">{{ __('help.discounts.steps_order') }}</p>
      <ul class="list-unstyled mb-0">
        <li class="d-flex align-items-start gap-2 mb-2">
          <i class="ti ti-calendar-event text-primary mt-1 flex-shrink-0"></i>
          <span><strong>{{ __('help.discounts.step_1_holidays') }}</strong> – {{ __('help.discounts.step_1_desc') }}</span>
        </li>
        <li class="d-flex align-items-start gap-2 mb-2">
          <i class="ti ti-fingerprint text-primary mt-1 flex-shrink-0"></i>
          <span><strong>{{ __('help.discounts.step_2_fingerprints') }}</strong> – {{ __('help.discounts.step_2_desc') }}</span>
        </li>
        <li class="d-flex align-items-start gap-2 mb-2">
          <i class="ti ti-zzz text-primary mt-1 flex-shrink-0"></i>
          <span><strong>{{ __('help.discounts.step_3_leaves') }}</strong> – {{ __('help.discounts.step_3_desc') }}</span>
        </li>
        <li class="d-flex align-items-start gap-2 mb-0">
          <i class="ti ti-send text-primary mt-1 flex-shrink-0"></i>
          <span><strong>{{ __('help.discounts.step_4_submit') }}</strong> – {{ __('help.discounts.step_4_desc') }}</span>
        </li>
      </ul>
      <p class="text-muted small mt-2 mb-0">{{ __('help.discounts.prev_next') }}</p>
    </div>
  </div>

  <div class="card border shadow-none mb-4">
    <div class="card-header d-flex align-items-center gap-2 py-3">
      <span class="badge rounded-pill bg-label-warning p-2"><i class="ti ti-player-play ti-sm"></i></span>
      <h6 class="mb-0">{{ __('help.discounts.what_happens') }}</h6>
    </div>
    <div class="card-body pt-2">
      <p class="text-body mb-2">{{ __('help.discounts.submitting_workflow') }}</p>
      <ul class="list-unstyled mb-0">
        <li class="d-flex align-items-start gap-2 mb-1"><i class="ti ti-database ti-xs text-muted mt-1 flex-shrink-0"></i><span>{{ __('help.discounts.db_backup') }}</span></li>
        <li class="d-flex align-items-start gap-2 mb-1"><i class="ti ti-lock ti-xs text-muted mt-1 flex-shrink-0"></i><span>{{ __('help.discounts.maintenance_on') }}</span></li>
        <li class="d-flex align-items-start gap-2 mb-1"><i class="ti ti-file-calculator ti-xs text-muted mt-1 flex-shrink-0"></i><span>{{ __('help.discounts.background_job') }}</span></li>
        <li class="d-flex align-items-start gap-2 mb-0"><i class="ti ti-progress ti-xs text-muted mt-1 flex-shrink-0"></i><span>{{ __('help.discounts.progress_done') }}</span></li>
      </ul>
    </div>
  </div>

  <div class="card border shadow-none mb-0">
    <div class="card-header d-flex align-items-center gap-2 py-3">
      <span class="badge rounded-pill bg-label-success p-2"><i class="ti ti-file-export ti-sm"></i></span>
      <h6 class="mb-0">{{ __('help.common.export') }}</h6>
    </div>
    <div class="card-body pt-2">
      <p class="text-body mb-0">{{ __('help.discounts.after_calc') }}</p>
    </div>
  </div>
</div>
