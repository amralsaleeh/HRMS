<div>

@php
  $configData = Helper::appClasses();
@endphp

@section('title', 'Messages - Personal')

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
    <li class="breadcrumb-item active">{{ __('Personal') }}</li>
  </ol>
</nav>

{{-- Alerts --}}
@include('_partials/_alerts/alert-general')

<div class="row">
  <div class="col-4">
    <div class="card bg-primary text-white mb-3">
      {{-- <div class="card-header">Header</div> --}}
      <div class="card-body d-flex justify-content-between align-items-center">
        <h5 class="card-title text-white">{{ __('Generate Discounts SMS') }}</h5>
        <div class="card-icon cursor-pointer">
            <button type="button" class="btn btn-label-secondary waves-effect waves-light" data-bs-toggle="dropdown" data-bs-auto-close="false" aria-haspopup="true" aria-expanded="false">
              <span class="ti ti-player-track-next"></span>
            </button>
            <div class="text-center border border-primary dropdown-menu dropdown-menu-end w-px-300">
              <form class="p-4">
                <div class="text-center">
                  <p class="text-muted">{{ __('Please pick the batch to generate SMS for:') }}</p>
                </div>
                <div wire:ignore class="mb-3">
                  {{-- <label class="form-label">batch</label> --}}
                  <select wire:model='selectedBatch' id="select2Batches" class="select2 form-select @error('selectedBatch') is-invalid @enderror">
                    <option value=""></option>
                    @foreach ($batches as $batche)
                        <option value="{{ $batche }}">{{ $batche }}</option>
                    @endforeach
                  </select>
                </div>
                <div>
                  <button wire:click='generateMessages' wire:loading.attr="disabled" class="btn btn-primary waves-effect waves-light mb-2" type="button">
                    <span wire:loading.remove>{{ __('Generate') }}</span>
                    <div wire:loading wire:target="generateMessages">
                      <span class="spinner-border me-1" role="status" aria-hidden="true"></span>
                      <span>{{ __('Generating...') }}</span>
                    </div>
                  </button>
                  <button wire:click='sendPendingMessagesByWhatsapp' wire:loading.attr="disabled" class="btn btn-primary waves-effect waves-light mb-2" type="button">
                    <span>{{ __('Send by WhatsApp') }}</span>
                  </button>
                </div>
              </form>
            </div>
        </div>
      </div>
      <div class="card-body pt-0">
        <p class="card-text">
         {{ __('Create messages summarizing discount details and balances for each employee.') }}
        </p>
      </div>
    </div>
  </div>
  <div class="col-8 mb-4">
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <h5 class="card-title mb-0">{{ __('Statistics') }}</h5>
          <small class="text-muted">{{ $accountBalance['status'] == 200 ? __('Updated recently') : __('Error, Update unavailable') }}</small>
        </div>
        <div class="card-body pt-2">
          <div class="row gy-3">
            <div class="col-md-3 col-6">
              <div class="d-flex align-items-center">
                <div class="badge rounded-pill bg-label-primary me-3 p-2"><i class="ti ti-activity ti-sm"></i></div>
                <div class="card-info">
                  <h5 class="mb-0">{{ $accountBalance['is_active'] }}</h5>
                  <small>{{ __('Status') }}</small>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-6">
              <div class="d-flex align-items-center">
                <div class="badge rounded-pill bg-label-info me-3 p-2"><i class="ti ti-calculator ti-sm"></i></div>
                <div class="card-info">
                  <h5 class="mb-0">{{ $accountBalance['balance'] }}</h5>
                  <small>{{ __('Balance') }}</small>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-6">
              <div class="d-flex align-items-center">
                <div class="badge rounded-pill bg-label-success me-3 p-2"><i class="ti ti-speakerphone ti-sm"></i></div>
                <div class="card-info">
                  <h5 class="mb-0">{{ $messagesStatus['sent'] }}</h5>
                  <small>{{ __('Successful') }}</small>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-6">
              <div class="d-flex align-items-center">
                <div wire:click='sendPendingMessages' class="badge rounded-pill bg-label-danger me-3 p-2" style="cursor: pointer"><i class="ti ti-send ti-sm"></i></div>
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
</div>

