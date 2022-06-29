<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Post;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Traits\BlogTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     use BlogTrait;
    public function index()
    {
        //
        $posts=Post::withCount(['images'])->orderBy('id','desc')->paginate(5);

        return view('posts.index',['posts'=>$posts]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(StorePostRequest $request)
    {

        // name of image using slug
        $title=trim($request->title);
        $slug=Str::of($request->title)->slug('-');




            // to ensure saving data in 2 tables
        DB::transaction(function () use ($slug,$title, $request)

        {


            // 1 save table of posts
            $post_data = Arr::except($request->all(), ['images','title']);
            $post_store=Post::create
            (
                // user id added in boot function in post model when creating
                $post_data+['title'=>$title]

            );

            // 2 save  images of  post using trait
            $this->store_multi_image($request->images,'post_images',$slug,$post_store);

            $total_images = count($request->file('images'));

            return response()->json(
                [
                    'status'=>200,
                    'message'=>"Your post has created successfully with ".$total_images.' image'
                ]
            );


        });

           return response()->json(
            [
                'status'=>422,
                    'message'=>"Your post cannot be saved "

            ]
            );

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $post=Post::find($request->postId);
        if ($post)
        {
            $old_slug=Str::of($post->title)->slug('-');
            $old_path=public_path().'/assets/post_images/'.$old_slug;

            $new_slug=Str::of($request->title_edit)->slug('-');
            $new_path=public_path().'/assets/post_images/'.$new_slug;

            $title=trim($request->title_edit);

            if ($request->has('images_for_edit')) {
                $this->update_with_images($request, $post, $old_path, $title);
                $total_images = count($request->file('images_for_edit'));

            } else {
                $this->update_withOut_images($request, $post, $old_path, $title);
            }

            return response()->json(
                [
                'status'=>200,
                'message'=>"Your post has updated successfully with ".$total_images.' image'
            ]
            );
        }





    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
