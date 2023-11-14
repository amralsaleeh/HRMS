<div>

@php
  $configData = Helper::appClasses();
@endphp

@section('title', 'Personal - Messages')

@section('vendor-style')

@endsection

@section('page-style')
  <link rel="stylesheet" href="{{asset('assets/vendor/css/pages/app-chat.css')}}" />
@endsection

@section('vendor-script')

@endsection

@section('page-script')

@endsection

@push('custom-css')
    <style>
      .app-chat .app-chat-history .chat-history-body {
          height: calc(100vh - 22rem);
      }
    </style>
@endpush

<div class="app-chat card overflow-hidden">
  <div class="row g-0">
    <!-- Employees -->
    <div class="col app-chat-contacts app-sidebar flex-grow-0 overflow-hidden border-end" id="app-chat-contacts">
      <div class="sidebar-header">
        <div class="d-flex align-items-center me-3 me-lg-0">
          <div class="flex-grow-1 input-group input-group-merge rounded-pill">
            <span class="input-group-text" id="basic-addon-search31"><i class="ti ti-search"></i></span>
            <input wire:model.live='searchTerm' type="text" class="form-control chat-search-input" placeholder="Search..." aria-label="Search..." aria-describedby="basic-addon-search31">
          </div>
        </div>
        <i class="ti ti-x cursor-pointer mt-2 me-1 d-lg-none d-block position-absolute top-0 end-0" data-overlay data-bs-toggle="sidebar" data-target="#app-chat-contacts"></i>
      </div>
      <hr class="container-m-nx m-0">
      <div class="sidebar-body">
        <ul class="list-unstyled chat-contact-list mb-0" id="contact-list">
          <li class="chat-contact-list-item chat-contact-list-item-title">
            <h5 class="text-primary mb-0">Employees</h5>
          </li>
          @forelse ($employees as $employee)
            <div wire:key="{{ $employee->id }}" wire:click.prevent='selectEmployee({{ $employee }})'>
              <li class="chat-contact-list-item {{ $employee->id == $selectedEmployee->id ? 'active' : '' }}">
                <a class="d-flex align-items-center">
                  <div class="flex-shrink-0 avatar avatar-online">
                    <img src="{{asset('assets/img/avatars/4.png')}}" alt="Avatar" class="rounded-circle">
                  </div>
                  <div class="chat-contact-info flex-grow-1 ms-2">
                    <h6 class="chat-contact-name text-truncate m-0">{{ $employee->full_name }}</h6>
                    <p class="chat-contact-status text-muted text-truncate mb-0">{{ $employee->current_position }}</p>
                  </div>
                  <small class="text-muted mb-auto">ID: {{ $employee->id }}</small>
                </a>
              </li>
            </div>
          @empty
            <h6 style="text-align: center" class="text-muted mb-0">No One's Found!</h6>
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
                <img src="{{ asset('assets/img/avatars/2.png') }}" alt="Avatar" class="rounded-circle" data-bs-toggle="sidebar" data-overlay data-target="#app-chat-sidebar-right">
              </div>
              <div class="chat-contact-info flex-grow-1 ms-2">
                <h6 class="m-0">{{ $selectedEmployee->full_name }}</h6>
                <small class="user-status text-muted">{{ $selectedEmployee->current_position }}</small>
              </div>
            </div>
            <div class="d-flex align-items-center">
              <i class="ti ti-phone-call cursor-pointer d-sm-block d-none me-3" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-original-title="{{ '+'.$selectedEmployee->mobile_number }}"></i>
              <div class="dropdown d-flex align-self-center">
                <button class="btn p-0" type="button" id="chat-header-actions" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="ti ti-dots-vertical"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="chat-header-actions">
                  <a class="dropdown-item" href="javascript:void(0);">View Contact</a>
                  <a class="dropdown-item" href="javascript:void(0);">Clear Chat</a>
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
                      <small>{{ $message->updated_at }}</small>
                    </div>
                  </div>
                  <div class="user-avatar flex-shrink-0 ms-3">
                    <div class="avatar avatar-sm">
                      <img src="{{asset('assets/img/avatars/1.png')}}" alt="Avatar" class="rounded-circle">
                    </div>
                  </div>
                </div>
              </li>
            @empty
              <div style="text-align: center">
                <h6 class="text-muted mb-4">No Messages Yet!</h6>
                <img src="{{ asset('assets/img/illustrations/girl-doing-yoga-dark.png') }}" width="20%">
              </div>
            @endforelse
          </ul>
        </div>

        <!-- Chat message form -->
        <div class="chat-history-footer shadow-sm">
          <form wire:submit='sendMessage' class="form-send-message d-flex justify-content-between align-items-center ">
            {{-- <input class="form-control message-input border-0 me-3 shadow-none" placeholder="Type your message here"> --}}
            <textarea wire:model='messageBody' class="form-control message-input border-0 me-3 shadow-none" style="resize: none" rows="3" spellcheck="true" placeholder="Type your message here" required></textarea>
            <div class="message-actions d-flex align-items-center">
              <button class="btn btn-primary d-flex send-msg-btn">
                <i class="ti ti-send me-md-1 me-0"></i>
                <span class="align-middle d-md-inline-block d-none">Send</span>
                <div wire:loading >ing</div>
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
    <script>
      window.addEventListener('initialize', event => {
        $(function () {
          const chatContactsBody = document.querySelector('.app-chat-contacts .sidebar-body'),
          chatHistoryBody = document.querySelector('.chat-history-body');

          // Chat contacts scrollbar
          if (chatContactsBody) {
            new PerfectScrollbar(chatContactsBody, {
              wheelPropagation: false,
              suppressScrollX: true
            });
          }

          // Chat history scrollbar
          if (chatHistoryBody) {
            new PerfectScrollbar(chatHistoryBody, {
              wheelSpeed: 0.3,
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
@endpush
</div>
