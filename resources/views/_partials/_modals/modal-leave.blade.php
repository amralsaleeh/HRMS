<div>
  @push('custom-css')
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}"/>
  @endpush

  <div wire:ignore.self class="modal fade" id="leaveModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-simple">
      <div class="modal-content p-3 p-md-5">
        <div class="modal-body">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="text-center mb-4">
            <h3 class="mb-2"></h3>
            <h3 class="mb-2">{{ $isEdit ? 'Update Record' : 'New Record' }}</h3>
            <p class="text-muted">Please fill out the following information</p>
          </div>
          <form wire:submit="submitLeave" class="row g-3">

            <div wire:ignore class="col-12 mb-4">
              <label class="form-label w-100">Name</label>
              <select wire:model='newLeaveInfo.LeaveId' name="updated_name" class="select2 form-control" id="select2LeaveId">
                <option value=""></option>
                @forelse ($leaveTypes as $leaveType)
                  <option value="{{ $leaveType->id }}">{{ $leaveType->name }}</option>
                @empty
                  <option value="0" disabled>No Leave Found!</option>
                @endforelse
              </select>
            </div>
            <div class="col-md-6 col-12 mb-4">
              <label class="form-label">From Date</label>
              <input  wire:model='newLeaveInfo.fromDate' type="text" class="form-control flatpickr-input active  @error('fromDate') is-invalid @enderror"  placeholder="YYYY-MM-DD" id="flatpickr-date-from" readonly="readonly">
            </div>
            <div class="col-md-6 col-12 mb-4">
              <label class="form-label w-100">To Date</label>
              <input wire:model='newLeaveInfo.toDate'  class="form-control flatpickr-input active @error('toDate') is-invalid @enderror" type="text" placeholder="YYYY-MM-DD" id="flatpickr-date-to" readonly="readonly" />
            </div>
            <div class="col-md-6 col-12 mb-4">
              <label class="form-label w-100">Start At</label>
              <input wire:model='startAt' class="form-control @error('startAt') is-invalid @enderror" type="text"  placeholder="HH:MM" id="startAt" autocomplete="off" />
            </div>
            <div class="col-md-6 col-12 mb-4">
              <label class="form-label w-100">End At</label>
              <input wire:model='endAt' class="form-control @error('endAt') is-invalid @enderror" type="text"  placeholder="HH:MM" id="endAt" autocomplete="off" />
            </div>
            <div class="col-12 text-center">
              <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
              <button type="reset" class="btn btn-label-secondary btn-reset" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  @push('custom-scripts')
    <script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>

    <script>
      $(document).ready(function () {
        const flatpickrDateFrom = document.querySelector('#flatpickr-date-from');
        if (typeof flatpickrDateFrom != undefined) {
          flatpickrDateFrom.flatpickr({
            dateFormat: "Y-m-d",
          });
        }
      });
    </script>

    <script>
      $(document).ready(function () {
        const flatpickrDateTo = document.querySelector('#flatpickr-date-to');
        if (typeof flatpickrDateTo != undefined) {
          flatpickrDateTo.flatpickr({
            dateFormat: "Y-m-d",
          });
        }
      });
    </script>

    <script>
      $(document).ready(function () {
        const checkIn = document.querySelector('#startAt');
        if (startAt) {
          startAt.flatpickr({
            enableTime: true,
            noCalendar: true,
            time_24hr: true,
            defaultHour: 9,
            minuteIncrement:1
          });
        }

        const checkOut = document.querySelector('#endAt');
        if (endAt) {
          endAt.flatpickr({
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
      'use strict';

      $(function () {
        const select2LeaveId = $('#select2LeaveId');

        if (select2LeaveId.length) {
          select2LeaveId.each(function () {
            var $this = $(this);
            $this.wrap('<div class="position-relative"></div>').select2({
              placeholder: 'Select..',
              allowClear: true,
              dropdownParent: $this.parent()
            });
          });
        }

        $('#select2LeaveId').on('change', function (e) {
          var data = $('#select2LeaveId').select2("val");
          @this.set('newLeaveInfo.LeaveId', data);
        });
      });
    </script>
  @endpush
</div>
