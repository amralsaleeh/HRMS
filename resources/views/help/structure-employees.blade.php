<div class="p-4">
  <div class="d-flex align-items-center gap-3 mb-4">
    <div class="badge rounded-pill bg-label-primary p-3">
      <i class="ti ti-users ti-lg"></i>
    </div>
    <div>
      <h5 class="mb-1">{{ __('help.structure_employees.title') }}</h5>
      <p class="text-muted small mb-0">{{ __('help.structure_employees.intro') }}</p>
    </div>
  </div>

  <div class="card border shadow-none mb-4">
    <div class="card-header d-flex align-items-center gap-2 py-3">
      <span class="badge rounded-pill bg-label-info p-2"><i class="ti ti-search ti-sm"></i></span>
      <h6 class="mb-0">{{ __('help.common.search') }}</h6>
      <span class="badge bg-label-secondary ms-auto">{{ __('help.common.admin_hr') }}</span>
    </div>
    <div class="card-body pt-2">
      <p class="text-body mb-0">{{ __('help.structure_employees.search_desc') }}</p>
    </div>
  </div>

  <div class="card border shadow-none mb-4">
    <div class="card-header d-flex align-items-center gap-2 py-3">
      <span class="badge rounded-pill bg-label-success p-2"><i class="ti ti-table ti-sm"></i></span>
      <h6 class="mb-0">{{ __('help.structure_employees.employees_table') }}</h6>
    </div>
    <div class="card-body pt-2">
      <p class="text-body mb-2">{{ __('help.common.columns') }} {{ __('help.common.id') }}, {{ __('help.common.avatar') }}, {{ __('help.common.name') }}, {{ __('help.common.mobile') }}, {{ __('help.common.status') }} ({{ __('help.common.active') }}/{{ __('help.common.out_of_work') }}), {{ __('help.common.actions') }}.</p>
      <ul class="list-unstyled mb-2">
        <li class="d-flex align-items-start gap-2 mb-2">
          <i class="ti ti-link text-primary mt-1 flex-shrink-0"></i>
          <span>{{ __('help.structure_employees.click_avatar_profile') }}</span>
        </li>
        <li class="d-flex align-items-start gap-2 mb-2">
          <i class="ti ti-pencil text-info mt-1 flex-shrink-0"></i>
          <span><strong>{{ __('help.common.edit') }}</strong> – {{ __('help.structure_employees.edit_employee_modal') }}</span>
        </li>
        <li class="d-flex align-items-start gap-2 mb-0">
          <i class="ti ti-trash text-danger mt-1 flex-shrink-0"></i>
          <span><strong>{{ __('help.common.delete') }}</strong> – {{ __('help.structure_employees.delete_dropdown') }}</span>
        </li>
      </ul>
      <p class="text-muted small mb-0">{{ __('help.structure_employees.pagination_many') }}</p>
    </div>
  </div>

  <div class="card border shadow-none mb-0">
    <div class="card-header d-flex align-items-center gap-2 py-3">
      <span class="badge rounded-pill bg-label-warning p-2"><i class="ti ti-forms ti-sm"></i></span>
      <h6 class="mb-0">{{ __('help.structure_employees.employee_form_modal') }}</h6>
    </div>
    <div class="card-body pt-2">
      <p class="text-body mb-2">{{ __('help.structure_employees.add_employee_modal') }}</p>
      <p class="text-muted small mb-0">{{ __('help.structure_employees.empty_add_employee') }}</p>
    </div>
  </div>
</div>