<div class="app-chat card overflow-hidden">
  <div class="row g-0">
    <!-- Employees -->
    <div class="col app-chat-contacts app-sidebar flex-grow-0 overflow-hidden border-end" id="app-chat-contacts">
      <div class="sidebar-header">
        <div class="d-flex align-items-center me-3 me-lg-0">
          <div class="flex-grow-1 input-group input-group-merge rounded-pill">
            <span class="input-group-text" id="basic-addon-search31"><i class="ti ti-search"></i></span>
            <input wire:model.live='searchTerm' type="text" class="form-control chat-search-input" placeholder="{{ __('Search...') }}" aria-label="Search..." aria-describedby="basic-addon-search31">
          </div>
        </div>
        <i class="ti ti-x cursor-pointer mt-2 me-1 d-lg-none d-block position-absolute top-0 end-0" data-overlay data-bs-toggle="sidebar" data-target="#app-chat-contacts"></i>
      </div>
      <hr class="container-m-nx m-0">
      <div class="sidebar-body">
        <ul class="list-unstyled chat-contact-list mb-0" id="contact-list">
          <li class="chat-contact-list-item chat-contact-list-item-title">
            <h5 class="text-primary mb-0">{{ __('Employees') }}</h5>
          </li>
          @forelse ($employees as $employee)
            <div wire:key="{{ $employee->id }}" wire:click.prevent='selectEmployee({{ $employee }})'>
              <li class="chat-contact-list-item {{ $employee->id == $selectedEmployee->id ? 'active' : '' }}">
                <a class="d-flex align-items-center">
                  <div class="flex-shrink-0 avatar avatar-online">
                    <img src="{{ Storage::disk("public")->exists($employee->profile_photo_path) ? Storage::disk("public")->url($employee->profile_photo_path) : Storage::disk("public")->url('profile-photos/.default-photo.jpg') }}" alt="Avatar" class="rounded-circle">
                  </div>
                  <div class="chat-contact-info flex-grow-1 ms-2">
                    <h6 class="chat-contact-name text-truncate m-0">{{ $employee->full_name }}</h6>
                    <p class="chat-contact-status text-muted text-truncate mb-0">{{ $employee->current_position }}</p>
                  </div>
                  <small class="text-muted mb-auto">{{ __('ID:') }} {{ $employee->id }}</small>
                </a>
              </li>
            </div>
          @empty
            <h6 style="text-align: center" class="text-muted mb-0">{{ ("No One's Found!") }}</h6>
          @endforelse
        </ul>
      </div>
    </div>
    <!-- /Employees -->

    <!-- Chat History -->
    <div class="col app-chat-history bg-body">
      <div class="chat-history-wrapper">
        <div class="chat-history-header border-bottom">
          <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex overflow-hidden align-items-center">
              <i class="ti ti-menu-2 ti-sm cursor-pointer d-lg-none d-block me-2" data-bs-toggle="sidebar" data-overlay data-target="#app-chat-contacts"></i>
              <div class="flex-shrink-0 avatar">
                <img src="{{ Storage::disk("public")->exists($selectedEmployee->profile_photo_path) ? Storage::disk("public")->url($selectedEmployee->profile_photo_path) : Storage::disk("public")->url('profile-photos/.default-photo.jpg') }}" alt="Avatar" class="rounded-circle" data-bs-toggle="sidebar" data-overlay data-target="#app-chat-sidebar-right">
              </div>
              <div class="chat-contact-info flex-grow-1 ms-2">
                <h6 class="m-0">{{ $selectedEmployee->full_name }}</h6>
                <small class="user-status text-muted">{{ $selectedEmployee->current_position }}</small>
              </div>
            </div>
            <div class="d-flex align-items-center">
              <i class="ti ti-phone-call d-sm-block d-none me-3" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-original-title="{{'+'. implode(' ', str_split($selectedEmployee->mobile_number, 3)) }}"></i>
              <div class="dropdown d-flex align-self-center">
                <button class="btn p-0" type="button" id="chat-header-actions" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="ti ti-dots-vertical"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="chat-header-actions">
                  <a class="dropdown-item" href="javascript:void(0);">{{ __('View Contact') }}</a>
                  <a class="dropdown-item" href="javascript:void(0);">{{ __('Clear Chat') }}</a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="chat-history-body bg-body">
          <ul class="list-unstyled chat-history">
            @forelse ($messages as $message)
              <li class="chat-message chat-message-right">
                <div class="d-flex overflow-hidden">
                  <div class="chat-message-wrapper flex-grow-1">
                    <div class="chat-message-text">
                      <p style="white-space: pre-wrap;" class="mb-0">{{ $message->text }}</p>
                    </div>
                    <div class="text-end text-muted mt-1">
                      <i class='ti {{ $message->is_sent ? 'text-success ti-checks' : 'ti-check' }} ti-xs me-1'></i>
                      <small>{{ $message->updated_at }}</small> - <small class="text-danger">{{ $message->error }}</small>
                    </div>
                  </div>
                  <div class="user-avatar flex-shrink-0 ms-3">
                    <div class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-original-title="{{ $message->updated_by }}">
                      <img src="{{ asset($message->getMessageSenderPhoto()) }}" alt="Avatar" class="rounded-circle">
                    </div>
                  </div>
                </div>
              </li>
            @empty
              <div style="text-align: center">
                <h6 class="text-muted mb-4">{{ __('No Personal Yet!') }}</h6>
                <img src="{{ asset('assets/img/illustrations/girl-doing-yoga-dark.png') }}" width="14%">
              </div>
            @endforelse
          </ul>
        </div>

        <!-- Chat message form -->
        <div class="chat-history-footer shadow-sm">
          <form wire:submit='sendMessage' class="form-send-message d-flex justify-content-between align-items-center ">
            {{-- <input class="form-control message-input border-0 me-3 shadow-none" placeholder="Type your message here"> --}}
            <textarea wire:model='messageBody' class="form-control message-input border-0 me-3 shadow-none" style="resize: none" rows="3" spellcheck="true" placeholder="{{ __('Type your message here') }}" required></textarea>
            <div class="message-actions d-flex align-items-center">
              <button wire:loading.attr="disabled" type="submit" class="btn btn-primary d-flex send-msg-btn">
                <div wire:loading.remove wire:target="sendMessage">
                  <div wire:loading.remove class="d-flex">
                    <i class="ti ti-send me-md-1 me-0"></i>
                    <span class="align-middle d-md-inline-block d-none">{{ __('Send') }}</span>
                  </div>
                </div>
                <div wire:loading wire:target="sendMessage">
                  <div class="d-flex">
                    <span class="spinner-border me-1" role="status" aria-hidden="true"></span>
                    <span>{{ __('Sending...') }}</span>
                  </div>
                </div>
              </button>
            </div>
          </form>
        </div>
        <!-- /Chat message form -->
      </div>
    </div>
    <!-- /Chat History -->
    <div class="app-overlay"></div>

  </div>
