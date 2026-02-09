<div class="p-4">
  <div class="d-flex align-items-center gap-3 mb-4">
    <div class="badge rounded-pill bg-label-primary p-3">
      <i class="ti ti-mail ti-lg"></i>
    </div>
    <div>
      <h5 class="mb-1">{{ __('help.contact_us.title') }}</h5>
      <p class="text-muted small mb-0">{{ __('help.contact_us.intro') }}</p>
    </div>
  </div>

  <div class="card border shadow-none mb-4">
    <div class="card-header d-flex align-items-center gap-2 py-3">
      <span class="badge rounded-pill bg-label-info p-2"><i class="ti ti-users ti-sm"></i></span>
      <h6 class="mb-0">{{ __('help.contact_us.team_cards') }}</h6>
    </div>
    <div class="card-body pt-2">
      <p class="text-body mb-2">{{ __('help.contact_us.team_cards_desc') }}</p>
      <ul class="list-unstyled mb-0">
        <li class="d-flex align-items-start gap-2 mb-1"><i class="ti ti-user ti-xs text-muted mt-1 flex-shrink-0"></i><span>{{ __('help.contact_us.name_job_title') }}</span></li>
        <li class="d-flex align-items-start gap-2 mb-1"><i class="ti ti-photo ti-xs text-muted mt-1 flex-shrink-0"></i><span>{{ __('help.contact_us.profile_photo') }}</span></li>
        <li class="d-flex align-items-start gap-2 mb-1"><i class="ti ti-brand-linkedin ti-xs text-muted mt-1 flex-shrink-0"></i><span>{{ __('help.contact_us.linkedin_link') }}</span></li>
      </ul>
      <p class="text-muted small mt-2 mb-0">{{ __('help.contact_us.reach_out') }}</p>
    </div>
  </div>

  <div class="card border shadow-none mb-0">
    <div class="card-header d-flex align-items-center gap-2 py-3">
      <span class="badge rounded-pill bg-label-success p-2"><i class="ti ti-info-circle ti-sm"></i></span>
      <h6 class="mb-0">{{ __('help.contact_us.purpose') }}</h6>
    </div>
    <div class="card-body pt-2">
      <p class="text-body mb-0">{{ __('help.contact_us.purpose_desc') }}</p>
    </div>
  </div>
</div>
