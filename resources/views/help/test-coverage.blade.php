<div class="p-4">
  <div class="d-flex align-items-center gap-3 mb-4">
    <div class="badge rounded-pill bg-label-primary p-3">
      <i class="ti ti-report ti-lg"></i>
    </div>
    <div>
      <h5 class="mb-1">{{ __('help.test_coverage.title') }}</h5>
      <p class="text-muted small mb-0">{{ __('help.test_coverage.intro') }}</p>
    </div>
  </div>

  <div class="card border shadow-none mb-4">
    <div class="card-header d-flex align-items-center gap-2 py-3">
      <span class="badge rounded-pill bg-label-info p-2"><i class="ti ti-file-code ti-sm"></i></span>
      <h6 class="mb-0">{{ __('help.test_coverage.what_page_shows') }}</h6>
      <span class="badge bg-label-secondary ms-auto">{{ __('help.common.admin_only') }}</span>
    </div>
    <div class="card-body pt-2">
      <p class="text-body mb-2">{{ __('help.test_coverage.serves_report') }}</p>
      <p class="text-body mb-0">{{ __('help.test_coverage.report_generated_by') }} <code>composer coverage</code> {{ __('help.test_coverage.or_phpunit') }}</p>
    </div>
  </div>

  <div class="card border shadow-none mb-0">
    <div class="card-header d-flex align-items-center gap-2 py-3">
      <span class="badge rounded-pill bg-label-success p-2"><i class="ti ti-link ti-sm"></i></span>
      <h6 class="mb-0">{{ __('help.test_coverage.navigation') }}</h6>
    </div>
    <div class="card-body pt-2">
      <p class="text-body mb-0">{{ __('help.test_coverage.navigation_desc') }}</p>
    </div>
  </div>
</div>
