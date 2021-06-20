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

        if (isset($request->type) && !empty($request->type)) {
            if ($request->type == "google") {
                $user = $this->user->where($request->type . '_id', $request->id)->first();
            } elseif ($request->type == "facebook") {
                $user = $this->user->where($request->type . '_id', $request->id)->first();
            } elseif ($request->type == "apple") {
                $user = $this->user->where($request->type . '_id', $request->id)->first();
            }
        } else {
            $user = $this->user->with('image', 'country.title', 'role.title', 'role.permission.title')
                ->whereNotBetween('role_id', [1, 2])
                ->where('email', $request->email)
                ->orwhereNotBetween('role_id', [1, 2])
                ->where('username', $request->email)->first();
            $user = $user ? (Hash::check($request->password, $user->password) ? $user : null) : null;
        }
        if ($user) {
            if ($user->status == 1) {
                Auth::loginUsingId($user->id);
                $token = Auth::user()->createToken('passport');
                $user->update(['token' => $token->accessToken]);
                return response(['status' => 1, 'data' => ['user' => new UserResource($user)], 'message' => trans('auth.login')]);
            }
            return response(['status' => 0, 'data' => array(), 'message' => trans('auth.support')], 200);
        } else {
            return response(['status' => 0, 'data' => array(), 'message' => trans('auth.failed')], 200);
        }

    }
}
