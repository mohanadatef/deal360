<?php

namespace App\Traits;

trait Image
{
    public function uploadImage($image, $file_name, $imageName)
    {
        $image->move(public_path('images/' . $file_name), $imageName);
    }

    public function getImag($image, $file_name)
    {
        return $image ? public_path('images/' . $file_name . '/' . $image->image) : false;
    }

    public function uploadImageWordpress($image, $file_name)
    {
        executionTime();
        $contents = file_get_contents($image);
        $name = time() . '_' . substr($image, strrpos($image, '/') + 1);
        $patch = public_path('images/' . $file_name . '/');
        $file = $patch . $name;
        if (!\File::isDirectory($patch)) {
            \File::makeDirectory($patch, 0777, true, true);
        }
        file_put_contents($file, $contents);
        executionTime();
        return $name;
    }

    public function deleteImage($image, $file_name)
    {
        $image_path=$this->getImag($image, $file_name);
        if (\File::exists($image_path)) {
            \File::delete($image_path);
        }
    }
}
