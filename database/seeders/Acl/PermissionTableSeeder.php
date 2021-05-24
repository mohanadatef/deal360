<?php

namespace Database\Seeders\Acl;

use App\Models\Acl\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $permission = Permission::all();
        foreach ($permission as $permissions) {
            $permissions->forceDelete();
        }
        $permission = Permission::onlyTrashed()->get();
        foreach ($permission as $permissions) {
            $permissions->forceDelete();
        }
        Permission::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $permission = [
            //permission
            [
                'name' => 'permission-list',
                'title' => ['en' => 'permission list', 'ar' => 'قائمه اذنات'],
            ],
            [
                'name' => 'permission-index',
                'title' => ['en' => 'permission index', 'ar' => 'قائمه'],
            ],
            [
                'name' => 'permission-create',
                'title' => ['en' => 'permission create', 'ar' => 'اضافه'],
            ],
            [
                'name' => 'permission-edit',
                'title' => ['en' => 'permission edit', 'ar' => 'تعديل'],
            ],
            [
                'name' => 'permission-delete',
                'title' => ['en' => 'permission delete', 'ar' => 'مسح'],
            ],
            [
                'name' => 'permission-restore',
                'title' => ['en' => 'permission restore', 'ar' => 'استرجاع'],
            ],
            [
                'name' => 'permission-remove',
                'title' => ['en' => 'permission remove', 'ar' => 'حذف'],
            ],
            //dashboard
            [
                'name' => 'dashboard-show',
                'title' => ['en' => 'dashboard show', 'ar' => 'عرض '],
            ],
            //acl
            [
                'name' => 'acl-list',
                'title' => ['en' => 'acl list', 'ar' => 'قائمه'],
            ],
            //user
            [
                'name' => 'user-list',
                'title' => ['en' => 'user list', 'ar' => 'قائمه اذنات'],
            ],
            [
                'name' => 'user-index',
                'title' => ['en' => 'user index', 'ar' => 'قائمه'],
            ],
            [
                'name' => 'user-create',
                'title' => ['en' => 'user create', 'ar' => 'اضافه'],
            ],
            [
                'name' => 'user-edit',
                'title' => ['en' => 'user edit', 'ar' => 'تعديل'],
            ],
            [
                'name' => 'user-status',
                'title' => ['en' => 'user status', 'ar' => 'تغير حاله'],
            ],
            [
                'name' => 'user-delete',
                'title' => ['en' => 'user delete', 'ar' => 'مسح'],
            ],
            [
                'name' => 'user-restore',
                'title' => ['en' => 'user restore', 'ar' => 'استرجاع'],
            ],
            [
                'name' => 'user-remove',
                'title' => ['en' => 'user remove', 'ar' => 'حذف'],
            ],
            //role
            [
                'name' => 'role-list',
                'title' => ['en' => 'role list', 'ar' => 'قائمه اذنات'],
            ],
            [
                'name' => 'role-index',
                'title' => ['en' => 'role index', 'ar' => 'قائمه'],
            ],
            [
                'name' => 'role-create',
                'title' => ['en' => 'role create', 'ar' => 'اضافه'],
            ],
            [
                'name' => 'role-edit',
                'title' => ['en' => 'role edit', 'ar' => 'تعديل'],
            ],
            [
                'name' => 'role-status',
                'title' => ['en' => 'role status', 'ar' => 'تغير حاله'],
            ],
            [
                'name' => 'role-delete',
                'title' => ['en' => 'role delete', 'ar' => 'مسح'],
            ],
            [
                'name' => 'role-restore',
                'title' => ['en' => 'role restore', 'ar' => 'استرجاع'],
            ],
            [
                'name' => 'role-remove',
                'title' => ['en' => 'role remove', 'ar' => 'حذف'],
            ],
            //setting
            [
                'name' => 'setting-list',
                'title' => ['en' => 'setting list', 'ar' => 'قائمه اذنات'],
            ],
            //meta
            [
                'name' => 'meta-list',
                'title' => ['en' => 'meta list', 'ar' => 'قائمه اذنات'],
            ],
            [
                'name' => 'meta-index',
                'title' => ['en' => 'meta index', 'ar' => 'قائمه'],
            ],
            [
                'name' => 'meta-create',
                'title' => ['en' => 'meta create', 'ar' => 'اضافه'],
            ],
            [
                'name' => 'meta-edit',
                'title' => ['en' => 'meta edit', 'ar' => 'تعديل'],
            ],
            [
                'name' => 'meta-status',
                'title' => ['en' => 'meta status', 'ar' => 'تغير حاله'],
            ],
            [
                'name' => 'meta-delete',
                'title' => ['en' => 'meta delete', 'ar' => 'مسح'],
            ],
            [
                'name' => 'meta-restore',
                'title' => ['en' => 'meta restore', 'ar' => 'استرجاع'],
            ],
            [
                'name' => 'meta-remove',
                'title' => ['en' => 'meta remove', 'ar' => 'حذف'],
            ],
            //core data
            [
                'name' => 'core-data-list',
                'title' => ['en' => 'core data list', 'ar' => 'قائمه اذنات'],
            ],
            //area
            [
                'name' => 'area-list',
                'title' => ['en' => 'area list', 'ar' => 'قائمه اذنات'],
            ],
            [
                'name' => 'area-index',
                'title' => ['en' => 'area index', 'ar' => 'قائمه'],
            ],
            [
                'name' => 'area-create',
                'title' => ['en' => 'area create', 'ar' => 'اضافه'],
            ],
            [
                'name' => 'area-edit',
                'title' => ['en' => 'area edit', 'ar' => 'تعديل'],
            ],
            [
                'name' => 'area-status',
                'title' => ['en' => 'area status', 'ar' => 'تغير حاله'],
            ],
            [
                'name' => 'area-delete',
                'title' => ['en' => 'area delete', 'ar' => 'مسح'],
            ],
            [
                'name' => 'area-restore',
                'title' => ['en' => 'area restore', 'ar' => 'استرجاع'],
            ],
            [
                'name' => 'area-remove',
                'title' => ['en' => 'area remove', 'ar' => 'حذف'],
            ],
            //city
            [
                'name' => 'city-list',
                'title' => ['en' => 'city list', 'ar' => 'قائمه اذنات'],
            ],
            [
                'name' => 'city-index',
                'title' => ['en' => 'city index', 'ar' => 'قائمه'],
            ],
            [
                'name' => 'city-create',
                'title' => ['en' => 'city create', 'ar' => 'اضافه'],
            ],
            [
                'name' => 'city-edit',
                'title' => ['en' => 'city edit', 'ar' => 'تعديل'],
            ],
            [
                'name' => 'city-status',
                'title' => ['en' => 'city status', 'ar' => 'تغير حاله'],
            ],
            [
                'name' => 'city-delete',
                'title' => ['en' => 'city delete', 'ar' => 'مسح'],
            ],
            [
                'name' => 'city-restore',
                'title' => ['en' => 'city restore', 'ar' => 'استرجاع'],
            ],
            [
                'name' => 'city-remove',
                'title' => ['en' => 'city remove', 'ar' => 'حذف'],
            ],
            //country
            [
                'name' => 'country-list',
                'title' => ['en' => 'country list', 'ar' => 'قائمه اذنات'],
            ],
            [
                'name' => 'country-index',
                'title' => ['en' => 'country index', 'ar' => 'قائمه'],
            ],
            [
                'name' => 'country-create',
                'title' => ['en' => 'country create', 'ar' => 'اضافه'],
            ],
            [
                'name' => 'country-edit',
                'title' => ['en' => 'country edit', 'ar' => 'تعديل'],
            ],
            [
                'name' => 'country-status',
                'title' => ['en' => 'country status', 'ar' => 'تغير حاله'],
            ],
            [
                'name' => 'country-delete',
                'title' => ['en' => 'country delete', 'ar' => 'مسح'],
            ],
            [
                'name' => 'country-restore',
                'title' => ['en' => 'country restore', 'ar' => 'استرجاع'],
            ],
            [
                'name' => 'country-remove',
                'title' => ['en' => 'country remove', 'ar' => 'حذف'],
            ],
            //language
            [
                'name' => 'language-list',
                'title' => ['en' => 'language list', 'ar' => 'قائمه اذنات'],
            ],
            [
                'name' => 'language-index',
                'title' => ['en' => 'language index', 'ar' => 'قائمه'],
            ],
            [
                'name' => 'language-create',
                'title' => ['en' => 'language create', 'ar' => 'اضافه'],
            ],
            [
                'name' => 'language-edit',
                'title' => ['en' => 'language edit', 'ar' => 'تعديل'],
            ],
            [
                'name' => 'language-status',
                'title' => ['en' => 'language status', 'ar' => 'تغير حاله'],
            ],
            [
                'name' => 'language-delete',
                'title' => ['en' => 'language delete', 'ar' => 'مسح'],
            ],
            [
                'name' => 'language-restore',
                'title' => ['en' => 'language restore', 'ar' => 'استرجاع'],
            ],
            [
                'name' => 'language-remove',
                'title' => ['en' => 'language remove', 'ar' => 'حذف'],
            ],
            //amenity
            [
                'name' => 'amenity-list',
                'title' => ['en' => 'amenity list', 'ar' => 'قائمه اذنات'],
            ],
            [
                'name' => 'amenity-index',
                'title' => ['en' => 'amenity index', 'ar' => 'قائمه'],
            ],
            [
                'name' => 'amenity-create',
                'title' => ['en' => 'amenity create', 'ar' => 'اضافه'],
            ],
            [
                'name' => 'amenity-edit',
                'title' => ['en' => 'amenity edit', 'ar' => 'تعديل'],
            ],
            [
                'name' => 'amenity-status',
                'title' => ['en' => 'amenity status', 'ar' => 'تغير حاله'],
            ],
            [
                'name' => 'amenity-delete',
                'title' => ['en' => 'amenity delete', 'ar' => 'مسح'],
            ],
            [
                'name' => 'amenity-restore',
                'title' => ['en' => 'amenity restore', 'ar' => 'استرجاع'],
            ],
            [
                'name' => 'amenity-remove',
                'title' => ['en' => 'amenity remove', 'ar' => 'حذف'],
            ],
            //category
            [
                'name' => 'category-list',
                'title' => ['en' => 'category list', 'ar' => 'قائمه اذنات'],
            ],
            [
                'name' => 'category-index',
                'title' => ['en' => 'category index', 'ar' => 'قائمه'],
            ],
            [
                'name' => 'category-create',
                'title' => ['en' => 'category create', 'ar' => 'اضافه'],
            ],
            [
                'name' => 'category-edit',
                'title' => ['en' => 'category edit', 'ar' => 'تعديل'],
            ],
            [
                'name' => 'category-status',
                'title' => ['en' => 'category status', 'ar' => 'تغير حاله'],
            ],
            [
                'name' => 'category-delete',
                'title' => ['en' => 'category delete', 'ar' => 'مسح'],
            ],
            [
                'name' => 'category-restore',
                'title' => ['en' => 'category restore', 'ar' => 'استرجاع'],
            ],
            [
                'name' => 'category-remove',
                'title' => ['en' => 'category remove', 'ar' => 'حذف'],
            ],
            //package
            [
                'name' => 'package-list',
                'title' => ['en' => 'package list', 'ar' => 'قائمه اذنات'],
            ],
            [
                'name' => 'package-index',
                'title' => ['en' => 'package index', 'ar' => 'قائمه'],
            ],
            [
                'name' => 'package-create',
                'title' => ['en' => 'package create', 'ar' => 'اضافه'],
            ],
            [
                'name' => 'package-edit',
                'title' => ['en' => 'package edit', 'ar' => 'تعديل'],
            ],
            [
                'name' => 'package-status',
                'title' => ['en' => 'package status', 'ar' => 'تغير حاله'],
            ],
            [
                'name' => 'package-delete',
                'title' => ['en' => 'package delete', 'ar' => 'مسح'],
            ],
            [
                'name' => 'package-restore',
                'title' => ['en' => 'package restore', 'ar' => 'استرجاع'],
            ],
            [
                'name' => 'package-remove',
                'title' => ['en' => 'package remove', 'ar' => 'حذف'],
            ],
            //status
            [
                'name' => 'status-list',
                'title' => ['en' => 'status list', 'ar' => 'قائمه اذنات'],
            ],
            [
                'name' => 'status-index',
                'title' => ['en' => 'status index', 'ar' => 'قائمه'],
            ],
            [
                'name' => 'status-create',
                'title' => ['en' => 'status create', 'ar' => 'اضافه'],
            ],
            [
                'name' => 'status-edit',
                'title' => ['en' => 'status edit', 'ar' => 'تعديل'],
            ],
            [
                'name' => 'status-status',
                'title' => ['en' => 'status status', 'ar' => 'تغير حاله'],
            ],
            [
                'name' => 'status-delete',
                'title' => ['en' => 'status delete', 'ar' => 'مسح'],
            ],
            [
                'name' => 'status-restore',
                'title' => ['en' => 'status restore', 'ar' => 'استرجاع'],
            ],
            [
                'name' => 'status-remove',
                'title' => ['en' => 'status remove', 'ar' => 'حذف'],
            ],
            //type
            [
                'name' => 'type-list',
                'title' => ['en' => 'type list', 'ar' => 'قائمه اذنات'],
            ],
            [
                'name' => 'type-index',
                'title' => ['en' => 'type index', 'ar' => 'قائمه'],
            ],
            [
                'name' => 'type-create',
                'title' => ['en' => 'type create', 'ar' => 'اضافه'],
            ],
            [
                'name' => 'type-edit',
                'title' => ['en' => 'type edit', 'ar' => 'تعديل'],
            ],
            [
                'name' => 'type-status',
                'title' => ['en' => 'type status', 'ar' => 'تغير حاله'],
            ],
            [
                'name' => 'type-delete',
                'title' => ['en' => 'type delete', 'ar' => 'مسح'],
            ],
            [
                'name' => 'type-restore',
                'title' => ['en' => 'type restore', 'ar' => 'استرجاع'],
            ],
            [
                'name' => 'type-remove',
                'title' => ['en' => 'type remove', 'ar' => 'حذف'],
            ],
            //highlight
            [
                'name' => 'highlight-list',
                'title' => ['en' => 'highlight list', 'ar' => 'قائمه اذنات'],
            ],
            [
                'name' => 'highlight-index',
                'title' => ['en' => 'highlight index', 'ar' => 'قائمه'],
            ],
            [
                'name' => 'highlight-create',
                'title' => ['en' => 'highlight create', 'ar' => 'اضافه'],
            ],
            [
                'name' => 'highlight-edit',
                'title' => ['en' => 'highlight edit', 'ar' => 'تعديل'],
            ],
            [
                'name' => 'highlight-status',
                'title' => ['en' => 'highlight status', 'ar' => 'تغير حاله'],
            ],
            [
                'name' => 'highlight-delete',
                'title' => ['en' => 'highlight delete', 'ar' => 'مسح'],
            ],
            [
                'name' => 'highlight-restore',
                'title' => ['en' => 'highlight restore', 'ar' => 'استرجاع'],
            ],
            [
                'name' => 'highlight-remove',
                'title' => ['en' => 'highlight remove', 'ar' => 'حذف'],
            ],
        ];
        foreach ($permission as $key => $value) {
            $data = Permission::create(['name' => $value['name']]);
            foreach (language() as $lang) {
                $data->translation()->create(['key' => 'name', 'value' => $value['title'][$lang->code],
                    'language_id' => $lang->id]);
            }
        }
    }
}
