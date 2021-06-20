<?php

namespace App\Http\Controllers\Api\Acl;

use App\Http\Controllers\Controller;
use App\Http\Resources\Acl\User\UserResource;
use App\Models\Acl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    private $user;

    public function __construct(User $User)
    {
        $this->middleware('auth:api', ['except' => ['login']]);
        $this->user = $User;
    }

    public function login(Request $request)
    {
        //if login by google or facebook or apple
        if (isset($request->type) && !empty($request->type)) {
            if ($request->type == "google") {
                $user = $this->user->where($request->type . '_id', $request->id)->first();
            } elseif ($request->type == "facebook") {
                $user = $this->user->where($request->type . '_id', $request->id)->first();
            } elseif ($request->type == "apple") {
                $user = $this->user->where($request->type . '_id', $request->id)->first();
            }
        } else {
            //if email or user name with password
            $user = $this->user->with('image', 'country.title', 'role.title', 'role.permission.title')
                ->whereNotBetween('role_id', [1, 2])
                ->where('email', $request->email)
                ->orwhereNotBetween('role_id', [1, 2])
                ->where('username', $request->email)->first();
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
