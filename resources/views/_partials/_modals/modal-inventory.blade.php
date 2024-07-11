@push('custom-css')
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}" />

  <style>
      input::-webkit-outer-spin-button,
      input::-webkit-inner-spin-button {
          -webkit-appearance: none;
          margin: 0;
      }

      input[type="number"] {
          -moz-appearance: textfield;
      }
  </style>
@endpush

<div wire:ignore.self class="modal fade" id="assetModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-simple">
    <div class="modal-content p-0 p-md-5">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-4">
          <h3 class="mb-2"></h3>
          <h3 class="mb-2">{{ $isEdit ? __('Update Asset') : __('New Asset') }}</h3>
          <p class="text-muted">{{ __('Please fill out the following information') }}</p>
        </div>
        <form wire:submit="submitAsset" class="row g-3">
          <div class="col-md-2 col-12">
            <label class="form-label w-100">{{ __('ID') }}</label>
            <input wire:model='assetId' class="form-control @error('assetId') is-invalid @enderror" type="number" />
          </div>
          <div class="col-md-2 col-12">
            <label class="form-label w-100">{{ __('Old ID') }}</label>
            <input wire:model='oldId' class="form-control @error('oldId') is-invalid @enderror" type="number" />
          </div>
          <div class="col-md-2 col-12">
            <label class="form-label w-100">{{ __('Serial Number') }}</label>
            <input wire:model='serialNumber' class="form-control @error('serialNumber') is-invalid @enderror" type="text" />
          </div>
          <div class="col-md-2 col-12">
            <label class="form-label w-100">{{ __('Status') }}</label>
            <select wire:model='status' class="form-control @error('status') is-invalid @enderror" data-allow-clear="true">
              <option value=""></option>
              <option value="Good">{{ __('Good') }}</option>
              <option value="Fine">{{ __('Fine') }}</option>
              <option value="Bad">{{ __('Bad') }}</option>
              <option value="Damaged">{{ __('Damaged') }}</option>
            </select>
          </div>
          <div class="col-md-2 col-12">
            <label class="form-label w-100">{{ __('In Service') }}</label>
            <select wire:model='inService'  class="form-control @error('inService') is-invalid @enderror" data-allow-clear="true">
              <option value=""></option>
              <option value="1">{{ __('Active') }}</option>
              <option value="0">{{ __('Inactive') }}</option>
            </select>
          </div>
          <div class="col-md-2 col-12">
            <label class="form-label w-100">{{ __('Founded By') }}</label>
            <select wire:model='fundedBy' class="form-control @error('fundedBy') is-invalid @enderror" data-allow-clear="true">
              <option value=""></option>
              <option value="By Namaa">{{ __('By Namaa') }}</option>
              <option value="By UNHCR">{{ __('By UNHCR') }}</option>
              <option value="By Taalouf">{{ __('By Taalouf') }}</option>
            </select>
          </div>
          <div class="col-md-2 col-12">
            <label class="form-label w-100">{{ __('Real Price') }}</label>
            <input wire:model='realPrice' class="form-control @error('realPrice') is-invalid @enderror" type="number" />
          </div>
          <div class="col-md-2 col-12">
            <label class="form-label w-100">{{ __('Expected Price') }}</label>
            <input wire:model='expectedPrice' class="form-control @error('expectedPrice') is-invalid @enderror" type="number" />
          </div>
          <div class="col-md-2 col-12">
            <label class="form-label w-100">{{ __('Acquisition Type') }}</label>
            <select wire:model='acquisitionType' class="form-control @error('acquisitionType') is-invalid @enderror" data-allow-clear="true">
              <option value=""></option>
              <option value="Transferred">{{ __('Transferred') }}</option>
              <option value="Directed">{{ __('Directed') }}</option>
              <option value="Founded">{{ __('Founded') }}</option>
            </select>
          </div>
          <div class="col-md-2 col-12">
            <label class="form-label w-100">{{ __('Acquisition Date') }}</label>
            <input wire:model='acquisitionDate' class="form-control flatpickr-input active @error('acquisitionDate') is-invalid @enderror" type="text" id="flatpickr-Acquisition-Date" readonly="readonly"/>
          </div>
          <div class="col-md-4 col-12">
            <label class="form-label w-100">{{ __('Description') }}</label>
            <input wire:model='description' class="form-control @error('description') is-invalid @enderror" type="text" />
          </div>
          <div class="col-md-12 col-12 mb-4">
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
  <script src="{{asset('assets/vendor/libs/flatpickr/flatpickr.js')}}"></script>

  <script>
    $(document).ready(function () {
      const flatpickrAcquisitionDate = document.querySelector('#flatpickr-Acquisition-Date');
      if (typeof flatpickrAcquisitionDate != undefined) {
        flatpickrAcquisitionDate.flatpickr({
          dateFormat: "Y-m-d",
        });
      }
    });
  </script>
@endpush
