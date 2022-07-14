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
use App\Models\User;
use App\Notifications\NewPostNotification;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Notification;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    use BlogTrait;
    public function toggle_react(Post $post, Request $request)
    {

        $post->toggleReaction($request->reaction);
    }

    public function index()
    {
        //
        $posts = Post::with(['images', 'user'])->orderBy('id', 'desc')->paginate(5);


        return view('posts.index', ['posts' => $posts]);
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

    public function store(StorePostRequest $request, Post $post)
    {
        $total_images = count($request->file('images'));

        $post_store = Post::create(
            ['content' => $request->content]
        );

        $newImages = $request->file('images');

        foreach ($newImages as $img) {
            $post_store->storeImage($img);
        }


        $status = 200;
        $message = "Your post has created successfully with " . $total_images . ' image';

        return response()->json(
            [
                'status' => $status,
                'message' => $message
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
    public function update(UpdatePostRequest $request, $id)
    {

        $post = Post::find(request('postId'));


        if ($request->hasFile('images_for_edit')) {
            // delete images from db
            $post->deleteImage();
            // delete from folder
            foreach ($post->images as $old_image) {
                $post->deleteImageFromFolder($old_image->name);
            }
            // save new images

            $newImages = $request->file('images_for_edit');

            foreach ($newImages as $img) {
                $post->storeImage($img);
            }
        }



        return response()->json(
            [
                'status' => 200,
                'message' => 'Your post has updated successfully with out new image'
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // first delete folder of post
        $slug = Str::of($post->title)->slug('-');

        $public_path = public_path() . '/assets/post_images/';
        $folder_path = $public_path . $slug;

        $this->removeFolder($folder_path);
        // second delete post from database

        $post->delete();
        // third message to user

        $my_response = response()->json(
            [
                'status' => 200,
                'message' => "Post deleted successfully"
            ]
        );
        return $my_response;
    }
}
