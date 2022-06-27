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
        //


        $time=Carbon::now();
        // name of image using slug
        $title=trim($request->title);
        $slug=Str::of($request->title)->slug('-');
        // folder of images if not existed
        //$new_path=date_format($time, 'd').'//'.date_format($time, 'm').'//'.date_format($time, 'Y');
        $new_path = date('Y-m-d').'/'.$slug;
        if ($request->hasFile('images'))

        {

            // to ensure saving data in 2 tables
            DB::transaction(function () use ($slug,$title, $request,$new_path)

            {


                // 1 save table of posts
                $post_data = Arr::except($request->all(), ['images','title']);
                $post_store=Post::create
                (
                 // user id added in boot function in post model when creating

                    $post_data+['title'=>$title]

                );

                // 2 save table of post_images


                foreach ($request->images as $image)
                {
                    // A_ path of image folders according post date and name
                    // B_ images names
                    $file_name = rand(1, 500);
                    $file_extension=$image->extension();

                    // C_ store original image
                    Storage::disk('post_images')->putFileAs($new_path, $image, $file_name.'.'.$file_extension);


                    // 3 store images for post with relation

                    $post_images=$post_store->images()->create(
                        [
                            'path'=>$new_path,

                            'name'=>$file_name,

                            'extension'=>$file_extension,

                        ]

                    );
                }

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
