<div>

  @php
    $configData = Helper::appClasses();
  @endphp

  @section('title', 'Contact Us')

  @section('vendor-style')

  @endsection

  @section('page-style')

  @endsection

  {{-- <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}">Dashboard</a>
      </li>
      <li class="breadcrumb-item active">Human Resource</li>
      <li class="breadcrumb-item active">HERE</li>
    </ol>
  </nav> --}}

  <div class="row">
    <div class="col-4">
      <div style="text-align: center">
        <h5 class="card-title">Amr Alsaleh</h5>
        <h6 class="card-subtitle text-muted">Software Engineer</h6>
      </div>
      <br>
      <div class="badge-base LI-profile-badge" data-locale="en_US" data-size="large" data-theme="light" data-type="HORIZONTAL" data-vanity="amralsaleeh" data-version="v1">
      </div>
    </div>
    <div class="col-4">
      <div style="text-align: center">
        <h5 class="card-title">Aref Naser Agha</h5>
        <h6 class="card-subtitle text-muted">Network Administration</h6>
        <br>
      </div>
      <div class="badge-base LI-profile-badge" data-locale="en_US" data-size="large" data-theme="light" data-type="HORIZONTAL" data-vanity="aref-naser-agha" data-version="v1">
      </div>
    </div>
    <div class="col-4">
      <div style="text-align: center">
        <h5 class="card-title">Sewar Khalil</h5>
        <h6 class="card-subtitle text-muted">Data Analyst</h6>
        <br>
      </div>
      <div class="badge-base LI-profile-badge" data-locale="en_US" data-size="large" data-theme="light" data-type="HORIZONTAL" data-vanity="sewar-khalil" data-version="v1">
      </div>
    </div>
  </div>

  @push('custom-scripts')
    <script src="https://platform.linkedin.com/badges/js/profile.js" async defer type="text/javascript"></script>
  @endpush
</div>
