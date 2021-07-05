<?php

namespace App\Interfaces\Setting;

interface LabelInterface
{
    public function getData();
    public function storeData($request);
    public function showData($id);
    public function updateData($request, $id);
}
