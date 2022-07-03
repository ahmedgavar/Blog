
<!-- Modal -->
<div class="modal fade my_large_model" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Post</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

          <form class="delete-form">
          @method('DELETE')
          @csrf
             <div class="modal-body">
                <h5> Are you sure you want to delete this post . If you delete this post all comments will be deleted</h5>

                <input type="hidden" name="delete_name" id="delete_name">

              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Delete</button>
              </div>
          </form>


      </div>
    </div>
  </div>
