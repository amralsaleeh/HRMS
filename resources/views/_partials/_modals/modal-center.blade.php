@push('custom-css')
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}" />
@endpush

<div wire:ignore.self class="modal fade" id="centerModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-simple">
    <div class="modal-content p-0 p-md-5">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-4">
          <h3 class="mb-2">{{ $isEdit ? __('Update Center') : __('New Center') }}</h3>
          <p class="text-muted">{{ __('Please fill out the following information') }}</p>
        </div>
        <form wire:submit="submitCenter" class="row g-3">
          <div class="col-12">
            <label class="form-label w-100">{{ __('Name') }}</label>
            <input wire:model='name' class="form-control @error('name') is-invalid @enderror" type="text" />
            {{-- @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror --}}
          </div>
          <div wire:ignore class="col-md-12">
            <label class="form-label">{{ __('Weekends') }}</label>
            <select wire:model='weekends' id="select2Weekends" class="select2 form-select form-select-lg @error('weekends') is-invalid @enderror" data-allow-clear="true" multiple>
              <option value="0">{{ __('Sunday') }}</option>
              <option value="1">{{ __('Monday') }}</option>
              <option value="2">{{ __('Tuesday') }}</option>
              <option value="3">{{ __('Wednesday') }}</option>
              <option value="4">{{ __('Thursday') }}</option>
              <option value="5">{{ __('Friday') }}</option>
              <option value="6">{{ __('Saturday') }}</option>
            </select>
          </div>
          <div class="col-md-6 col-12 mb-4">
            <label class="form-label">{{ __('Work start at') }}</label>
            <input wire:model='startWorkHour' type="text" class="form-control @error('startWorkHour') is-invalid @enderror" placeholder="HH:MM" id="startWorkHour" autocomplete="off" />
          </div>
          <div class="col-md-6 col-12 mb-4">
            <label class="form-label">{{ __('Work end at') }}</label>
            <input wire:model='endWorkHour' type="text" class="form-control @error('endWorkHour') is-invalid @enderror" placeholder="HH:MM" id="endWorkHour" autocomplete="off" />
          </div>

          <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary me-sm-3 me-1">{{ __('Submit') }}</button>
            <button type="reset" class="btn btn-label-secondary btn-reset" data-bs-dismiss="modal" aria-label="Close">{{ __('Cancel') }}</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@push('custom-scripts')
  <script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/flatpickr/flatpickr.js')}}"></script>

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

      // $('#select2Weekends').select2();
      $('#select2Weekends').on('change', function (e) {
          var data = $('#select2Weekends').select2("val");
      @this.set('weekends', data);
      });
    });
  </script>

  <script>
    $(document).ready(function () {
      const startWorkHour = document.querySelector('#startWorkHour');
      if (startWorkHour) {
        startWorkHour.flatpickr({
          enableTime: true,
          noCalendar: true,
          time_24hr: true,
          defaultHour: 9
        });
      }

      const endWorkHour = document.querySelector('#endWorkHour');
      if (endWorkHour) {
        endWorkHour.flatpickr({
          enableTime: true,
          noCalendar: true,
          time_24hr: true,
          defaultHour: 15,
          defaultMinute: 30
        });
      }
    });
  </script>
@endpush
