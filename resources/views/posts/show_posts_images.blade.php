@foreach ($post->images as $image )
<div class="about_img">

    <img src="{{asset('assets/post_images/'.Str::of($post->title)->slug('-').'/'.$image->name.'.'.$image->extension)}} " alt=" no images"  height="200px" style="margin:20px 0px 10px 70px">

</div>

@endforeach

