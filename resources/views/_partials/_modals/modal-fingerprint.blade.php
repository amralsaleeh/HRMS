@push('custom-css')
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}" />
@endpush

<div wire:ignore.self class="offcanvas offcanvas-end event-sidebar" tabindex="-1" id="addRecordSidebar" aria-labelledby="addRecordSidebarLabel">



  <div class="offcanvas-body pt-0">

    <div class="offcanvas-header my-1">
      {{-- <h5 class="offcanvas-title">Add New Record</h5> --}}
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      <div class="text-center mb-4">
        <h3 class="mb-2">{{ $isEdit ? 'Update Record' : 'New Record' }}</h3>
        <p class="text-muted">Please fill out the following information</p>
      </div>
    </div>
    <form wire:submit="submitFingerprint" class="row pt-0">
      <div class="mb-3">
        <label class="form-label">Date</label>
        {{-- <input wire:model='date' type="date" class="form-control @error('date') is-invalid @enderror" placeholder="YYYY/MM/DD" id="date" autocomplete="off" required /> --}}
        <input  wire:model='date' type="text" class="form-control flatpickr-input active  @error('date') is-invalid @enderror "  placeholder="YYYY-MM-DD" id="flatpickr-date" readonly="readonly" required>
      </div>
      <div class="col-md-6 col-12 mb-3">
        <label class="form-label">Check In</label>
        <input wire:model='check_in' type="text" class="form-control @error('check_in') is-invalid @enderror" placeholder="HH:MM" id="check_in" autocomplete="off" required />
      </div>
      <div class="col-md-6 col-12 mb-3">
        <label class="form-label">Check Out</label>
        <input wire:model='check_out' type="text" class="form-control @error('check_out') is-invalid @enderror" placeholder="HH:MM" id="check_out" autocomplete="off" required />
      </div>

      <div class="mb-3 d-flex justify-content-sm-between justify-content-start my-4">
        <div>
          <button type="submit" class="btn btn-primary btn-add-event me-sm-3 me-1">Add</button>
          <button type="reset" class="btn btn-label-secondary btn-cancel me-sm-0 me-1" data-bs-dismiss="offcanvas">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>

@push('custom-scripts')
  <script src="{{asset('assets/vendor/libs/flatpickr/flatpickr.js')}}"></script>

  <script>
    $(document).ready(function () {
      const check_in = document.querySelector('#check_in');
      if (check_in) {
        check_in.flatpickr({
          enableTime: true,
          noCalendar: true,
          time_24hr: true,
          defaultHour: 9,
          minuteIncrement:1
        });
      }

      const check_out = document.querySelector('#check_out');
      if (check_out) {
        check_out.flatpickr({
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


<script>
  $(document).ready(function () {
    const flatpickrDate = document.querySelector('#flatpickr-date');
    if (typeof flatpickrDate != undefined) {
      flatpickrDate.flatpickr({
        // mode: 'range'
        dateFormat: "Y-m-d",
      });
    }
  });
</script>
@endpush
