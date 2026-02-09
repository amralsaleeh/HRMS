<div class="modal fade" id="helpModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{ __('help.title') }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        @php
          $viewName = $helpViewName ?? 'default';
          $helpView = 'help.' . $viewName;
        @endphp
        @if(view()->exists($helpView))
          @include($helpView)
        @else
          @include('help.default')
        @endif
      </div>
    </div>
  </div>
</div>
