<div class="p-4">
  <div class="d-flex align-items-center gap-3 mb-4">
    <div class="badge rounded-pill bg-label-primary p-3">
      <i class="ti ti-zzz ti-lg"></i>
    </div>
    <div>
      <h5 class="mb-1">{{ __('help.attendance_leaves.title') }}</h5>
      <p class="text-muted small mb-0">{{ __('help.attendance_leaves.intro') }}</p>
    </div>
  </div>

  <div class="card border shadow-none mb-4">
    <div class="card-header d-flex align-items-center gap-2 py-3">
      <span class="badge rounded-pill bg-label-info p-2"><i class="ti ti-filter ti-sm"></i></span>
      <h6 class="mb-0">{{ __('help.attendance_leaves.sidebar_filters') }}</h6>
      <span class="badge bg-label-secondary ms-auto">{{ __('help.common.admin') }}/{{ __('help.common.hr') }}/{{ __('help.common.cc') }}</span>
    </div>
    <div class="card-body pt-2">
      <ul class="list-unstyled mb-0">
        <li class="d-flex align-items-start gap-2 mb-2">
          <i class="ti ti-user ti-sm text-primary mt-1 flex-shrink-0"></i>
          <span><strong>{{ __('help.common.employee') }}</strong> – {{ __('help.attendance_leaves.select_employee_leaves') }}</span>
        </li>
        <li class="d-flex align-items-start gap-2 mb-2">
          <i class="ti ti-calendar ti-sm text-primary mt-1 flex-shrink-0"></i>
          <span><strong>{{ __('help.common.date_range') }}</strong> – {{ __('help.attendance_leaves.pick_date_range') }}</span>
        </li>
        <li class="d-flex align-items-start gap-2 mb-2">
          <i class="ti ti-tag ti-sm text-primary mt-1 flex-shrink-0"></i>
          <span><strong>{{ __('help.common.type') }}</strong> – {{ __('help.attendance_leaves.filter_by_type') }}</span>
        </li>
        <li class="d-flex align-items-start gap-2 mb-0">
          <i class="ti ti-check ti-sm text-primary mt-1 flex-shrink-0"></i>
          <span><strong>{{ __('help.common.apply') }}</strong> – {{ __('help.attendance_leaves.apply_desc') }}</span>
        </li>
      </ul>
    </div>
  </div>

  <div class="card border shadow-none mb-4">
    <div class="card-header d-flex align-items-center gap-2 py-3">
      <span class="badge rounded-pill bg-label-success p-2"><i class="ti ti-table ti-sm"></i></span>
      <h6 class="mb-0">{{ __('help.attendance_leaves.leaves_table') }}</h6>
    </div>
    <div class="card-body pt-2">
      <p class="text-body mb-2">{{ __('help.common.columns') }} {{ __('help.common.id') }}, {{ __('help.common.employee') }}, {{ __('help.common.type') }}, {{ __('help.common.details') }} {{ __('help.attendance_leaves.columns_details') }}, {{ __('help.common.actions') }}.</p>
      <ul class="list-unstyled mb-0">
        <li class="d-flex align-items-start gap-2 mb-2">
          <i class="ti ti-pencil text-info mt-1 flex-shrink-0"></i>
          <span><strong>{{ __('help.common.edit') }}</strong> – {{ __('help.attendance_leaves.edit_leave_modal') }}</span>
        </li>
        <li class="d-flex align-items-start gap-2 mb-0">
          <i class="ti ti-trash text-danger mt-1 flex-shrink-0"></i>
          <span><strong>{{ __('help.common.delete') }}</strong> – {{ __('help.attendance_leaves.delete_confirm') }}</span>
        </li>
      </ul>
    </div>
  </div>

  <div class="card border shadow-none mb-4">
    <div class="card-header d-flex align-items-center gap-2 py-3">
      <span class="badge rounded-pill bg-label-warning p-2"><i class="ti ti-forms ti-sm"></i></span>
      <h6 class="mb-0">{{ __('help.attendance_leaves.leave_form_modal') }}</h6>
      <span class="badge bg-label-secondary ms-auto">{{ __('help.common.admin') }}/{{ __('help.common.hr') }}/{{ __('help.common.cc') }}/{{ __('help.common.cr') }}</span>
    </div>
    <div class="card-body pt-2">
      <p class="text-body mb-2">{{ __('help.attendance_leaves.add_record_modal_rules') }}</p>
      <ul class="list-unstyled mb-2">
        <li class="d-flex align-items-start gap-2 mb-1"><i class="ti ti-circle-x text-danger ti-xs mt-1 flex-shrink-0"></i><span>{{ __('help.attendance_leaves.daily_leave_no_time') }}</span></li>
        <li class="d-flex align-items-start gap-2 mb-1"><i class="ti ti-circle-x text-danger ti-xs mt-1 flex-shrink-0"></i><span>{{ __('help.attendance_leaves.hourly_leave_required') }}</span></li>
        <li class="d-flex align-items-start gap-2 mb-1"><i class="ti ti-circle-x text-danger ti-xs mt-1 flex-shrink-0"></i><span>{{ __('help.attendance_leaves.hourly_same_day') }}</span></li>
        <li class="d-flex align-items-start gap-2 mb-1"><i class="ti ti-circle-x text-danger ti-xs mt-1 flex-shrink-0"></i><span>{{ __('help.attendance_leaves.from_to_rules') }}</span></li>
      </ul>
      <p class="text-body mb-0">{{ __('help.attendance_leaves.submit_cancel') }}</p>
    </div>
  </div>

  <div class="card border shadow-none mb-4">
    <div class="card-header d-flex align-items-center gap-2 py-3">
      <span class="badge rounded-pill bg-label-info p-2"><i class="ti ti-eye ti-sm"></i></span>
      <h6 class="mb-0">{{ __('help.attendance_leaves.who_sees_leaves') }}</h6>
    </div>
    <div class="card-body pt-2">
      <p class="text-body mb-0">{{ __('help.attendance_leaves.who_sees_desc') }}</p>
    </div>
  </div>

  <div class="card border shadow-none mb-0">
    <div class="card-header d-flex align-items-center gap-2 py-3">
      <span class="badge rounded-pill bg-label-secondary p-2"><i class="ti ti-file-import ti-sm"></i></span>
      <h6 class="mb-0">{{ __('help.common.import_export') }}</h6>
    </div>
    <div class="card-body pt-2">
      <ul class="list-unstyled mb-0">
        <li class="d-flex align-items-start gap-2 mb-2">
          <i class="ti ti-table-import text-primary mt-1 flex-shrink-0"></i>
          <span><strong>{{ __('help.common.import_from_excel') }}</strong> – {{ __('help.attendance_leaves.import_modal') }}</span>
        </li>
        <li class="d-flex align-items-start gap-2 mb-0">
          <i class="ti ti-table-export text-primary mt-1 flex-shrink-0"></i>
          <span><strong>{{ __('help.common.export_to_excel') }}</strong> – {{ __('help.attendance_leaves.export_excel') }}</span>
        </li>
      </ul>
    </div>
  </div>
</div>
