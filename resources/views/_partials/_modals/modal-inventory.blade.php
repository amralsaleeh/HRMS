@push('custom-css')

@endpush

<div wire:ignore.self class="modal fade" id="assetModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog  modal-simple">
    <div class="modal-content p-3 p-md-5">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-4">
          <h3 class="mb-2"></h3>
          <h3 class="mb-2">{{ $isEdit ? 'Update Asset' : 'New Asset' }}</h3>
          <p class="text-muted">Please fill out the following information</p>
        </div>
        <form wire:submit="submitAsset" class="row g-3">
          {{-- {{ $assetId }} --}}
          <div class="col-md-6 col-12 mb-4">
            <label class="form-label w-100">ID</label>
            <input wire:model='assetId' class="form-control @error('assetId') is-invalid @enderror" type="number" />
          </div>

          <div class="col-md-6 col-12 mb-4">
            <label class="form-label w-100">Old ID</label>
            <input wire:model='oldId' class="form-control @error('oldId') is-invalid @enderror" type="number" />
          </div>


          <div class="col-md-6 col-12 mb-4">
            <label class="form-label w-100">Serial Number</label>
            <input wire:model='serialNumber' class="form-control @error('serialNumber') is-invalid @enderror" type="text" />
          </div>


          <div class="col-md-6 col-12 mb-4">
            <label class="form-label w-100">Description</label>
            <input wire:model='description' class="form-control @error('description') is-invalid @enderror" type="text" />
          </div>

          <div class="col-md-6 col-12 mb-4">

            <label class="form-label w-100">Status</label>
            <select wire:model='status' class="form-control @error('status') is-invalid @enderror" data-allow-clear="true">
              <option value="" selected>Select value</option>
              <option value="Good">Good</option>
              <option value="Fine">Fine</option>
              <option value="Bad">Bad</option>
              <option value="Damaged">Damaged</option>
            </select>
          </div>

              <div class="col-md-6 col-12 mb-4">
            <label class="form-label w-100">In Service</label>
            <select wire:model='inService'  class="form-control @error('inService') is-invalid @enderror" data-allow-clear="true">
              <option value="" selected>Select value</option>
              <option value="1">active</option>
              <option value="0">disactive</option>
            </select>
          </div>

          <div class="col-md-6 col-12 mb-4">
            <label class="form-label w-100">Real Price</label>
            <input wire:model='realPrice' class="form-control @error('realPrice') is-invalid @enderror" type="number" />
          </div>


          <div class="col-md-6 col-12 mb-4">
            <label class="form-label w-100">Expected Price</label>
            <input wire:model='expectedPrice' class="form-control @error('expectedPrice') is-invalid @enderror" type="number" />
          </div>

          <div class="col-md-6 col-12 mb-4">
            <label class="form-label w-100">Acquisition Date</label>
            <input wire:model='acquisitionDate' class="form-control @error('acquisitionDate') is-invalid @enderror" type="date" />
          </div>

          <div class="col-md-6 col-12 mb-4">
            <label class="form-label w-100">Acquisition Type</label>
            <select wire:model='acquisitionType' class="form-control @error('acquisitionType') is-invalid @enderror" data-allow-clear="true">
              <option value="" selected>Select value</option>
              <option value="Transferred">Transferred</option>
              <option value="Directed">Directed</option>
              <option value="Founded">Founded</option>
            </select>
          </div>

          <div class="col-md-6 col-12 mb-4">
            <label class="form-label w-100">Founded By </label>
            <select wire:model='fundedBy' class="form-control @error('fundedBy') is-invalid @enderror" data-allow-clear="true">
              <option value="" selected >Select value</option>
              <option value="By Namaa">By Namaa</option>
              <option value="By UNHCR">By UNHCR</option>
              <option value="By Taalouf">By Taalouf</option>

            </select>
          </div>

          <div class="col-md-6 col-12 mb-4">
            <label class="form-label w-100">Note</label>
            <input wire:model='note' class="form-control @error('note') is-invalid @enderror" type="text" />
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

@endpush
