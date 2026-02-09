<div class="p-4">
  <div class="d-flex align-items-center gap-3 mb-4">
    <div class="badge rounded-pill bg-label-primary p-3">
      <i class="ti ti-send ti-lg"></i>
    </div>
    <div>
      <h5 class="mb-1">{{ __('help.common.messages') }} – {{ __('help.common.bulk') }}</h5>
      <p class="text-muted small mb-0">{{ __('help.messages_bulk.intro') }}</p>
    </div>
  </div>

  <div class="card border shadow-none mb-4">
    <div class="card-header d-flex align-items-center gap-2 py-3">
      <span class="badge rounded-pill bg-label-info p-2"><i class="ti ti-chart-bar ti-sm"></i></span>
      <h6 class="mb-0">{{ __('help.common.statistics') }}</h6>
      <span class="badge bg-label-secondary ms-auto">{{ __('help.common.admin') }}/{{ __('help.common.hr') }}/{{ __('help.common.cc') }}</span>
    </div>
    <div class="card-body pt-2">
      <p class="text-body mb-2">{{ __('help.messages_bulk.shows_all_pending') }}</p>
      <ul class="list-unstyled mb-0">
        <li class="d-flex align-items-start gap-2 mb-1">
          <i class="ti ti-send text-danger mt-1 flex-shrink-0"></i>
          <span><strong>{{ __('help.common.pending_sms') }}</strong> – {{ __('help.messages_bulk.pending_click') }}</span>
        </li>
      </ul>
    </div>
  </div>

  <div class="card border shadow-none mb-0">
    <div class="card-header d-flex align-items-center gap-2 py-3">
      <span class="badge rounded-pill bg-label-success p-2"><i class="ti ti-forms ti-sm"></i></span>
      <h6 class="mb-0">{{ __('help.common.details') }}</h6>
    </div>
    <div class="card-body pt-2">
      <ul class="list-unstyled mb-0">
        <li class="d-flex align-items-start gap-2 mb-2">
          <i class="ti ti-message ti-sm text-primary mt-1 flex-shrink-0"></i>
          <span><strong>{{ __('help.common.text') }}</strong> – {{ __('help.messages_bulk.message_content') }}</span>
        </li>
        <li class="d-flex align-items-start gap-2 mb-2">
          <i class="ti ti-phone ti-sm text-primary mt-1 flex-shrink-0"></i>
          <span><strong>{{ __('help.common.numbers') }}</strong> – {{ __('help.messages_bulk.one_phone_per_line') }}</span>
        </li>
        <li class="d-flex align-items-start gap-2 mb-2">
          <i class="ti ti-check ti-sm text-success mt-1 flex-shrink-0"></i>
          <span><strong>{{ __('help.common.validate') }}</strong> – {{ __('help.messages_bulk.validate_desc') }}</span>
        </li>
        <li class="d-flex align-items-start gap-2 mb-0">
          <i class="ti ti-send ti-sm text-primary mt-1 flex-shrink-0"></i>
          <span>{{ __('help.messages_bulk.after_validate_send') }}</span>
        </li>
      </ul>
    </div>
  </div>
</div>
