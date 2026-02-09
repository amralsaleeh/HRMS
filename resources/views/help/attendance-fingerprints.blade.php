<div class="p-4">
  <div class="d-flex align-items-center gap-3 mb-4">
    <div class="badge rounded-pill bg-label-primary p-3">
      <i class="ti ti-fingerprint ti-lg"></i>
    </div>
    <div>
      <h5 class="mb-1">{{ __('help.attendance_fingerprints.title') }}</h5>
      <p class="text-muted small mb-0">{{ __('help.attendance_fingerprints.intro') }}</p>
    </div>
  </div>

  <div class="card border shadow-none mb-4">
    <div class="card-header d-flex align-items-center gap-2 py-3">
      <span class="badge rounded-pill bg-label-info p-2"><i class="ti ti-filter ti-sm"></i></span>
      <h6 class="mb-0">{{ __('help.attendance_fingerprints.sidebar_filters') }}</h6>
      <span class="badge bg-label-secondary ms-auto">{{ __('help.common.admin') }}/{{ __('help.common.hr') }}</span>
    </div>
    <div class="card-body pt-2">
      <ul class="list-unstyled mb-0">
        <li class="d-flex align-items-start gap-2 mb-2">
          <i class="ti ti-user ti-sm text-primary mt-1 flex-shrink-0"></i>
          <span><strong>{{ __('help.common.employee') }}</strong> – {{ __('help.attendance_fingerprints.select_employee_fingerprint') }}</span>
        </li>
        <li class="d-flex align-items-start gap-2 mb-2">
          <i class="ti ti-calendar ti-sm text-primary mt-1 flex-shrink-0"></i>
          <span><strong>{{ __('help.common.date_range') }}</strong> – {{ __('help.attendance_fingerprints.pick_date_range') }}</span>
        </li>
        <li class="d-flex align-items-start gap-2 mb-2">
          <i class="ti ti-checkbox ti-sm text-primary mt-1 flex-shrink-0"></i>
          <span><strong>{{ __('help.common.absence') }}</strong> – {{ __('help.attendance_fingerprints.absence_desc') }}</span>
        </li>
        <li class="d-flex align-items-start gap-2 mb-0">
          <i class="ti ti-checkbox ti-sm text-primary mt-1 flex-shrink-0"></i>
          <span><strong>{{ __('help.common.one_fingerprint') }}</strong> – {{ __('help.attendance_fingerprints.one_fingerprint_desc') }}</span>
        </li>
      </ul>
      <p class="text-body mt-2 mb-0"><strong>{{ __('help.common.apply') }}</strong> – {{ __('help.attendance_fingerprints.apply_desc') }}</p>
    </div>
  </div>

  <div class="card border shadow-none mb-4">
    <div class="card-header d-flex align-items-center gap-2 py-3">
      <span class="badge rounded-pill bg-label-success p-2"><i class="ti ti-table ti-sm"></i></span>
      <h6 class="mb-0">{{ __('help.attendance_fingerprints.fingerprints_table') }}</h6>
    </div>
    <div class="card-body pt-2">
      <p class="text-body mb-2">{{ __('help.common.columns') }} {{ __('help.common.date') }}, {{ __('help.common.check_in') }}, {{ __('help.common.check_out') }}, {{ __('help.common.excuse') }}, {{ __('help.common.actions') }}.</p>
      <ul class="list-unstyled mb-2">
        <li class="d-flex align-items-start gap-2 mb-2">
          <i class="ti ti-pencil text-info mt-1 flex-shrink-0"></i>
          <span><strong>{{ __('help.common.edit') }}</strong> – {{ __('help.attendance_fingerprints.edit_sidebar') }}</span>
        </li>
        <li class="d-flex align-items-start gap-2 mb-0">
          <i class="ti ti-trash text-danger mt-1 flex-shrink-0"></i>
          <span><strong>{{ __('help.common.delete') }}</strong> – {{ __('help.attendance_fingerprints.delete_confirm') }}</span>
        </li>
      </ul>
      <p class="text-muted small mb-0">{{ __('help.attendance_fingerprints.no_data_import') }}</p>
    </div>
  </div>

  <div class="card border shadow-none mb-4">
    <div class="card-header d-flex align-items-center gap-2 py-3">
      <span class="badge rounded-pill bg-label-warning p-2"><i class="ti ti-plus ti-sm"></i></span>
      <h6 class="mb-0">{{ __('help.attendance_fingerprints.add_edit_sidebar') }}</h6>
      <span class="badge bg-label-secondary ms-auto">{{ __('help.common.admin_only') }}</span>
    </div>
    <div class="card-body pt-2">
      <p class="text-body mb-2">{{ __('help.attendance_fingerprints.add_record_offcanvas') }}</p>
      <ul class="list-unstyled mb-0">
        <li class="d-flex align-items-start gap-2 mb-1"><i class="ti ti-calendar ti-xs text-muted mt-1 flex-shrink-0"></i><span><strong>{{ __('help.common.date') }}</strong> – {{ __('help.attendance_fingerprints.required_locked_date') }}</span></li>
        <li class="d-flex align-items-start gap-2 mb-1"><i class="ti ti-login ti-xs text-muted mt-1 flex-shrink-0"></i><span><strong>{{ __('help.common.check_in') }}</strong> – {{ __('help.attendance_fingerprints.required_time_checkin') }}</span></li>
        <li class="d-flex align-items-start gap-2 mb-0"><i class="ti ti-logout ti-xs text-muted mt-1 flex-shrink-0"></i><span><strong>{{ __('help.common.check_out') }}</strong> – {{ __('help.attendance_fingerprints.required_time_checkout') }}</span></li>
      </ul>
      <p class="text-body mt-2 mb-0">{{ __('help.attendance_fingerprints.submit_cancel_sidebar') }}</p>
    </div>
  </div>

  <div class="card border shadow-none mb-0">
    <div class="card-header d-flex align-items-center gap-2 py-3">
      <span class="badge rounded-pill bg-label-secondary p-2"><i class="ti ti-file-import ti-sm"></i></span>
      <h6 class="mb-0">{{ __('help.common.import_export') }}</h6>
      <span class="badge bg-label-secondary ms-auto">{{ __('help.common.admin_only') }}</span>
    </div>
    <div class="card-body pt-2">
      <ul class="list-unstyled mb-0">
        <li class="d-flex align-items-start gap-2 mb-2">
          <i class="ti ti-table-import text-primary mt-1 flex-shrink-0"></i>
          <span><strong>{{ __('help.common.import_from_excel') }}</strong> – {{ __('help.attendance_fingerprints.upload_xlsx') }}</span>
        </li>
        <li class="d-flex align-items-start gap-2 mb-0">
          <i class="ti ti-table-export text-primary mt-1 flex-shrink-0"></i>
          <span><strong>{{ __('help.common.export_to_excel') }}</strong> – {{ __('help.attendance_fingerprints.export_filtered') }}</span>
        </li>
      </ul>
    </div>
  </div>
</div>
