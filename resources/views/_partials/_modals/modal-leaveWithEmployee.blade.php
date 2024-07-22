<div>
  @push('custom-css')
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}"/>
  @endpush

  <div wire:ignore.self class="modal fade" id="leaveModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-simple">
      <div class="modal-content">
        <div class="modal-body p-0">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="text-center mb-4">
            <h3 class="mb-2"></h3>
            <h3 class="mb-2">{{ $isEdit ? __('Update Record') : __('New Record') }}</h3>
            <p class="text-muted">{{ __('Please fill out the following information') }}</p>
          </div>
          <div class="d-flex justify-content-center mb-4">
            <div class="avatar" style="width: 6rem; height: 6rem">
              <img src="{{ Storage::disk("public")->exists($employeePhoto) ? Storage::disk("public")->url($employeePhoto) : Storage::disk("public")->url('profile-photos/.default-photo.jpg') }}" alt="Avatar" class="rounded-circle">
            </div>
          </div>
          <form wire:submit="submitLeave">
            @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
            @endif
            <div class="row mb-4">
              <div wire:ignore class="col-lg-6 col-12">
                <label class="form-label">{{ __('Employee') }}</label>
                <select wire:model='selectedEmployeeId' class="select2 form-control" id="select2selectedEmployeeId">
                  <option value=""></option>
                  @forelse ($activeEmployees as $timeline)
                    <option value="{{ $timeline->employee->id }}">{{ $timeline->employee->id . ' - ' . $timeline->employee->full_name }}</option>
                  @empty
                    <option value="0" disabled>{{__('No Employees Found!') }}</option>
                  @endforelse
                </select>
              </div>
              <div wire:ignore class="col-lg-6 col-12">
                <label class="form-label w-100">{{ __('Type') }}</label>
                <select wire:model='newLeaveInfo.LeaveId' name="updated_name" class="select2 form-control" id="select2LeaveId">
                  <option value=""></option>
                  @forelse ($leaveTypes as $leaveType)
                    <option value="{{ $leaveType->id }}">{{ $leaveType->name }}</option>
                  @empty
                    <option value="0" disabled>{{ __('No Leave Found!') }}</option>
                  @endforelse
                </select>
              </div>
            </div>
            <div class="row mb-5">
              <div class="col-md-6 col-12">
                <div class="row">
                  <div class="col-md-3 col-12">
                  <label class="form-label">{{ __('From Date') }}</label>
                  <input wire:model='newLeaveInfo.fromDate' type="text" class="form-control flatpickr-input active  @error('newLeaveInfo.fromDate') is-invalid @enderror" id="flatpickr-date-from" readonly="readonly">
                </div>
                <div class="col-md-3 col-12">
                  <label class="form-label w-100">{{ __('To Date') }}</label>
                  <input wire:model='newLeaveInfo.toDate'  class="form-control flatpickr-input active @error('newLeaveInfo.toDate') is-invalid @enderror" type="text" id="flatpickr-date-to" readonly="readonly" />
                </div>
                <div class="col-md-3 col-12">
                  <label class="form-label w-100">{{ __('Start At') }}</label>
                  <input wire:model='newLeaveInfo.startAt' class="form-control @error('newLeaveInfo.startAt') is-invalid @enderror" type="text" id="startAt" autocomplete="off" />
                </div>
                <div class="col-md-3 col-12">
                  <label class="form-label w-100">{{ __('End At') }}</label>
                  <input wire:model='newLeaveInfo.endAt' class="form-control @error('newLeaveInfo.endAt') is-invalid @enderror" type="text" id="endAt" autocomplete="off" />
                </div>
                </div>
              </div>
              <div class="col-md-6 col-12">
                <label class="form-label">{{ __('Note') }}</label>
                <input wire:model='newLeaveInfo.note' type="text" class="form-control">
              </div>
              </div>
            </div>
            <div class="col-12 text-center">
              <button type="submit" class="btn btn-primary me-sm-3 me-1">{{ __('Submit') }}</button>
              <button type="reset" class="btn btn-label-secondary btn-reset" data-bs-dismiss="modal" aria-label="Close">{{__('Cancel') }}</button>
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
            disable: [
                {
                    from: "1970-01-01",
                    to: "{{$fromDateLimit}}"
                },
            ]
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
            disable: [
                {
                    from: "1970-01-01",
                    to: "{{$fromDateLimit}}"
                },
            ]
          });
        }
      });
    </script>

    <script>
      $(document).ready(function () {
        const checkIn = document.querySelector('#startAt');
        if (checkIn) {
          checkIn.flatpickr({
            allowInput: true,
            enableTime: true,
            noCalendar: true,
            time_24hr: true,
            defaultHour: 9,
            minuteIncrement:1,
            minTime: "9:00",
            maxTime: "15:30"
          });
        }

        const checkOut = document.querySelector('#endAt');
        if (checkOut) {
          checkOut.flatpickr({
            allowInput: true,
            enableTime: true,
            noCalendar: true,
            time_24hr: true,
            defaultHour: 15,
            defaultMinute: 30,
            minuteIncrement:1,
            minTime: "9:00",
            maxTime: "15:30"
          });
        }
      });
    </script>

    <script>
      'use strict';

      $(function () {
        const select2selectedEmployeeId = $('#select2selectedEmployeeId');

        if (select2selectedEmployeeId.length) {
          select2selectedEmployeeId.each(function () {
            var $this = $(this);
            $this.wrap('<div class="position-relative"></div>').select2({
              placeholder: "{{ __('Search (ID, Name...)') }}",
              dropdownParent: $this.parent()
            });
          });
        }

        $('#select2selectedEmployeeId').on('change', function (e) {
          var data = $('#select2selectedEmployeeId').select2("val");
          @this.set('selectedEmployeeId', data);
        });
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
              placeholder: "{{ __('Search...') }}",
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

    <script>
      'use strict';

      window.addEventListener('setSelect2Values', event => {
        $(function () {
          $("#select2selectedEmployeeId").val(event.detail.employeeId).trigger('change');
          $("#select2LeaveId").val(event.detail.leaveId).trigger('change');
        });
      })
    </script>

    <script>
      'use strict';

      window.addEventListener('clearSelect2Values', event => {
        $(function () {
          // $('#select2selectedEmployeeId').select2('val', '0')
          $('#select2LeaveId').select2('val', '0')
        });
      })
    </script>
  @endpush
</div>
