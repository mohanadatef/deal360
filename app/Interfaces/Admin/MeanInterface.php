<?php

namespace App\Interfaces\Admin;

interface MeanInterface
{
    public function getData();
    public function storeData($request);
    public function showData($id);
    public function updateData($request, $id);
    public function updateStatusData($id);
    public function deleteData($id);
    public function getDataDelete();
    public function restoreData($id);
    public function removeData($id);
    public function listData();
}
