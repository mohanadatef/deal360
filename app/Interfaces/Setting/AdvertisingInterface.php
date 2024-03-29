<?php

namespace App\Interfaces\Setting;

interface AdvertisingInterface
{
    public function getData($request);
    public function storeData($request);
    public function showData($id);
    public function updateData($request, $id);
    public function updateStatusData($id);
    public function updateApproveData($id);
    public function deleteData($id);
    public function getDataDelete();
    public function restoreData($id);
    public function removeData($id);
}
