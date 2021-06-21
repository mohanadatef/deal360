<?php

namespace App\Repositories\Acl;

use App\Interfaces\Acl\ForgotPasswordInterface;
use App\Models\Acl\User;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordRepository implements ForgotPasswordInterface
{
    protected $data;
    protected $userRepository;

    public function __construct(User $User,UserRepository $UserRepository)
    {
        $this->data = $User;
        $this->userRepository = $UserRepository;
    }

    public function updateData($request,$id)
    {
        $data = $this->userRepository->showData($id);
        $data['password'] = Hash::make($request->password);
        $data->update($data->toArray());
    }
}
