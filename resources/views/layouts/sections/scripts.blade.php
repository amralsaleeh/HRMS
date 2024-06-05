<!-- BEGIN: Vendor JS-->
<script src="{{ asset(mix('assets/vendor/libs/jquery/jquery.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/popper/popper.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/js/bootstrap.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/node-waves/node-waves.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/hammer/hammer.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/typeahead-js/typeahead.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/js/menu.js')) }}"></script>
<script src="{{asset('assets/vendor/libs/toastr/toastr.js')}}"></script>

@yield('vendor-script')
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{ asset(mix('assets/js/main.js')) }}"></script>

<script>
  toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
        "rtl": false
      }

  window.addEventListener('toastr', event => {
  toastr[event.detail.type](event.detail.message,
    event.detail.title ?? '')
  });
</script>

<script>
  window.addEventListener('closeModal', event => {
     $(event.detail.elementId).modal('hide');
  })
  window.addEventListener('closeCanvas', event => {
     $(event.detail.elementId).offcanvas('hide');
  })
</script>

<script>
  window.addEventListener('playMessageSound', event => {
     new Audio('{{ asset('assets/sound/message.mp3') }}').play();
  })
  window.addEventListener('playNotificationSound', event => {
     new Audio('{{ asset('assets/sound/notification.mp3') }}').play();
  })
  window.addEventListener('playErrorSound', event => {
     new Audio('{{ asset('assets/sound/error.mp3') }}').play();
  })
</script>

<script>
  window.addEventListener('scrollToTop', event => {
     window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
  })
</script>

<!-- END: Theme JS-->

<!-- Pricing Modal JS-->
@stack('pricing-script')
<!-- END: Pricing Modal JS-->

<!-- BEGIN: Page JS-->
@yield('page-script')
<!-- END: Page JS-->

@stack('modals')
@stack('custom-scripts')

@livewireScripts
