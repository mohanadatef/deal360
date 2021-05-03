<?php

namespace App\Traits;

trait Service
{
    public function change_status($datas)
    {
        if ($datas->status == 1) {
            $datas->status = '0';
        } elseif ($datas->status == 0) {
            $datas->status = '1';
        }
        $datas->update();
    }

    public function image_upload($image, $file_name, $imageName)
    {
        $image->move(public_path('images/' . $file_name), $imageName);
    }

    public function image_get($image,$file_name)
    {
        return $image ? asset('public/images/'.$file_name.'/' . $image->image ) : asset('public/images/test.png');
    }
}
