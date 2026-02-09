<div class="p-4">
  <div class="d-flex align-items-center gap-3 mb-4">
    <div class="badge rounded-pill bg-label-primary p-3">
      <i class="ti ti-message-circle ti-lg"></i>
    </div>
    <div>
      <h5 class="mb-1">{{ __('help.common.messages') }} – {{ __('help.common.personal') }}</h5>
      <p class="text-muted small mb-0">{{ __('help.messages_personal.intro') }}</p>
    </div>
  </div>

  <div class="card border shadow-none mb-4">
    <div class="card-header d-flex align-items-center gap-2 py-3">
      <span class="badge rounded-pill bg-label-info p-2"><i class="ti ti-player-track-next ti-sm"></i></span>
      <h6 class="mb-0">{{ __('help.common.generate_discounts_sms') }}</h6>
      <span class="badge bg-label-secondary ms-auto">{{ __('help.common.admin_hr') }}</span>
    </div>
    <div class="card-body pt-2">
      <p class="text-body mb-2">{{ __('help.messages_personal.card_dropdown') }}</p>
      <ul class="list-unstyled mb-0">
        <li class="d-flex align-items-start gap-2 mb-1">
          <i class="ti ti-calendar ti-xs text-muted mt-1 flex-shrink-0"></i>
          <span><strong>{{ __('help.common.batch') }}</strong> – {{ __('help.messages_personal.select_batch_desc') }}</span>
        </li>
        <li class="d-flex align-items-start gap-2 mb-1">
          <i class="ti ti-refresh ti-xs text-muted mt-1 flex-shrink-0"></i>
          <span><strong>{{ __('help.common.generate') }}</strong> – {{ __('help.messages_personal.generate_creates') }}</span>
        </li>
        <li class="d-flex align-items-start gap-2 mb-0">
          <i class="ti ti-brand-whatsapp ti-xs text-muted mt-1 flex-shrink-0"></i>
          <span><strong>{{ __('help.common.send_by_whatsapp') }}</strong> – {{ __('help.messages_personal.whatsapp_sends') }}</span>
        </li>
      </ul>
      <p class="text-muted small mt-2 mb-0">{{ __('help.messages_personal.create_messages_summary') }}</p>
    </div>
  </div>

  <div class="card border shadow-none mb-0">
    <div class="card-header d-flex align-items-center gap-2 py-3">
      <span class="badge rounded-pill bg-label-success p-2"><i class="ti ti-chart-bar ti-sm"></i></span>
      <h6 class="mb-0">{{ __('help.common.statistics') }}</h6>
    </div>
    <div class="card-body pt-2">
      <p class="text-body mb-0">{{ __('help.messages_personal.shows_api') }}</p>
    </div>
  </div>
</div>
