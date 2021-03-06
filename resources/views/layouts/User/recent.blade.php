@forelse ($posts as $post)

      <!-- recent section start -->
      <div class="about_section layout_padding">
        <div class="container">
           <div class="row">
              <div class="col-lg-8 col-sm-12">
                @include('layouts.show_posts')
                 

                 <p class="post_text">Post At : {{$post->created_at->diffForHumans()}}</p>
                 <h2 class="most_text">{{ $post->title }} </h2>
                 <p class="lorem_text">{{ $post->content }}</p>
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



                          <li><a href="#"><img src="images/fb-icon.png"></a></li>
                          <li><a href="#"><img src="images/twitter-icon.png"></a></li>
                          <li><a href="#"><img src="images/instagram-icon.png"></a></li>
                       </ul>
                    </div>
                    <div class="read_bt"><a href="#">Read More</a></div>
                 </div>
              </div>
              <div class="col-lg-4 col-sm-12">
                <div class="image_5"><img src="images/img-5.png"></div>
                <h1 class="about_taital">About Us</h1>
                <p class="about_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis</p>
                <div class="read_bt_1"><a href="#">Read More</a></div>
             </div>

           </div>
        </div>
     </div>
     <!-- recent section end -->
@empty
no posts

@endforelse
