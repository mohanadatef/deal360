<?php

namespace App\Http\Controllers\Wordpress\Acl;

use App\Http\Controllers\Controller;
use App\Models\Acl\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function index($return)
    {
        $response = Http::get('https://crm.deal360.ae/backend/api/fillUsers')->json();
        $this->store($response);
        if ($return == 1) {
            return redirect(route('admin.dashboard'));
        }
    }

    public function store($response)
    {
        $count_user = User::latest('id')->first();
        $count_user = empty($count_user) ? 0 : $count_user->id;
        $data_user = array();
        $data_user_package = array();
        $agency = array();
        $agent = array();
        $developer = array();
        $role = array('2' => 0, '3' => 1, '5' => 2, '4' => 3, '6' => 4);
        $wp_users_id = DB::table('users')->pluck('wp_user_id', 'wp_user_id')->toarray();
        foreach ($response['data'] as $key => $user) {
            if (!in_array($user['wp_user_id'], $wp_users_id)) {
                $data_user[] = array('id' => $count_user + $key + 1, 'wp_user_id' => $user['wp_user_id'],
                     'username' => empty($user['username']) ? 'username ' . ($count_user + $key + 1) : $user['username'],
                    'password' => $user['password'], 'email' => empty($user['mail']) ? 'mail@test.com' . ($count_user + $key + 1) : $user['mail'],
                    'fullname' => empty($user['full_name']) ? 'full_name ' . ($count_user + $key + 1) : $user['full_name'],
                    'phone' => empty($user['mobile']) ? '01' . ($count_user + $key + 1) : $user['mobile'],
                    'website' => $user['website_url'], 'facebook' => $user['facebook_url'], 'twitter' => $user['twitter_url'],
                    'instagram' => $user['instagram_url'], 'approve' => 1, 'country_id' => 1, 'email_verified_at' => Carbon::now(),
                    'role_id' => empty($user['role_id']) ? 3 : array_search($user['role_id'], $role));
                $data_user_package[] = array('package_id' => 18, 'user_id' => $count_user + $key + 1,
                    'started_at' => empty($user['package_activation']) ? Carbon::now() : $user['package_activation']);
                if (!empty($user['role_id'])) {
                    if($user['role_id'] == 2)
                    {
                        $agent[]=array('user_id'=>$count_user + $key + 1);
                    }
                    if($user['role_id'] == 3)
                    {
                        $agency[]=array('user_id'=>$count_user + $key + 1);
                    }
                    if($user['role_id'] == 4)
                    {
                        $developer[]=array('user_id'=>$count_user + $key + 1);
                    }
                }
            }
        }
        DB::transaction(function () use ($data_user, $data_user_package,$agency,$agent,$developer) {
            DB::table('users')->insert($data_user);
            DB::table('user_packages')->insert($data_user_package);
            DB::table('agencies')->insert($agency);
            DB::table('agents')->insert($agent);
            DB::table('developers')->insert($developer);
        });
    }
}
