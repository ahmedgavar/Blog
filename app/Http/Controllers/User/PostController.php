<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Post;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Traits\BlogTrait;
use Illuminate\Support\Facades\Storage;

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
        //
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
