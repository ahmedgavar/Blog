<?php
namespace App\Http\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

trait BlogTrait
 {
    /*
              pass parameters
      1_  request->images
      2_ folder that saved in file system public
      3_ subfolder (folder foreach post for example depends on slug)
      4_ related model for example post images one to many

    */
    public function store_multi_image( $images,$folder,$subfolder,$model)
    {

        foreach ($images as $image)
        {
            // A_ path of image folders according post date and name
            // B_ images names
            $new_path = date('Y-m-d').'/'.$subfolder;

            $file_name = rand(1, 500);
            $file_extension=$image->extension();

            // C_ store original image
            Storage::disk($folder)->putFileAs($new_path, $image, $file_name.'.'.$file_extension);


            // 3 store images for post with relation

            $post_images=$model->images()->create(
                [
                    'path'=>$new_path,

                    'name'=>$file_name,

                    'extension'=>$file_extension,

                ]

            );
        }




    }
}
