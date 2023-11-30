<div class="offcanvas offcanvas-end event-sidebar" tabindex="-1" id="addRecordSidebar" aria-labelledby="addRecordSidebarLabel">

  <div class="offcanvas-header my-1">
    <h5 class="offcanvas-title">Add New Record</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>

  <div class="offcanvas-body pt-0">
    <form class="row pt-0">
      <div class="mb-3">
        <label class="form-label">Date</label>
        <input type="text" class="form-control"/>
      </div>
      <div class="col-md-6 col-12 mb-3">
        <label class="form-label">Start At</label>
        <input type="text" class="form-control"/>
      </div>
      <div class="col-md-6 col-12 mb-3">
        <label class="form-label">End At</label>
        <input type="text" class="form-control"/>
      </div>

      <div class="mb-3 d-flex justify-content-sm-between justify-content-start my-4">
        <div>
          <button type="submit" class="btn btn-primary btn-add-event me-sm-3 me-1">Add</button>
          <button type="reset" class="btn btn-label-secondary btn-cancel me-sm-0 me-1" data-bs-dismiss="offcanvas">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>
