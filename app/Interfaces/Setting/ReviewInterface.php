<?php

namespace App\Interfaces\Setting;

interface ReviewInterface
{
    public function getData();
    public function storeData($request);
    public function showData($id);
    public function updateStatusData($id);
    public function deleteData($id);
    public function getDataDelete();
    public function restoreData($id);
    public function removeData($id);
}
