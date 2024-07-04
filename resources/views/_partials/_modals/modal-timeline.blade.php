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
            <select wire:model.defer="employeeTimelineInfo.centerId"
              class="select2 form-select @error('employeeTimelineInfo.centerId') is-invalid @enderror">
              @foreach ($centers as $Center)
                <option value="{{ $Center->id }}"> {{ $Center->name }}</option>
              @endforeach
            </select>
          </div>
          <div wire:ignore class="col-md-4 col-12">
            <label class="form-label">{{ __('Department') }}</label>
            <select wire:model.defer="employeeTimelineInfo.departmentId"
              class="select2 form-select @error('employeeTimelineInfo.departmentId') is-invalid @enderror">
              @foreach ($departments as $department)
                <option value="{{ $department->id }}"> {{ $department->name }}</option>
              @endforeach
            </select>
          </div>
          <div wire:ignore class="col-md-4 col-12">
            <label class="form-label">{{ __('Position') }}</label>
            <select wire:model.defer="employeeTimelineInfo.positionId"
              class="select2 form-select @error('employeeTimelineInfo.positionId') is-invalid @enderror">
              @foreach ($positions as $position)
                <option value="{{ $position->id }}"> {{ $position->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-4 col-12">
            <label class="form-label w-100" for="startDate">{{ __('Start Date') }}</label>
            <input wire:model.defer="employeeTimelineInfo.startDate" type="date"
              class="form-control @error('employeeTimelineInfo.startDate') is-invalid @enderror">
          </div>
          <div class="col-md-4 col-12">
            <label class="form-label w-100" for="endDate">{{ __('End Date') }}</label>
            <input wire:model.defer="employeeTimelineInfo.endDate" type="date"
              @if(!$isEdit) disabled @endif
              class="form-control @error('employeeTimelineInfo.endDate') is-invalid @enderror">
          </div>
          <div class="col-md-4 col-12">
            <label class="form-label">{{ __('Sequential') }}</label>
            <select wire:model.defer="employeeTimelineInfo.isSequent"
              class="form-select @error('employeeTimelineInfo.isSequent') is-invalid @enderror">
              <option value=""></option>
              <option value="1">{{ __('Squential') }}</option>
              <option value="0">{{ __('Non-Sequential') }}</option>
            </select>
          </div>
          <div class="col-md-12 col-12 mb-4">
            <label class="form-label w-100">{{ __('Note') }}</label>
            <input wire:model.defer='employeeTimelineInfo.notes' class="form-control @error('employeeTimelineInfo.note') is-invalid @enderror" type="text" />
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
            placeholder: 'Select value',
            dropdownParent: $this.parent()
          });
        });
      }

      // $('#selectCenters').select2();
      $('#selectCenters').on('change', function (e) {
          var data = $('#selectCenters').select2("val");
      @this.set('centers', data);
      });
    });
  </script>
@endpush
