<div>

@php
  $configData = Helper::appClasses();
@endphp

@section('title', 'Messages - Bulk')

@section('vendor-style')

@endsection

@section('page-style')
  <link rel="stylesheet" href="{{asset('assets/vendor/css/pages/app-chat.css')}}" />
@endsection

@push('custom-css')
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
    <style>
      .app-chat .app-chat-history .chat-history-body {
          height: calc(100vh - 22rem);
      }
    </style>
@endpush

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
    </li>
    <li class="breadcrumb-item active">{{ __('Human Resource') }}</li>
    <li class="breadcrumb-item active">{{ __('Messages') }}</li>
    <li class="breadcrumb-item active">{{ __('Bulk') }}</li>
  </ol>
</nav>

{{-- Alerts --}}
@include('_partials/_alerts/alert-general')

<div class="row">

  <div class="col-12 mb-4">
    <div class="card">
      <div class="card-header d-flex justify-content-between">
        <h5 class="card-title mb-0">{{ __('Statistics') }}</h5>
        <small class="text-muted">{{ __('Updated recently') }}</small>
      </div>
      <div class="card-body pt-2">
        <div class="row gy-3">
          <div class="col-md-4 col-6">
            <div class="d-flex align-items-center">
              <div class="badge rounded-pill bg-label-secondary me-3 p-2"><i class="ti ti-align-justified ti-sm"></i></div>
              <div class="card-secondary">
                <h5 class="mb-0">{{ $messagesStatus['all'] }}</h5>
                <small>{{ __('All') }}</small>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-6">
            <div class="d-flex align-items-center">
              <div class="badge rounded-pill bg-label-success me-3 p-2"><i class="ti ti-speakerphone ti-sm"></i></div>
              <div class="card-info">
                <h5 class="mb-0">{{ $messagesStatus['sent'] }}</h5>
                <small>{{ __('Successful') }}</small>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-6">
            <div class="d-flex align-items-center">
              <div wire:click='sendPendingBulkMessages' class="badge rounded-pill bg-label-danger me-3 p-2" style="cursor: pointer"><i class="ti ti-send ti-sm"></i></div>
              <div class="card-info">
                <h5 class="mb-0">{{ $messagesStatus['unsent'] }}</h5>
                <small>{{ __('Pending') }}</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-12 mb-4">
    <div class="card">
      <div class="card-header d-flex justify-content-between">
        <h5 class="card-title mb-0">{{ __('Details') }}</h5>
      </div>
      <div class="card-body">
        <div>
          <label class="form-label">{{ __('Text') }}</label>
          <textarea
              wire:model="messageText"
              class="form-control"
              rows="2"
              spellcheck="false"
              @if($validated) disabled @endif
          ></textarea>
      </div>

      <div class="mt-3 mb-3">
          <label class="form-label">{{ __('Numbers') }}</label>
          <textarea
              wire:model.debounce.500ms="numbersInput"
              class="form-control"
              rows="3"
              spellcheck="false"
              @if($validated) disabled @endif
              oninput="this.value = this.value.replace(/[^0-9\n]/g, '')"
          ></textarea>
      </div>
      @if (!$validated)
        <button wire:click="validateNumbers" wire:loading.attr="disabled" wire:target="validateNumbers" type="button" class="btn btn-primary waves-effect waves-light">
          <span wire:loading.remove wire:target="validateNumbers">{{ __('Validate') }}</span>
          <span wire:loading wire:target="validateNumbers">{{ __('Loading...') }}</span>
        </button>
      @endif
      @if ($validated)
          <div>
            <label class="block font-semibold mb-1">✅ الأرقام بعد التحقق ({{ count($numbers) }})</label>
            <div class="flex flex-wrap gap-2 max-h-40 overflow-auto">
                @foreach($numbers as $num)
                    <span class="px-2 py-1 bg-gray-200 rounded text-sm font-mono">{{ $num }}</span>
                @endforeach
            </div>
          </div>
          <button wire:click="send" type="button" class="btn btn-primary waves-effect waves-light mt-2">{{ __('Send') }}</button>
        @endif
        </div>
    </div>
  </div>
</div>

@push('custom-scripts')
  <script>
    window.addEventListener('scroll-to-top', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  </script>
@endpush
