<?php

namespace App\Http\Traits;

use App\Models\Image;


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
    public function updateImage($image)
    {
        if ($this->images) {

            $this->images->delete();
        }
        $this->storeImage($image);
    }
    // one image
    public function deleteImage()
    {
        if ($this->images) {
            $this->images->delete();
        }
    }
}
