<?php

namespace App\Interfaces\Acl;

interface FavouriteInterface
{
    public function getProperty($user);
    public function getUser($property);
    public function showData($user,$property);
    public function StoreData($request);
    public function DeleteData($user,$property);
}
