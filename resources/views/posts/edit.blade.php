<!-- Modal -->

<div class="modal fade" id="editPostModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-backdrop="false">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel" style="color: red;margin: auto">Edit Post </h5>

          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

            <!-- modal content -->

              <form  enctype="multipart/form-data"  id="post_form_update">

                  @csrf
                  @method('PATCH')

                      <div class="modal-body my_large_model">

                          <div class="input-group mb-3 form_div">
                              {{-- post id --}}
                              <input type="hidden" name="postId" id="postId">

                              <h4>Title</h4>
                              <input type="text" name="title_edit" id="title_edit"  style="height: 50px;">
                          <div>
                        <p id="title_edit_error" class="error text-danger"></p>



                          <div class="input-group mb-3 form_div">
                              <h4> Content</h4>
                              <textarea name="content_edit" id="content_edit" style="height: 100px;" ></textarea>
                          </div>
                        <p id="content_edit_error" class="error text-danger"></p>



                          <!-- End show post images -->


                          <div class="input-group mb-3 form_div">
                              <h4>upload image:</h4>
                              <input type="file" name="images_for_edit[]" id="images_edit" multiple  accept="image/*" >


                          </div>


                          <p id="images_edit_error" class="error text-danger"></p>


                          {{-- div for edit images --}}
                          <div class="imgEditPreview">
                              {{-- show images here --}}
                          </div>

                      </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" id="update_post_btn">Save</button>
          </div>
      </form>

      </div>
    </div>
  </div>








