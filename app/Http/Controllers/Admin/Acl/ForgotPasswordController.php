<?php

namespace App\Http\Controllers\Admin\Acl;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Acl\ForgotPassword\ChangeRequest;
use App\Repositories\Acl\ForgotPasswordRepository;

class ForgotPasswordController extends Controller
{
    private $forgotPasswordRepository;

    public function __construct(ForgotPasswordRepository $ForgotPasswordRepository)
    {
        $this->forgotPasswordRepository = $ForgotPasswordRepository;
        $this->middleware(['permission:user-list','permission:acl-list']);
        $this->middleware('permission:user-forgot-password')->only('index');
    }

    public function update(ChangeRequest $request,$id)
    {
        $this->forgotPasswordRepository->updateData($request,$id);
    }
}