</div>

@push('custom-scripts')
    <script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>

    <script>
      window.addEventListener('initialize', event => {
        $(function () {
          const chatContactsBody = document.querySelector('.app-chat-contacts .sidebar-body'),
          chatHistoryBody = document.querySelector('.chat-history-body');

          // Chat contacts scrollbar
          if (chatContactsBody) {
            new PerfectScrollbar(chatContactsBody, {
              wheelSpeed: 0.2,
              wheelPropagation: false,
              suppressScrollX: true
            });
          }

          // Chat history scrollbar
          if (chatHistoryBody) {
            new PerfectScrollbar(chatHistoryBody, {
              wheelSpeed: 0.2,
              wheelPropagation: false,
              suppressScrollX: true
            });
          }

          // Scroll to bottom function
          function scrollToBottom() {
            chatHistoryBody.scrollTo(0, chatHistoryBody.scrollHeight);
          }
          scrollToBottom();
        });
      })
    </script>

    <script>
      'use strict';

      $(function () {
        const selectPicker = $('.selectpicker'),
          select2 = $('.select2');

        // Default
        if (select2.length) {
          select2.each(function () {
            var $this = $(this);
            $this.wrap('<div class="position-relative"></div>').select2({
              dropdownParent: $this.parent()
            });
          });
        }

        $('#select2Batches').on('change', function (e) {
            var data = $('#select2Batches').select2("val");
        @this.set('selectedBatch', data);
        });
      });
    </script>
@endpush
</div>
