<?php

namespace App\Http\Controllers\Wordpress\Acl;

use App\Http\Controllers\Controller;
use App\Models\Acl\Agent;
use App\Models\Acl\User;
use App\Traits\Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    use Image;
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
        $username = array();
        $full_name = array();
        $agency_agent = array();
        $agent = array();
        $developer = array();
        $agent_translation = array();
        $language = language();
        $image = array();
        $role = array('2' => 0, '3' => 1, '5' => 2, '4' => 3, '6' => 4);
        $wp_users_id = DB::table('users')->pluck('wp_user_id', 'wp_user_id')->toarray();
        executionTime();
        $full_name_users = DB::table('users')->pluck('fullname', 'fullname')->toarray();
        executionTime();
        $username_users = DB::table('users')->pluck('username', 'username')->toarray();
        executionTime();
        foreach ($response['data'] as $key => $user) {
            executionTime();
            if (!in_array($user['wp_user_id'], $wp_users_id)) {
                if (!empty($user['username']) && !in_array($user['username'], $username) && !in_array($user['username'], $full_name_users)) {
                    if (!empty($user['full_name']) && !in_array($user['full_name'], $full_name) && !in_array($user['full_name'], $username_users)) {
                        $username[] = !empty($user['username']) ? $user['username'] : 'test';
                        $full_name[] = !empty($user['full_name']) ? $user['full_name'] : 'test';
                        if (!empty($user['image'])) {
                            $image[] = array('id' => $count_user + $key + 1, 'image_url' => $user['image']);
                        }
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
                            if ($user['role_id'] == 2) {
                                $agent[] = array('user_id' => $count_user + $key + 1, 'agency_id' => 0, 'wp_agent_id' => $user['wp_user_id']);
                                if (!empty($user['agent']['about_me'])) {
                                    foreach ($language as $lang) {
                                        $agent_translation[] = array('category_type' => Agent::class, 'category_id' => $count_user + $key + 1,
                                            'key' => 'about_me', 'value' => $user['agent']['about_me'], 'language_id' => $lang->id);
                                    }
                                }
                            }
                            if ($user['role_id'] == 3) {
                                $agency[] = array('user_id' => $count_user + $key + 1, 'wp_agency_id' => $user['wp_user_id']);
                                if (!empty($user['agency']['agent_user_id'])) {
                                    foreach ($user['agency']['agent_user_id'] as $ag) {
                                        if (!empty($ag)) {
                                            $agency_agent[] = array('agency_id' => $count_user + $key + 1, 'agent_id' => $ag);
                                        }
                                    }
                                }
                            }
                            if ($user['role_id'] == 4) {
                                $developer[] = array('user_id' => $count_user + $key + 1);
                            }
                        }
                    }
                }
            }
            executionTime();
        }
        executionTime();
        foreach ($agency_agent as $agencyagent) {
            foreach ($agent as $key => $agentid) {
                if ($agentid['wp_agent_id'] == $agencyagent['agent_id']) {
                    $agent[] = array('user_id' => $agentid['user_id'], 'agency_id' => $agencyagent['agency_id'], 'wp_agent_id' => $agentid['wp_agent_id']);
                    unset($agent[$key]);
                }
            }
        }
        executionTime();
        DB::transaction(function () use ($data_user, $data_user_package, $agency, $agent, $developer, $agent_translation, $image) {
            DB::table('users')->insert($data_user);
            executionTime();
            DB::table('user_packages')->insert($data_user_package);
            executionTime();
            DB::table('agencies')->insert($agency);
            executionTime();
            DB::table('agents')->insert($agent);
            executionTime();
            DB::table('developers')->insert($developer);
            executionTime();
            DB::table('translations')->insert($agent_translation);
            executionTime();
            foreach ($image as $im) {
                executionTime();
                $name = $this->uploadImageWordpress($im['image_url'], 'user');
                executionTime();
                $user_image[] = array('category_type' => user::class, 'category_id' => $im['id'], 'image' => $name);
                executionTime();
            }
            executionTime();
            DB::table('images')->insert($user_image);
            executionTime();
        });
    }
}
