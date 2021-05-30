<?php

namespace App\Traits;

trait Image
{
    public function uploadImage($image, $file_name, $imageName)
    {
        $image->move(public_path('images/' . $file_name), $imageName);
    }

    public function getImag($image,$file_name)
    {
        return $image ? asset('public/images/'.$file_name.'/' . $image->image ) : asset('public/images/test.png');
    }
}
