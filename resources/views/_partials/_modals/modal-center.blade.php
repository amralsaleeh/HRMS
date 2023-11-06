@push('custom-css')
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}" />
@endpush

<div wire:ignore.self class="modal fade" id="centerModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-simple">
    <div class="modal-content p-3 p-md-5">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-4">
          <h3 class="mb-2">{{ $is_edit ? 'Update Center' : 'New Center' }}</h3>
          <p class="text-muted">Please fill out the following information</p>
        </div>
        <form wire:submit="submitCenter" class="row g-3">
          <div class="col-12">
            <label class="form-label w-100">Name</label>
            <input wire:model='name' class="form-control @error('name') is-invalid @enderror" type="text" />
            {{-- @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror --}}
          </div>
          <div wire:ignore class="col-md-12">
            <label class="form-label">Weekends</label>
            <select wire:model='weekends' id="select2Weekends" class="select2 form-select form-select-lg @error('weekends') is-invalid @enderror" data-allow-clear="true" multiple>
              <option value="0">Sunday</option>
              <option value="1">Monday</option>
              <option value="2">Tuesday</option>
              <option value="3">Wednesday</option>
              <option value="4">Thursday</option>
              <option value="5">Friday</option>
              <option value="6">Saturday</option>
            </select>
          </div>
          <div class="col-md-6 col-12 mb-4">
            <label class="form-label">Work start at</label>
            <input wire:model='start_work_hour' type="text" class="form-control @error('start_work_hour') is-invalid @enderror" placeholder="HH:MM" id="start_work_hour" autocomplete="off" />
          </div>
          <div class="col-md-6 col-12 mb-4">
            <label class="form-label">Work end at</label>
            <input wire:model='end_work_hour' type="text" class="form-control @error('end_work_hour') is-invalid @enderror" placeholder="HH:MM" id="end_work_hour" autocomplete="off" />
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
      const start_work_hour = document.querySelector('#start_work_hour');
      if (start_work_hour) {
        start_work_hour.flatpickr({
          enableTime: true,
          noCalendar: true,
          time_24hr: true,
          defaultHour: 9
        });
      }

      const end_work_hour = document.querySelector('#end_work_hour');
      if (end_work_hour) {
        end_work_hour.flatpickr({
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
