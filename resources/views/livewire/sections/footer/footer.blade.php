<div>
  <!-- Footer-->
  <footer class="content-footer footer bg-footer-theme">
    <div class="{{ (!empty($containerNav) ? $containerNav : 'container-fluid') }}">
      <div class="footer-container d-flex align-items-center justify-content-between py-2 flex-md-row flex-column">
        <div style="text-align: center">
          © <script>
            document.write(new Date().getFullYear())
          </script>
          , {{ __('made with') }} ❤️ <a href="{{ route('contact-us') }}" target="_blank" class="fw-semibold">{{ __('IT Department') }}</a> {{ __('for a better work environment.') }}
        </div>
        <div>
          <a href="https://data.namaa.sy/" target="_blank" class="footer-link d-none d-sm-inline-block">{{ __('Data system') }}</a>
        </div>
      </div>
    </div>
  </footer>
  <!--/ Footer-->
</div>
