<?php

namespace Database\Seeders\Acl;

use App\Models\Acl\Role;
use App\Models\Acl\User;
use App\Traits\Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    use Image;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $user = User::all();
        foreach ($user as $users) {
            $this->deleteImage($users->image, 'user');
            $users->forceDelete();
        }
        $user = User::onlyTrashed()->get();
        foreach ($user as $users) {
            $this->deleteImage($users->image, 'user');
            $users->forceDelete();
        }
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $user = [
            //user
            [
                'id'=>1,
                'fullname' => 'Developer',
                'username' => 'superadmin',
                'email' => 'superadmin@deal360.com',
                'password' => Hash::make('123456'),
                'phone' => '00000000000',
                'approve' => '1',
                'email_verified_at' => Carbon::now(),
                'role_id' => Role::where('code','sad')->first()->id,
                'country_id' => 1,
            ],
            [
                'id'=>2,
                'fullname' => 'mohanad atef1',
                'username' => 'mohanadatef',
                'email' => 'mohanad@deal360.com',
                'password' => Hash::make('M0h@n@d7'),
                'phone' => '01011666755',
                'approve' => '1',
                'email_verified_at' => Carbon::now(),
                'role_id' => Role::where('code','sad')->first()->id,
                'country_id' => 1,
            ],
        ];
        foreach ($user as $value) {
            $data = User::create($value);
        }
    }
}
