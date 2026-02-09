<div class="p-4">
  <div class="d-flex align-items-center gap-3 mb-4">
    <div class="badge rounded-pill bg-label-primary p-3">
      <i class="ti ti-calendar-event ti-lg"></i>
    </div>
    <div>
      <h5 class="mb-1">{{ __('help.common.holidays') }}</h5>
      <p class="text-muted small mb-0">{{ __('help.holidays.intro') }}</p>
    </div>
  </div>

  <div class="card border shadow-none mb-4">
    <div class="card-header d-flex align-items-center gap-2 py-3">
      <span class="badge rounded-pill bg-label-info p-2"><i class="ti ti-table ti-sm"></i></span>
      <h6 class="mb-0">{{ __('help.holidays.holidays_table') }}</h6>
      <span class="badge bg-label-secondary ms-auto">{{ __('help.common.admin_hr') }}</span>
    </div>
    <div class="card-body pt-2">
      <p class="text-body mb-2">{{ __('help.common.columns') }} {{ __('help.common.name') }}, {{ __('help.common.center') }} (badges), {{ __('help.common.date_range') }}, {{ __('help.common.note') }}, {{ __('help.common.actions') }}.</p>
      <ul class="list-unstyled mb-0">
        <li class="d-flex align-items-start gap-2 mb-2">
          <i class="ti ti-pencil text-info mt-1 flex-shrink-0"></i>
          <span><strong>{{ __('help.common.edit') }}</strong> – {{ __('help.holidays.edit_holiday_modal') }}</span>
        </li>
        <li class="d-flex align-items-start gap-2 mb-0">
          <i class="ti ti-trash text-danger mt-1 flex-shrink-0"></i>
          <span><strong>{{ __('help.common.delete') }}</strong> – {{ __('help.holidays.delete_dropdown') }}</span>
        </li>
      </ul>
      <p class="text-muted small mt-2 mb-0">{{ __('help.holidays.pagination_many') }}</p>
    </div>
  </div>

  <div class="card border shadow-none mb-0">
    <div class="card-header d-flex align-items-center gap-2 py-3">
      <span class="badge rounded-pill bg-label-success p-2"><i class="ti ti-forms ti-sm"></i></span>
      <h6 class="mb-0">{{ __('help.holidays.holiday_form_modal') }}</h6>
    </div>
    <div class="card-body pt-2">
      <p class="text-body mb-2">{{ __('help.holidays.add_holiday_required') }}</p>
      <ul class="list-unstyled mb-0">
        <li class="d-flex align-items-start gap-2 mb-1"><i class="ti ti-tag ti-xs text-muted mt-1 flex-shrink-0"></i><span><strong>{{ __('help.common.name') }}</strong> – {{ __('help.holidays.holiday_name') }}</span></li>
        <li class="d-flex align-items-start gap-2 mb-1"><i class="ti ti-building-community ti-xs text-muted mt-1 flex-shrink-0"></i><span><strong>{{ __('help.common.centers') }}</strong> – {{ __('help.holidays.centers_multiselect') }}</span></li>
        <li class="d-flex align-items-start gap-2 mb-1"><i class="ti ti-calendar ti-xs text-muted mt-1 flex-shrink-0"></i><span><strong>{{ __('help.common.from_date') }}</strong> / <strong>{{ __('help.common.to_date') }}</strong> – {{ __('help.holidays.date_range_holiday') }}</span></li>
        <li class="d-flex align-items-start gap-2 mb-0"><i class="ti ti-notes ti-xs text-muted mt-1 flex-shrink-0"></i><span><strong>{{ __('help.common.note') }}</strong> – {{ __('help.common.optional') }}</span></li>
      </ul>
      <p class="text-body mt-2 mb-0">{{ __('help.holidays.submit_empty_state') }}</p>
    </div>
  </div>
</div>
