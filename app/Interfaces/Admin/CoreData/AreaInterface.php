<?php

namespace App\Interfaces\Admin\CoreData;

interface AreaInterface
{

    public function getAllData();
    public function storeData($request);
    public function showData($id);
    public function updateData($request, $id);
    public function updateStatusData($id);
    public function deleteData($id);
    public function getAllDataDelete();
    public function restoreData($id);
    public function removeData($id);
    public function listData($country,$city);
}
