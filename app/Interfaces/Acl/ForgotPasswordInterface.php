<?php

namespace App\Interfaces\Acl;

interface ForgotPasswordInterface{
    public function changePassword($request,$id);
    public function searchUser($email);
    public function code($id);
    public function searchCode($id);
    public function checkCode($request);
}
