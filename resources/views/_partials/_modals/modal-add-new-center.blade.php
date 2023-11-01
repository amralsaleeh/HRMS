@push('custom-css')
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
@endpush

<div wire:ignore class="modal fade" id="addNewCenterModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
    <div class="modal-content p-3 p-md-5">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-4">
          <h3 class="mb-2">Add New Center</h3>
          <p class="text-muted">Add new center to the structure</p>
        </div>
        <form wire:submit="addNewCenter" id="addNewCenterForm" class="row g-3">
          <div class="col-12">
            <label class="form-label w-100" for="modalAddCard">Center name</label>
            <div class="input-group input-group-merge">
              <input wire:model="name" id="modalAddCard" name="modalAddCard" class="form-control credit-card-mask" type="text" aria-describedby="modalAddCard2" />
              <span class="input-group-text cursor-pointer p-1" id="modalAddCard2"><span class="card-type"></span></span>
            </div>
          </div>
          <div class="col-md-12 mb-4">
            <label for="select2Basic" class="form-label">Supervisor</label>
            <select wire:model="supervisor" id="select2Basic" class="select2 form-select form-select-lg" data-allow-clear="true">
              <option value="AK">Alaska</option>
              <option value="HI">Hawaii</option>
              <option value="CA">California</option>
              <option value="NV">Nevada</option>
            </select>
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
  <script src="{{asset('assets/js/forms-selects.js')}}"></script>

  <script>
    $(document).ready(function () {
        // $('#select2Basic').select2();
        $('#select2Basic').on('change', function (e) {
            var data = $('#select2Basic').select2("val");
        @this.set('supervisor', data);
        });
    });
  </script>
@endpush
