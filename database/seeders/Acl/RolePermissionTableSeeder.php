<?php

namespace Database\Seeders\Acl;

use App\Models\Acl\Permission;
use App\Models\Acl\Role;
use App\Models\Acl\RolePermission;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class RolePermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        RolePermission::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $sa = Role::where('code', 'sad')->first();
        $role = Role::all();
        $permission = Permission::wherenotbetween('id',[1,7])->get();
        $permissionsa = Permission::wherebetween('id',[1,7])->get();
        foreach ($permissionsa as $value) {
            RolePermission::create(['role_id' => $sa->id, 'permission_id' => $value->id]);
        }
        foreach ($role as $values) {
            foreach ($permission as $value) {
                RolePermission::create(['role_id' => $values->id, 'permission_id' => $value->id]);
            }
        }
    }
}
