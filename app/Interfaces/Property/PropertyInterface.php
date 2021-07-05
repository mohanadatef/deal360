<?php

namespace App\Interfaces\Property;

interface PropertyInterface
{
    public function getData($request);
    public function showData($id);
    public function sameData($data);
}
