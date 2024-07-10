@push('custom-css')
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
@endpush

<div wire:ignore.self class="modal fade" id="timelineModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-simple">
    <div class="modal-content p-0 p-md-5">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-4">
          <h3 class="mb-2">{{ __('New Timeline') }}</h3>
          <p class="text-muted">{{ __('Please fill out the following information') }}</p>
        </div>
        <form wire:submit="submitTimeline" class="row g-3 mt-2">
          <div wire:ignore class="col-md-4 col-12">
            <label class="form-label">{{ __('Center') }}</label>
            <select wire:model="employeeTimelineInfo.centerId" id="selectCenters"
              class="select2 form-select @error('employeeTimelineInfo.centerId') is-invalid @enderror">
              <option value=""></option>
              @foreach ($centers as $Center)
                <option value="{{ $Center->id }}"> {{ $Center->name }}</option>
              @endforeach
            </select>
          </div>
          <div wire:ignore class="col-md-4 col-12">
            <label class="form-label">{{ __('Department') }}</label>
            <select wire:model="employeeTimelineInfo.departmentId" id="selectDepartment"
              class="select2 form-select @error('employeeTimelineInfo.departmentId') is-invalid @enderror">
              <option value=""></option>
              @foreach ($departments as $department)
                <option value="{{ $department->id }}"> {{ $department->name }}</option>
              @endforeach
            </select>
          </div>
          <div wire:ignore class="col-md-4 col-12">
            <label class="form-label">{{ __('Position') }}</label>
            <select wire:model="employeeTimelineInfo.positionId" id="selectPosition"
              class="select2 form-select @error('employeeTimelineInfo.positionId') is-invalid @enderror">
              <option value=""></option>
              @foreach ($positions as $position)
                <option value="{{ $position->id }}"> {{ $position->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-4 col-12">
            <label class="form-label w-100" for="startDate">{{ __('Start Date') }}</label>
            <input wire:model="employeeTimelineInfo.startDate" type="text" id="flatpickr-Start-Date"
              class="form-control flatpickr-input active @error('employeeTimelineInfo.startDate') is-invalid @enderror" placeholder="YYYY/MM/DD" readonly="readonly"/>
          </div>
          <div class="col-md-4 col-12">
            <label class="form-label w-100" for="endDate">{{ __('End Date') }}</label>
            <input wire:model="employeeTimelineInfo.endDate" type="text" id="flatpickr-End-Date"
              class="form-control flatpickr-input active @error('employeeTimelineInfo.endDate') is-invalid @enderror" placeholder="YYYY/MM/DD" readonly="readonly"/>
          </div>
          <div class="col-md-4 col-12">
            <label class="form-label">{{ __('Sequential') }}</label>
            <select wire:model="employeeTimelineInfo.isSequent"
              class="form-select @error('employeeTimelineInfo.isSequent') is-invalid @enderror">
              <option value=""></option>
              <option value="1">{{ __('Sequent') }}</option>
              <option value="0">{{ __('Non-Sequent') }}</option>
            </select>
          </div>
          <div class="col-md-12 col-12 mb-4">
            <label class="form-label w-100">{{ __('Note') }}</label>
            <input wire:model='employeeTimelineInfo.notes' class="form-control @error('employeeTimelineInfo.note') is-invalid @enderror" type="text" />
          </div>

          <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary me-sm-3 me-1">{{ __('Submit') }}</button>
            <button type="reset" class="btn btn-label-secondary btn-reset" data-bs-dismiss="modal"
              aria-label="Close">{{ __('Cancel') }}</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@push('custom-scripts')
  <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>

  <script>
    'use strict';

    $(function () {
      const selectPicker = $('.selectpicker'),
        select2 = $('.select2'),
        select2Icons = $('.select2-icons');

      // Default
      if (select2.length) {
        select2.each(function () {
          var $this = $(this);
          $this.wrap('<div class="position-relative"></div>').select2({
            placeholder: "{{ __('Search...') }}",
            dropdownParent: $this.parent()
          });
        });
      }
    });
  </script>

  <script>
    $('#selectCenters').on('change', function (e) {
      var data = $('#selectCenters').select2("val");
      @this.set('selectedCenter', data);
    });

    $('#selectDepartment').on('change', function (e) {
      var data = $('#selectDepartment').select2("val");
      @this.set('selectedDepartment', data);
    });

    $('#selectPosition').on('change', function (e) {
      var data = $('#selectPosition').select2("val");
      @this.set('selectedPosition', data);
    });
  </script>

  <script>
    'use strict';

    window.addEventListener('setSelect2Values', event => {
      $(function () {
        $("#selectCenters").val(event.detail.centerId).trigger('change');
        $("#selectDepartment").val(event.detail.departmentId).trigger('change');
        $("#selectPosition").val(event.detail.positionId).trigger('change');
      });
    })
  </script>

  <script>
    'use strict';

    window.addEventListener('clearSelect2Values', event => {
      $(function () {
        $('#selectCenters').select2('val', 0)
        $('#selectDepartment').select2('val', 0)
        $('#selectPosition').select2('val', 0)
      });
    })
  </script>

  <script>
    $(document).ready(function () {
      const flatpickrStartDate = document.querySelector('#flatpickr-Start-Date');
      if (typeof flatpickrStartDate != undefined) {
        flatpickrStartDate.flatpickr({
          dateFormat: "Y-m-d",
        });
      }
    });
  </script>
  <script>
    $(document).ready(function () {
      const flatpickrEndDate = document.querySelector('#flatpickr-End-Date');
      if (typeof flatpickrEndDate != undefined) {
        flatpickrEndDate.flatpickr({
          dateFormat: "Y-m-d",
        });
      }
    });
  </script>
@endpush
