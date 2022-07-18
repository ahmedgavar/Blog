<?php

namespace App\Http\Traits;

use App\Models\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


trait PhotoTrait
{

    // more images
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
    // one image
    public function storeImage($image)
    {
        $fileName = 'posts.' . time() . '.' . $image->getClientOriginalExtension();

        $this->images()->create(['name' => $fileName]);
        $image->storeAs('assets/posts/', $fileName, ['disk' => 'public']);

        return $fileName;
    }

    // update images in database
    public function updateImages($new_images)
    {
        $this->deleteImages();
        foreach ($new_images as $image) {
            # code...
            $this->storeImage($image);
        }
    }
    // one image
    public function deleteImages()
    {
        if ($this->images) {
            $this->images()->delete();
        }
    }
    public function deleteImageFromFolder($old_image)
    {
        $path = public_path('storage/assets/posts/' . $old_image);


        if (file_exists($path)) {
            unlink($path);
        } else {
            dd('File does not exists.' . $path);
        }
    }
}
