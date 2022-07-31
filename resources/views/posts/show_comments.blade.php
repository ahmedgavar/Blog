{{-- show success message --}}
    {{-- success message --}}

    <div
    class="alert alert-success visually-hidden"
    id="success_message{{$post->id}}"
    style="width: 70%;margin-left: 150px"
    >
        Comment saved successfully
    </div>

    {{-- End success message --}}


{{-- comments show and add new --}}
        {{-- show --}}

        <h3 style="color: red;">Comments</h3>

        <div id="show_comments{{ $post->id }}">

            @forelse ( $post->comments as $comment )
        <div>
            {!! $comment->comment  !!}.
        </div>
        @empty
        <div class="bg-warning p-4" id="no_comment_div">
            No comments yet for this post
        </div>

        @endforelse

        </div>
        {{-- End show --}}

{{-- start add form --}}
        <form
        class="add_comment"
        data-postId="{{$post->id}}"
        data-commentId={{ $comments_count }}
        >
        @csrf
        <div class="row">
          <div class="col-12">
              <div class="form-group">
                  <label for="new_comment" style="margin: auto"> New comment</label>
                  <textarea class="form-control"
                        id="comment_input{{ $post->id }}"
                        rows="6"
                        cols="5"
                        style="width: 600px"
                        class="tinymce form-control"
                        name="comment">

                  </textarea>
                  <input type="hidden" name="post_id" value="{{ $post->id }}">
                  <div id="comment_error{{$post->id}}" class="text-danger"></div>

                </div>
          </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <button
                        type="submit"
                        id ="save_comment"
                        value="save"
                        class="btn btn-primary btn-sm"
                        style="margin: 40px 20px 0 300px "

                        >

                        save

                    </button>
                </div>
            </div>
        </div>
        </form>

        {{--End  comments show and add new --}}
        </div>
