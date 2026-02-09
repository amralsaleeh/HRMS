<div class="p-4">
  <div class="d-flex align-items-center gap-3 mb-4">
    <div class="badge rounded-pill bg-label-primary p-3">
      <i class="ti ti-user-circle ti-lg"></i>
    </div>
    <div>
      <h5 class="mb-1">{{ __('help.structure_employees_info.title') }}</h5>
      <p class="text-muted small mb-0">{{ __('help.structure_employees_info.intro') }}</p>
    </div>
  </div>

  <div class="card border shadow-none mb-4">
    <div class="card-header d-flex align-items-center gap-2 py-3">
      <span class="badge rounded-pill bg-label-info p-2"><i class="ti ti-user ti-sm"></i></span>
      <h6 class="mb-0">{{ __('help.structure_employees_info.profile_header') }}</h6>
      <span class="badge bg-label-secondary ms-auto">{{ __('help.common.admin_hr') }}</span>
    </div>
    <div class="card-body pt-2">
      <p class="text-body mb-2">{{ __('help.structure_employees_info.profile_header_desc') }}</p>
      <ul class="list-unstyled mb-0">
        <li class="d-flex align-items-start gap-2 mb-1">
          <i class="ti ti-toggle-right text-success mt-1 flex-shrink-0"></i>
          <span><strong>{{ __('help.common.active') }}/{{ __('help.common.inactive') }}</strong> – {{ __('help.structure_employees_info.active_inactive_toggle') }}</span>
        </li>
      </ul>
    </div>
  </div>

  <div class="card border shadow-none mb-4">
    <div class="card-header d-flex align-items-center gap-2 py-3">
      <span class="badge rounded-pill bg-label-success p-2"><i class="ti ti-device-laptop ti-sm"></i></span>
      <h6 class="mb-0">{{ __('help.common.assets') }}</h6>
    </div>
    <div class="card-body pt-2">
      <p class="text-body mb-2">{{ __('help.structure_employees_info.table_columns_assets') }} {{ __('help.common.id') }}, {{ __('help.common.category') }}, {{ __('help.common.sub_category') }}, {{ __('help.common.serial_number') }}, {{ __('help.common.handed_date') }}, {{ __('help.common.actions') }}. {{ __('help.structure_employees_info.click_edit_asset') }}</p>
      <p class="text-muted small mb-0">{{ __('help.structure_employees_info.empty_add_asset') }}</p>
    </div>
  </div>

  <div class="card border shadow-none mb-4">
    <div class="card-header d-flex align-items-center gap-2 py-3">
      <span class="badge rounded-pill bg-label-warning p-2"><i class="ti ti-info-circle ti-sm"></i></span>
      <h6 class="mb-0">{{ __('help.common.details') }}</h6>
    </div>
    <div class="card-body pt-2">
      <p class="text-body mb-0">{{ __('help.structure_employees_info.side_card') }}</p>
    </div>
  </div>

  <div class="card border shadow-none mb-0">
    <div class="card-header d-flex align-items-center gap-2 py-3">
      <span class="badge rounded-pill bg-label-secondary p-2"><i class="ti ti-timeline ti-sm"></i></span>
      <h6 class="mb-0">{{ __('help.common.timelines') }}</h6>
    </div>
    <div class="card-body pt-2">
      <p class="text-body mb-2">{{ __('help.structure_employees_info.timelines_desc') }}</p>
      <ul class="list-unstyled mb-0">
        <li class="d-flex align-items-start gap-2 mb-1"><i class="ti ti-plus text-primary mt-1 flex-shrink-0"></i><span><strong>{{ __('help.common.add_new_position') }}</strong> – {{ __('help.structure_employees_info.add_new_position') }}</span></li>
        <li class="d-flex align-items-start gap-2 mb-1"><i class="ti ti-refresh text-success mt-1 flex-shrink-0"></i><span><strong>{{ __('help.structure_employees_info.refresh_icon') }}</strong> – {{ __('help.structure_employees_info.refresh_icon_desc') }}</span></li>
        <li class="d-flex align-items-start gap-2 mb-1"><i class="ti ti-pencil text-info mt-1 flex-shrink-0"></i><span><strong>{{ __('help.structure_employees_info.edit_icon') }}</strong> – {{ __('help.structure_employees_info.edit_timeline_modal') }}</span></li>
        <li class="d-flex align-items-start gap-2 mb-0"><i class="ti ti-trash text-danger mt-1 flex-shrink-0"></i><span><strong>{{ __('help.structure_employees_info.trash_icon') }}</strong> – {{ __('help.structure_employees_info.trash_confirm_delete') }}</span></li>
      </ul>
    </div>
  </div>
</div>
