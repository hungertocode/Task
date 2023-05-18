<div class="modal" id="delete_modal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete Warning</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" id="delete_form" method="POST">
        @csrf
      <div class="modal-body">
        <p>Are you sure you want to Delete?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-gray" id="save" >Delete</button>
      </div>
    </form>
    </div>
  </div>
</div>