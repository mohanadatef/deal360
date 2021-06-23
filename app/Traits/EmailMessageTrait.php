<?php

namespace App\Traits;


trait EmailMessageTrait
{
    public function approveEmail()
    {
        return ['title' => 'Mail for verify', 'body' => 'Mail for verify',];
    }

    public function passwordEmail($code)
    {
        return ['title' => 'Mail for verify', 'body' => $code,];
    }
}
