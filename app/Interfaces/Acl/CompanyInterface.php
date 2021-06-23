<?php

namespace App\Interfaces\Acl;

interface CompanyInterface
{
    public function listData($request);
    public function getData($request);
    public function showData($id,$role_id);
}
