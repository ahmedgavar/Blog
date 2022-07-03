


<!-- recent section start -->
<div class="about_section layout_padding show_all_posts">
  <div class="container">

    @forelse ($posts as $post)
     <div class="row">
        <div class="col-lg-8 col-sm-12">
          {{-- show images of posts --}}
          @include('posts.show_posts_images')
          {{-- End show images of posts --}}


           <p class="post_text">Post At : {{$post->created_at->diffForHumans()}}</p>
           <h2 class="most_text">{{ $post->title }} </h2>

            <div style="   word-wrap: break-word;  width: 70%; ">

                {{ $post->content }}

            </div>

           <div class="social_icon_main">
              <div class="social_icon">
                 <ul>
                      <li> <span class="badge bg-info">{{$post->user->name}} </li>
                      <li>
                          <span class="show_comment_form" id="show_comment_form{{ $post->id }}"
                              style="cursor: pointer;">comment
                          </span>

                      </li>


                      <li>
                          <span id="show_comment_{{ $post->id }}" class="show_comments"
                              style="cursor: pointer;">{{ $post->comments_count }}Comments
                          </span>
                      </li>
                      <li>

                          <button

                              data-bs-toggle="modal"
                              class="btn btn-primary btn-sm crud_action"
                              data-bs-target="#editPostModal"
                              data-id="{{$post->id}}"
                              data-title="{{$post->title}}"
                              data-content="{{$post->content}}"

                              >Edit
                          </button>
                      </li>
                      <li>
                          <button
                              class="btn btn-danger btn-sm deleteBtn crud_action"
                              style="margin: 0px;"
                              data-bs-toggle="modal"

                              data-bs-target="#deleteModal"
                              data-delete_id="{{$post->id}}"


                              >Delete
                          </button>
                      </li>



                    <li><a href="#"><img src="{{ asset('images/twitter-icon.png') }}"></a></li>
                    <li><a href="#"><img src="images/twitter-icon.png"></a></li>
                    <li><a href="#"><img src="images/instagram-icon.png"></a></li>
                 </ul>
                 {{-- like button --}}

              </div>
              <br>
              <div>
                <span style="left: 50px">
                    <like-component
                    @auth

                    :reactable_type=`posts/{{$post->id}}`
                    :summary='@json($post->reactionSummary())'
                    :reacted='@json($post->reacted())'

               @endauth

               >

               </like-component>

                </span>

              </div>
              <div class="read_bt"><a href="#">Read More</a></div>
           </div>
        </div>


     </div>
  @empty
  no posts
  @endforelse

</div>
</div>



<!-- recent section end -->

