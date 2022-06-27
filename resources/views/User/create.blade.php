
<!-- Modal -->
<div class="modal fade" id="createPostModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-backdrop="false" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
          <div class="modal-header">
              <h3 class="modal-title" style="color: red;margin: auto">Create Post </h3>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <form
              enctype="multipart/form-data"

              id="post_form">

              @csrf
                  <div class="modal-body my_large_model">

                      <!-- modal content -->

                      <div class="input-group mb-3 form_div">
                          <h4>Title</h4>
                          <input type="text"
                             name="title"
                             id="title"
                             value="{{ old('title') }}"
                             style="height: 50px;"
                             >

                      <div>


                        <p id="title_error" class="error text-danger"></p>





                          <!-- post content -->
                      <div class="input-group mb-3 form_div">
                          <h4> Content</h4>
                          <textarea
                                name="content"
                                style="height: 100px;"
                                id="content">

                                {{ old('content') }}
                         </textarea>
                      </div>


                        <p id="content_error" class="error text-danger"></p>



                          <!-- post image -->

                      <div class="input-group mb-3 form_div">
                          <h4>upload image:</h4>
                          <input
                                type="file"
                                name="images[]"
                                id="images"  multiple accept="image/*">


                      </div>


                      <p id="images_error" class="error text-danger"></p>



                      <div class="imgPreview"></div>


                  </div>


                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" id="save_post" class="btn btn-primary">Save</button>
                  </div>
          </form>

      </div>
    </div>
  </div>



