<div class="p-4">
  {{-- Page header --}}
  <div class="d-flex align-items-center gap-3 mb-4">
    <div class="badge rounded-pill bg-label-primary p-3">
      <i class="ti ti-layout-dashboard ti-lg"></i>
    </div>
    <div>
      <h5 class="mb-1">{{ __('help.common.dashboard') }}</h5>
      <p class="text-muted small mb-0">{{ __('help.dashboard.intro') }}</p>
    </div>
  </div>

  {{-- Reminder alert --}}
  <div class="alert alert-warning border d-flex align-items-start gap-2 mb-4" role="alert">
    <i class="ti ti-alert-triangle flex-shrink-0 mt-1"></i>
    <div>
      <strong>{{ __('help.common.reminder') }}</strong>: {{ __('help.dashboard.reminder_text') }}
    </div>
  </div>

  {{-- 1. Welcome card --}}
  <div class="card border shadow-none mb-4">
    <div class="card-header d-flex align-items-center gap-2 py-3">
      <span class="badge rounded-pill bg-label-info p-2"><i class="ti ti-user-circle ti-sm"></i></span>
      <h6 class="mb-0">{{ __('help.dashboard.welcome_card') }}</h6>
    </div>
    <div class="card-body pt-2">
      <p class="text-body mb-3">{{ __('help.dashboard.left_card_shows') }}</p>
      <ul class="list-unstyled mb-0">
        <li class="d-flex align-items-start gap-2 mb-2">
          <i class="ti ti-mood-smile text-primary mt-1 flex-shrink-0"></i>
          <span><strong>{{ __('help.dashboard.greeting') }}</strong> – {{ __('help.dashboard.greeting_desc') }}</span>
        </li>
        <li class="d-flex align-items-start gap-2 mb-2">
          <i class="ti ti-clock text-primary mt-1 flex-shrink-0"></i>
          <span><strong>{{ __('help.dashboard.date_and_time') }}</strong> – {{ __('help.dashboard.date_time_desc') }}</span>
        </li>
        <li class="d-flex align-items-start gap-2 mb-0">
          <i class="ti ti-plus text-primary mt-1 flex-shrink-0"></i>
          <span><strong>{{ __('help.common.add_new') }}</strong> – {{ __('help.dashboard.dropdown_opens_menu') }} <strong>{{ __('help.common.employee') }}</strong> ({{ __('help.common.structure') }} → {{ __('help.common.employees') }}), <strong>{{ __('help.common.fingerprint') }}</strong> ({{ __('help.common.attendance') }} → {{ __('help.common.fingerprints') }}), {{ __('help.common.or') }} <strong>{{ __('help.common.leave') }}</strong> ({{ __('help.common.opens_leave_form_modal') }}).</span>
        </li>
      </ul>
    </div>
  </div>

  {{-- 2. Statistics card --}}
  <div class="card border shadow-none mb-4">
    <div class="card-header d-flex align-items-center gap-2 py-3">
      <span class="badge rounded-pill bg-label-success p-2"><i class="ti ti-chart-bar ti-sm"></i></span>
      <h6 class="mb-0">{{ __('help.dashboard.statistics_card') }}</h6>
    </div>
    <div class="card-body pt-2">
      <p class="text-body mb-3">{{ __('help.dashboard.right_card_shows') }}</p>
      <div class="row g-2 mb-3">
        <div class="col-12 col-md-6">
          <div class="d-flex align-items-center gap-2 p-2 rounded border border-1 border-start border-primary border-3">
            <i class="ti ti-activity ti-sm text-primary"></i>
            <span><strong>{{ __('help.common.api_status') }}</strong></span>
            <span class="badge bg-label-secondary ms-auto">{{ __('help.common.read_sms') }}</span>
          </div>
        </div>
        <div class="col-12 col-md-6">
          <div class="d-flex align-items-center gap-2 p-2 rounded border border-1 border-start border-primary border-3">
            <i class="ti ti-calculator ti-sm text-primary"></i>
            <span><strong>{{ __('help.common.api_balance') }}</strong></span>
            <span class="badge bg-label-secondary ms-auto">{{ __('help.common.read_sms') }}</span>
          </div>
        </div>
        <div class="col-12 col-md-6">
          <div class="d-flex align-items-center gap-2 p-2 rounded border border-1 border-start border-success border-3">
            <i class="ti ti-speakerphone ti-sm text-success"></i>
            <span><strong>{{ __('help.common.successful_sms') }}</strong></span>
            <span class="badge bg-label-secondary ms-auto">{{ __('help.common.read_sms') }}</span>
          </div>
        </div>
        <div class="col-12 col-md-6">
          <div class="d-flex align-items-center gap-2 p-2 rounded border border-1 border-start border-danger border-3">
            <i class="ti ti-send ti-sm text-danger"></i>
            <span><strong>{{ __('help.common.pending_sms') }}</strong></span>
            <span class="badge bg-label-secondary ms-auto">{{ __('help.common.read_sms') }}</span>
          </div>
          <small class="text-muted d-block mt-1 ms-4">{{ __('help.dashboard.click_red_badge') }}</small>
        </div>
        <div class="col-12 col-md-6">
          <div class="d-flex align-items-center gap-2 p-2 rounded border border-1 border-start border-primary border-3">
            <i class="ti ti-users ti-sm text-primary"></i>
            <span><strong>{{ __('help.common.active_employees') }}</strong></span>
            <span class="badge bg-label-info ms-auto">{{ __('help.common.admin_hr_cc_cr') }}</span>
          </div>
        </div>
        <div class="col-12 col-md-6">
          <div class="d-flex align-items-center gap-2 p-2 rounded border border-1 border-start border-warning border-3">
            <i class="ti ti-zzz ti-sm text-warning"></i>
            <span><strong>{{ __('help.common.leaves_balance') }}</strong></span>
            <span class="badge bg-label-info ms-auto">{{ __('help.common.employee') }}</span>
          </div>
        </div>
        <div class="col-12 col-md-6">
          <div class="d-flex align-items-center gap-2 p-2 rounded border border-1 border-start border-warning border-3">
            <i class="ti ti-alarm ti-sm text-warning"></i>
            <span><strong>{{ __('help.common.hourly_counter') }}</strong></span>
            <span class="badge bg-label-info ms-auto">{{ __('help.common.employee') }}</span>
          </div>
        </div>
        <div class="col-12 col-md-6">
          <div class="d-flex align-items-center gap-2 p-2 rounded border border-1 border-start border-warning border-3">
            <i class="ti ti-hourglass ti-sm text-warning"></i>
            <span><strong>{{ __('help.common.delay_counter') }}</strong></span>
            <span class="badge bg-label-info ms-auto">{{ __('help.common.employee') }}</span>
          </div>
        </div>
      </div>
      <p class="text-muted small mb-0"><i class="ti ti-info-circle me-1"></i>{{ __('help.dashboard.stats_employees_note') }}</p>
    </div>
  </div>

  {{-- 3. Recently Leaves table --}}
  <div class="card border shadow-none mb-4">
    <div class="card-header d-flex align-items-center gap-2 py-3">
      <span class="badge rounded-pill bg-label-warning p-2"><i class="ti ti-table ti-sm"></i></span>
      <h6 class="mb-0">{{ __('help.dashboard.recently_leaves_table') }}</h6>
    </div>
    <div class="card-body pt-2">
      <p class="text-body mb-3">{{ __('help.dashboard.table_lists_recent') }}</p>
      <div class="d-flex flex-wrap gap-2 mb-3">
        <span class="badge bg-label-info">{{ __('help.dashboard.employees_viewers') }}: {{ __('help.dashboard.own_leaves_7_days') }}</span>
        <span class="badge bg-label-primary">{{ __('help.common.admin_hr_cc_cr') }}: {{ __('help.dashboard.leaves_created_today') }}</span>
      </div>
      <p class="text-body mb-2">{{ __('help.common.columns') }} {{ __('help.common.id') }}, {{ __('help.common.employee') }} ({{ __('help.dashboard.if_not_employee_viewer') }}), {{ __('help.common.type') }}, {{ __('help.common.details') }} ({{ __('help.dashboard.date_range_optional_time') }}), {{ __('help.common.actions') }} ({{ __('help.dashboard.if_not_employee_viewer') }}).</p>
      <ul class="list-unstyled mb-0">
        <li class="d-flex align-items-start gap-2 mb-2">
          <i class="ti ti-pencil text-info mt-1 flex-shrink-0"></i>
          <span><strong>{{ __('help.common.edit') }}</strong> – {{ __('help.dashboard.pencil_opens_leave_form') }}</span>
        </li>
        <li class="d-flex align-items-start gap-2 mb-2">
          <i class="ti ti-trash text-danger mt-1 flex-shrink-0"></i>
          <span><strong>{{ __('help.common.delete') }}</strong> – {{ __('help.dashboard.trash_confirm') }}</span>
        </li>
        <li class="d-flex align-items-start gap-2 mb-0">
          <i class="ti ti-message-circle-plus text-muted mt-1 flex-shrink-0"></i>
          <span>{{ __('help.dashboard.no_leaves_state') }}</span>
        </li>
      </ul>
    </div>
  </div>

  {{-- 4. Leave form (modal) --}}
  <div class="card border shadow-none mb-4">
    <div class="card-header d-flex align-items-center gap-2 py-3">
      <span class="badge rounded-pill bg-label-secondary p-2"><i class="ti ti-forms ti-sm"></i></span>
      <h6 class="mb-0">{{ __('help.dashboard.leave_form_modal') }}</h6>
    </div>
    <div class="card-body pt-2">
      <p class="text-body mb-3">{{ __('help.dashboard.open_form_from') }}</p>
      <p class="text-body mb-2"><strong>{{ __('help.common.fields') }}:</strong></p>
      <ul class="list-unstyled mb-3">
        <li class="d-flex align-items-start gap-2 mb-1"><i class="ti ti-user ti-xs text-muted mt-1 flex-shrink-0"></i><span><strong>{{ __('help.common.employee') }}</strong> – {{ __('help.dashboard.select_employee_disabled') }}</span></li>
        <li class="d-flex align-items-start gap-2 mb-1"><i class="ti ti-tag ti-xs text-muted mt-1 flex-shrink-0"></i><span><strong>{{ __('help.common.type') }}</strong> – {{ __('help.dashboard.leave_type_eg') }}</span></li>
        <li class="d-flex align-items-start gap-2 mb-1"><i class="ti ti-calendar ti-xs text-muted mt-1 flex-shrink-0"></i><span><strong>{{ __('help.common.from_date') }}</strong> / <strong>{{ __('help.common.to_date') }}</strong> – {{ __('help.dashboard.date_range_30_days') }}</span></li>
        <li class="d-flex align-items-start gap-2 mb-1"><i class="ti ti-clock ti-xs text-muted mt-1 flex-shrink-0"></i><span><strong>{{ __('help.common.start_at') }}</strong> / <strong>{{ __('help.common.end_at') }}</strong> – {{ __('help.dashboard.time_range_hourly') }}</span></li>
        <li class="d-flex align-items-start gap-2 mb-1"><i class="ti ti-notes ti-xs text-muted mt-1 flex-shrink-0"></i><span><strong>{{ __('help.common.note') }}</strong> – {{ __('help.dashboard.optional_text') }}</span></li>
      </ul>
      <p class="text-body mb-2"><strong>{{ __('help.common.rules') }}:</strong></p>
      <ul class="list-unstyled mb-0">
        <li class="d-flex align-items-start gap-2 mb-1"><i class="ti ti-circle-check text-success ti-xs mt-1 flex-shrink-0"></i><span>{{ __('help.dashboard.daily_leave_no_time') }}</span></li>
        <li class="d-flex align-items-start gap-2 mb-1"><i class="ti ti-circle-check text-success ti-xs mt-1 flex-shrink-0"></i><span>{{ __('help.dashboard.hourly_leave_both_times') }}</span></li>
        <li class="d-flex align-items-start gap-2 mb-1"><i class="ti ti-circle-check text-success ti-xs mt-1 flex-shrink-0"></i><span>{{ __('help.dashboard.from_to_date_rules') }}</span></li>
        <li class="d-flex align-items-start gap-2 mb-0"><i class="ti ti-circle-check text-success ti-xs mt-1 flex-shrink-0"></i><span>{{ __('help.dashboard.submit_cancel_modal') }}</span></li>
      </ul>
    </div>
  </div>

  {{-- 5. Changelog card --}}
  <div class="card border shadow-none mb-0">
    <div class="card-header d-flex align-items-center gap-2 py-3">
      <span class="badge rounded-pill bg-label-dark p-2"><i class="ti ti-news ti-sm"></i></span>
      <h6 class="mb-0">{{ __('help.dashboard.changelog_card') }}</h6>
      <span class="badge bg-label-secondary ms-auto">{{ __('help.common.admin_hr_cc_cr_only') }}</span>
    </div>
    <div class="card-body pt-2">
      <p class="text-body mb-0">{{ __('help.dashboard.changelog_desc') }}</p>
    </div>
  </div>
</div>
