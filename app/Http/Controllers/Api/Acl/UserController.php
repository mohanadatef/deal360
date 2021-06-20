<?php

namespace App\Http\Controllers\Api\Acl;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Acl\User\CreateRequest;
use App\Http\Resources\Acl\User\UserResource;
use App\Repositories\Admin\Acl\UserRepository;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    private $userRepository;

    public function __construct(UserRepository $UserRepository)
    {
        $this->userRepository = $UserRepository;
        $this->middleware('auth:api')->except('register');
    }

    public function register(CreateRequest $request)
    {
        $request->request->add(['role_id' => 3]); //add role
        $request->request->add(['country_id' => 1]); //add country
        $request->request->add(['base64' => 1]); //check image
        $request->request->add(['approve' => 0]); //add approve
        $user = $this->userRepository->storeData($request); //create user
        Auth::loginUsingId($user->id); //login
        $token = Auth::user()->createToken(['passport']); //create token
        $user->update(['token' => $token->accessToken]); //update token user
        return response(['status' => 1, 'data' => ['user' => new UserResource($user)], 'message' => trans('lang.Done')]);
    }
}
