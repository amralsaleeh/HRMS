@if (session()->has('success'))
  <div class="alert alert-success alert-dismissible d-flex align-items-baseline" role="alert">
    <span class="alert-icon alert-icon-lg text-success me-2">
      <i class="ti ti-check ti-sm"></i>
    </span>
    <div class="d-flex flex-column ps-1">
      {{-- <h5 class="alert-heading mb-2">This is a success alert — check it out!</h5> --}}
      <p class="mb-0">{{ session('success') }}</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  </div>
@endif

@if (session()->has('info'))
  <div class="alert alert-info alert-dismissible d-flex align-items-baseline" role="alert">
    <span class="alert-icon alert-icon-lg text-info me-2">
      <i class="ti ti-info-circle ti-sm"></i>
    </span>
    <div class="d-flex flex-column ps-1">
      {{-- <h5 class="alert-heading mb-2">This is a success alert — check it out!</h5> --}}
      <p class="mb-0">{{ session('info') }}</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  </div>
@endif

@if (session()->has('error'))
  <div class="alert alert-danger alert-dismissible d-flex align-items-baseline" role="alert">
    <span class="alert-icon alert-icon-lg text-danger me-2">
      <i class="ti ti-ban ti-sm"></i>
    </span>
    <div class="d-flex flex-column ps-1">
      {{-- <h5 class="alert-heading mb-2">This is a danger alert — check it out!</h5> --}}
      <p class="mb-0">{{ session('error') }}</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  </div>
@endif
