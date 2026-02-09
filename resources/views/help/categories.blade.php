<div class="p-4">
  <div class="d-flex align-items-center gap-3 mb-4">
    <div class="badge rounded-pill bg-label-primary p-3">
      <i class="ti ti-category ti-lg"></i>
    </div>
    <div>
      <h5 class="mb-1">{{ __('help.categories.title') }}</h5>
      <p class="text-muted small mb-0">{{ __('help.categories.intro') }}</p>
    </div>
  </div>

  <div class="card border shadow-none mb-4">
    <div class="card-header d-flex align-items-center gap-2 py-3">
      <span class="badge rounded-pill bg-label-info p-2"><i class="ti ti-folder ti-sm"></i></span>
      <h6 class="mb-0">{{ __('help.categories.categories_left') }}</h6>
      <span class="badge bg-label-secondary ms-auto">{{ __('help.common.admin') }}/{{ __('help.common.am') }}</span>
    </div>
    <div class="card-body pt-2">
      <p class="text-body mb-2">{{ __('help.categories.categories_desc') }} {{ __('help.common.id') }}, {{ __('help.common.name') }}, {{ __('help.common.actions') }}. {{ __('help.categories.search_id_name') }}</p>
      <ul class="list-unstyled mb-0">
        <li class="d-flex align-items-start gap-2 mb-2">
          <i class="ti ti-info-circle text-primary mt-1 flex-shrink-0"></i>
          <span>{{ __('help.categories.click_category_modal') }}</span>
        </li>
        <li class="d-flex align-items-start gap-2 mb-2">
          <i class="ti ti-pencil text-info mt-1 flex-shrink-0"></i>
          <span><strong>{{ __('help.common.edit') }}</strong> – {{ __('help.categories.edit_category_modal') }}</span>
        </li>
        <li class="d-flex align-items-start gap-2 mb-0">
          <i class="ti ti-trash text-danger mt-1 flex-shrink-0"></i>
          <span><strong>{{ __('help.common.delete') }}</strong> – {{ __('help.categories.delete_confirm') }}</span>
        </li>
      </ul>
      <p class="text-body mt-2 mb-0"><strong>{{ __('help.common.add_new_category') }}</strong> – {{ __('help.categories.add_category_opens') }}</p>
    </div>
  </div>

  <div class="card border shadow-none mb-0">
    <div class="card-header d-flex align-items-center gap-2 py-3">
      <span class="badge rounded-pill bg-label-success p-2"><i class="ti ti-folder-off ti-sm"></i></span>
      <h6 class="mb-0">{{ __('help.categories.sub_categories_right') }}</h6>
    </div>
    <div class="card-body pt-2">
      <p class="text-body mb-2">{{ __('help.categories.sub_categories_desc') }} {{ __('help.common.id') }}, {{ __('help.common.name') }}, {{ __('help.common.category') }}, {{ __('help.common.actions') }}. {{ __('help.categories.search_id_subcategory') }}</p>
      <ul class="list-unstyled mb-0">
        <li class="d-flex align-items-start gap-2 mb-2">
          <i class="ti ti-pencil text-info mt-1 flex-shrink-0"></i>
          <span><strong>{{ __('help.common.edit') }}</strong> – {{ __('help.categories.edit_subcategory_modal') }}</span>
        </li>
        <li class="d-flex align-items-start gap-2 mb-0">
          <i class="ti ti-trash text-danger mt-1 flex-shrink-0"></i>
          <span><strong>{{ __('help.common.delete') }}</strong> – {{ __('help.categories.delete_confirm') }}</span>
        </li>
      </ul>
      <p class="text-body mt-2 mb-0"><strong>{{ __('help.common.add_new_sub_category') }}</strong> – {{ __('help.categories.add_subcategory_opens') }}</p>
    </div>
  </div>
</div>
