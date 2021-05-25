<?php

namespace Database\Seeders\Acl;

use App\Models\Acl\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $role = Role::all();
        foreach ($role as $roles) {
            $roles->forceDelete();
        }
        $role = Role::onlyTrashed()->get();
        foreach ($role as $roles) {
            $roles->forceDelete();
        }
        Role::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $role = [
            //role
            [
                'code' => 'sad',
                'type_access' => 'all',
                'order' => '0',
                'title' => ['en' => 'super admin', 'ar' => 'سوبر ادمن'],
            ],
            [
                'code' => 'ad',
                'type_access' => 'all',
                'order' => '1',
                'title' => ['en' => 'admin', 'ar' => 'ادمن'],
            ],
        ];
        foreach ($role as $value) {
            $data = Role::create(['code' => $value['code'],
                'type_access' => $value['type_access'],
                'order' => $value['order']]);
            foreach (language() as $lang) {
                $data->translation()->create(['key' => 'title', 'value' => $value['title'][$lang->code],
                    'language_id' => $lang->id]);
            }
        }
    }
}
