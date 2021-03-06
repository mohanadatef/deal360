<?php

namespace App\Http\Controllers\Api\Acl;

use App\Http\Controllers\Controller;
use App\Http\Resources\Acl\User\UserResource;
use App\Models\Acl\User;
use App\Repositories\Acl\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    private $user;
    private $userRepository;
    public function __construct(User $User,UserRepository $UserRepository)
    {
        $this->middleware('auth:api', ['except' => ['login']]);
        $this->user = $User;
        $this->userRepository = $UserRepository;
    }

    public function login(Request $request)
    {
        //if login by google or facebook or apple
        if (isset($request->type) && !empty($request->type)) {
            if ($request->type == "google") {
                $user = $this->userRepository->socialMediaSearch('google_id', $request->id);

            } elseif ($request->type == "facebook") {
                $user = $this->userRepository->socialMediaSearch('facebook_id', $request->id);

            } elseif ($request->type == "apple") {
                $user = $this->userRepository->socialMediaSearch('apple_id', $request->id);

            }
        } else {
            //if email or user name with password
            $user = $this->user->with('image', 'country', 'role')->whereNotBetween('role_id', [1, 2]);
                $user=$user->where('email', $request->email)
                ->orwhere('username', $request->email)->first();
            //check password
            $user = $user ? (Hash::check($request->password, $user->password) ? $user : null) : null;
        }
        if ($user) {
            //check status
            if ($user->status == 1) {
                //login
                Auth::loginUsingId($user->id);
                //create token
                $token = Auth::user()->createToken(['passport']);
                //update user token
                $user->update(['token' => $token->accessToken]);
                return response(['status' => 1, 'data' => ['user' => new UserResource($user)], 'message' => trans('auth.login')]);
            }
            //if status not 1
            return response(['status' => 0, 'data' => array(), 'message' => trans('auth.support')], 200);
        } else {
            //if user not found
            return response(['status' => 0, 'data' => array(), 'message' => trans('auth.failed')], 200);
        }
    }
}
