<?php

namespace App\Http\Traits;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;


trait BlogTrait
{
    public function send_notification_to_admin($receiver, $notification_class)
    {

        Notification::send($receiver, $notification_class);
    }

    /*
        first parameter is post id
        second parameter is title from request
        */

    public function update_with_images($request, $model, $old_path, $title)
    {



        //  1 case : if title not changes

        DB::transaction(function () use ($request, $model, $title, $old_path) {
            // 1 delete images from database
            $model->images()->delete();
            // 2 delete folder images
            $this->removeFolder($old_path);
            // 3 update post table
            $model->update([
                'content' => $request->content_edit,
                'title' => $title,

            ]);

            foreach ($request->images_for_edit as $image) {
                // 4 update images table
                // new folder name

                $new_slug = Str::of($request->title_edit)->slug('-');

                $file_name = rand(1, 500);
                $file_extension = $image->extension();
                $model->images()->create(
                    [
                        'name' => $file_name,
                        'extension' => $file_extension,

                    ]
                );
                // 5 update folder of images
                Storage::disk('post_images')->putFileAs($new_slug, $image, $file_name . '.' . $file_extension);
            }
        });
    }


    public function update_withOut_images($request, $model, $old_path, $title)
    {

        $new_slug = Str::of($request->title_edit)->slug('-');

        if (!$request->has('images_for_edit') && $request->title_edit != $model->title) {
            DB::transaction(function () use ($request, $model, $title, $old_path) {
                //  1update post table
                $model->update([
                    'content' => $request->content_edit,
                    'title' => $title,

                ]);
                //  2 move images into another folder

                $new_slug = Str::of($request->title_edit)->slug('-');

                $new_path = public_path() . '/assets/post_images/' . $new_slug;
                $this->rename_folder($old_path, $new_path);
            });
        } else if (!$request->has('images_for_edit') && $request->title_edit == $model->title) {
            $model->update([
                'content' => $request->content_edit,

            ]);
        }
    }

    /*

    1 parameter old full path
    2 parameter new full path
*/

    public function rename_folder($old_path, $new_path)
    {

        File::moveDirectory($old_path, $new_path);
        File::deleteDirectory($old_path);
    }


    /*
    first parameter is the disk in file system
    second parameter is the path in disk
*/
    public function removeFolder($folderName)
    {

        if (File::exists($folderName)) {
            File::deleteDirectory($folderName);
        }
    }
}
