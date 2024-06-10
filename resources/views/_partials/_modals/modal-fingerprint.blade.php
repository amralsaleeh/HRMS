<div class="offcanvas offcanvas-end event-sidebar" tabindex="-1" id="addRecordSidebar" aria-labelledby="addRecordSidebarLabel">

  <div class="offcanvas-header my-1">
    <h5 class="offcanvas-title">{{ __('Record Info') }}</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>

  <div class="offcanvas-body pt-0">
    <form wire:submit="submitFingerprint" class="row pt-0">
      <div class="mb-3">
        <label class="form-label">{{ __('Date') }}</label>
        <input  wire:model='date' type="text" class="form-control flatpickr-input active  @error('date') is-invalid @enderror"  placeholder="YYYY-MM-DD" id="flatpickr-date" readonly="readonly" {{ $isEdit ? 'disabled readonly' : '' }}>
      </div>
      <div class="col-md-6 col-12 mb-3">
        <label class="form-label">{{ __('Check In') }}</label>
        <input wire:model='checkIn' type="text" class="form-control @error('checkIn') is-invalid @enderror" placeholder="HH:MM" id="checkIn" autocomplete="off"/>
      </div>
      <div class="col-md-6 col-12 mb-3">
        <label class="form-label">{{ __('Check Out') }}</label>
        <input wire:model='checkOut' type="text" class="form-control @error('checkOut') is-invalid @enderror" placeholder="HH:MM" id="checkOut" autocomplete="off"/>
      </div>

      <div class="mb-3 d-flex justify-content-sm-between justify-content-start my-4">
        <div>
          <button type="submit" class="btn btn-primary btn-add-event me-sm-3 me-1">{{ __('Submit') }}</button>
          <button type="reset" class="btn btn-label-secondary btn-cancel me-sm-0 me-1" data-bs-dismiss="offcanvas">{{ __('Cancel') }}</button>
        </div>
      </div>
    </form>
  </div>
</div>

@push('custom-scripts')
  <script>
    $(document).ready(function () {
      const flatpickrDate = document.querySelector('#flatpickr-date');
      if (typeof flatpickrDate != undefined) {
        flatpickrDate.flatpickr({
          dateFormat: "Y-m-d",
        });
      }
    });
  </script>

  <script>
    $(document).ready(function () {
      const checkIn = document.querySelector('#checkIn');
      if (checkIn) {
        checkIn.flatpickr({
          enableTime: true,
          noCalendar: true,
          time_24hr: true,
          defaultHour: 9,
          minuteIncrement:1
        });
      }

      const checkOut = document.querySelector('#checkOut');
      if (checkOut) {
        checkOut.flatpickr({
          enableTime: true,
          noCalendar: true,
          time_24hr: true,
          defaultHour: 15,
          defaultMinute: 30,
          minuteIncrement:1
        });
      }
    });
  </script>
@endpush
