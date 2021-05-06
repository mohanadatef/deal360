<?php

namespace App\Traits;

trait Service
{
    public function changeStatus($data)
    {
        if ($data->status) {
            $data->status = 0;
        } else{
            $data->status = 1;
        }
        $data->update();
    }

    public function uploadImage($image, $file_name, $imageName)
    {
        $image->move(public_path('images/' . $file_name), $imageName);
    }

    public function getImag($image,$file_name)
    {
        return $image ? asset('public/images/'.$file_name.'/' . $image->image ) : asset('public/images/test.png');
    }
}
