<div class="p-4">
  <div class="d-flex align-items-center gap-3 mb-4">
    <div class="badge rounded-pill bg-label-primary p-3">
      <i class="ti ti-building ti-lg"></i>
    </div>
    <div>
      <h5 class="mb-1">{{ __('help.structure_centers.title') }}</h5>
      <p class="text-muted small mb-0">{{ __('help.structure_centers.intro') }}</p>
    </div>
  </div>

  <div class="card border shadow-none mb-4">
    <div class="card-header d-flex align-items-center gap-2 py-3">
      <span class="badge rounded-pill bg-label-info p-2"><i class="ti ti-table ti-sm"></i></span>
      <h6 class="mb-0">{{ __('help.structure_centers.centers_table') }}</h6>
      <span class="badge bg-label-secondary ms-auto">{{ __('help.common.admin_hr') }}</span>
    </div>
    <div class="card-body pt-2">
      <p class="text-body mb-2">{{ __('help.common.columns') }} {{ __('help.common.id') }}, {{ __('help.common.name') }}, {{ __('help.common.members_count') }}, {{ __('help.common.working_hours') }}, {{ __('help.common.weekends') }}, {{ __('help.common.actions') }}. {{ __('help.common.members_count') }} {{ __('help.structure_centers.members_count_desc') }}</p>
      <ul class="list-unstyled mb-0">
        <li class="d-flex align-items-start gap-2 mb-2">
          <i class="ti ti-pencil text-info mt-1 flex-shrink-0"></i>
          <span><strong>{{ __('help.common.edit') }}</strong> – {{ __('help.structure_centers.edit_center_modal') }}</span>
        </li>
        <li class="d-flex align-items-start gap-2 mb-0">
          <i class="ti ti-trash text-danger mt-1 flex-shrink-0"></i>
          <span><strong>{{ __('help.common.delete') }}</strong> – {{ __('help.structure_centers.delete_dropdown') }}</span>
        </li>
      </ul>
    </div>
  </div>

  <div class="card border shadow-none mb-0">
    <div class="card-header d-flex align-items-center gap-2 py-3">
      <span class="badge rounded-pill bg-label-success p-2"><i class="ti ti-forms ti-sm"></i></span>
      <h6 class="mb-0">{{ __('help.structure_centers.center_form_modal') }}</h6>
    </div>
    <div class="card-body pt-2">
      <p class="text-body mb-2">{{ __('help.structure_centers.add_center_modal') }}</p>
      <ul class="list-unstyled mb-0">
        <li class="d-flex align-items-start gap-2 mb-1"><i class="ti ti-tag ti-xs text-muted mt-1 flex-shrink-0"></i><span><strong>{{ __('help.common.name') }}</strong> – {{ __('help.structure_centers.required_center_name') }}</span></li>
        <li class="d-flex align-items-start gap-2 mb-1"><i class="ti ti-calendar-week ti-xs text-muted mt-1 flex-shrink-0"></i><span><strong>{{ __('help.common.weekends') }}</strong> – {{ __('help.structure_centers.required_weekends') }}</span></li>
        <li class="d-flex align-items-start gap-2 mb-1"><i class="ti ti-clock ti-xs text-muted mt-1 flex-shrink-0"></i><span><strong>{{ __('help.common.work_start_at') }}</strong> / <strong>{{ __('help.common.work_end_at') }}</strong> – {{ __('help.structure_centers.required_work_window') }}</span></li>
      </ul>
      <p class="text-body mt-2 mb-0">{{ __('help.structure_centers.submit_validates') }}</p>
    </div>
  </div>
</div>
