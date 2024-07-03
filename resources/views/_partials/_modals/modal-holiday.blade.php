@push('custom-css')
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}" />
@endpush

<div wire:ignore.self class="modal fade" id="holidayModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-simple">
    <div class="modal-content p-0 p-md-5">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-4">
          <h3 class="mb-2"></h3>
          <h3 class="mb-2">{{ $isEdit ? __('Update Holiday') : __('New Holiday') }}</h3>
          <p class="text-muted">{{ __('Please fill out the following information') }}</p>
        </div>
        <form wire:submit="submitHoliday" class="row g-3">
          <div class="col-12 mb-4">
            <label class="form-label w-100">{{ __('Name') }}</label>
            <input wire:model='name' class="form-control @error('name') is-invalid @enderror" type="text" />
          </div>
          <div wire:ignore class="col-md-12">
            <label class="form-label">{{ __('Centers') }}</label>
            <select wire:model="centers" id="selectCenters" class="select2 form-select form-select-lg @error('centers') is-invalid @enderror" data-allow-clear="true" multiple>
                @foreach($centers as $centerId => $centerName)
                    <option value="{{ $centerId }}">{{ $centerName }}</option>
                @endforeach
            </select>
          </div>
          <div class="col-md-6 col-12 mb-4">
            <label class="form-label">{{ __('From Date') }}</label>
            <input wire:model='fromDate' type="text" class="form-control flatpickr-input active @error('fromDate') is-invalid @enderror" placeholder="YYYY/MM/DD" id="flatpickr-From-Date" readonly="readonly"/>
          </div>
          <div class="col-md-6 col-12 mb-4">
            <label class="form-label">{{ __('To Date') }}</label>
            <input wire:model='toDate' type="text" class="form-control flatpickr-input active @error('toDate') is-invalid @enderror" placeholder="YYYY/MM/DD" id="flatpickr-To-Date" readonly="readonly"/>
          </div>

          <div class="col-12 mb-4">
            <label class="form-label w-100">{{ __('Note') }}</label>
            <input wire:model='note' class="form-control @error('note') is-invalid @enderror" type="text" />
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

    // $('#selectCenters').select2();
    $('#selectCenters').on('change', function (e) {
        var data = $('#selectCenters').select2("val");
    @this.set('centers', data);
    });
  });
</script>

<script>
  $(document).ready(function () {
    const flatpickrFromDate = document.querySelector('#flatpickr-From-Date');
    if (typeof flatpickrFromDate != undefined) {
      flatpickrFromDate.flatpickr({
        dateFormat: "Y-m-d",
      });
    }
  });

  $(document).ready(function () {
    const flatpickrToDate = document.querySelector('#flatpickr-To-Date');
    if (typeof flatpickrToDate != undefined) {
      flatpickrToDate.flatpickr({
        dateFormat: "Y-m-d",
      });
    }
  });
</script>

@endpush
