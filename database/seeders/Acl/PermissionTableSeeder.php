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
                'title' => ['en' => 'permission list', 'ar' => 'قائمه اذنات اذنات'],
            ],
            [
                'name' => 'permission-index',
                'title' => ['en' => 'permission index', 'ar' => 'قائمه اذنات'],
            ],
            [
                'name' => 'permission-create',
                'title' => ['en' => 'permission create', 'ar' => 'اضافه اذنات'],
            ],
            [
                'name' => 'permission-edit',
                'title' => ['en' => 'permission edit', 'ar' => 'تعديل اذنات'],
            ],
            [
                'name' => 'permission-delete',
                'title' => ['en' => 'permission delete', 'ar' => 'مسح اذنات'],
            ],
            [
                'name' => 'permission-index-delete',
                'title' => ['en' => 'permission index delete', 'ar' => 'قائمه مسح اذنات'],
            ],
            [
                'name' => 'permission-restore',
                'title' => ['en' => 'permission restore', 'ar' => 'استرجاع اذنات'],
            ],
            [
                'name' => 'permission-remove',
                'title' => ['en' => 'permission remove', 'ar' => 'حذف اذنات'],
            ],
            //dashboard
            [
                'name' => 'dashboard-show',
                'title' => ['en' => 'dashboard show', 'ar' => 'عرض لوحه التحكم'],
            ],
            //acl
            [
                'name' => 'acl-list',
                'title' => ['en' => 'acl list', 'ar' => 'قائمه الامن'],
            ],
            //user
            [
                'name' => 'user-list',
                'title' => ['en' => 'user list', 'ar' => 'قائمه اذنات المستخدم'],
            ],
            [
                'name' => 'user-index',
                'title' => ['en' => 'user index', 'ar' => 'قائمه المستخدم'],
            ],
            [
                'name' => 'user-create',
                'title' => ['en' => 'user create', 'ar' => 'اضافه المستخدم'],
            ],
            [
                'name' => 'user-edit',
                'title' => ['en' => 'user edit', 'ar' => 'تعديل المستخدم'],
            ],
            [
                'name' => 'user-status',
                'title' => ['en' => 'user status', 'ar' => 'تغير حاله المستخدم'],
            ],
            [
                'name' => 'user-delete',
                'title' => ['en' => 'user delete', 'ar' => 'مسح المستخدم'],
            ],
            [
                'name' => 'user-index-delete',
                'title' => ['en' => 'user index delete', 'ar' => 'قائمه مسح المستخدم'],
            ],
            [
                'name' => 'user-restore',
                'title' => ['en' => 'user restore', 'ar' => 'استرجاع المستخدم'],
            ],
            [
                'name' => 'user-remove',
                'title' => ['en' => 'user remove', 'ar' => 'حذف المستخدم'],
            ],
            [
                'name' => 'user-forgot-password',
                'title' => ['en' => 'user forgot password', 'ar' => 'تغير كلمه السر المستخدم'],
            ],
            //agency
            [
	            'name' => 'agency-list',
	            'title' => ['en' => 'agency list', 'ar' => 'قائمه اذنات الشركه'],
            ],
            [
	            'name' => 'agency-index',
	            'title' => ['en' => 'agency index', 'ar' => 'قائمه الشركه'],
            ],
            [
	            'name' => 'agency-create',
	            'title' => ['en' => 'agency create', 'ar' => 'اضافه الشركه'],
            ],
            [
	            'name' => 'agency-edit',
	            'title' => ['en' => 'agency edit', 'ar' => 'تعديل الشركه'],
            ],
            [
	            'name' => 'agency-status',
	            'title' => ['en' => 'agency status', 'ar' => 'تغير حاله الشركه'],
            ],
            [
	            'name' => 'agency-delete',
	            'title' => ['en' => 'agency delete', 'ar' => 'مسح الشركه'],
            ],
            [
	            'name' => 'agency-index-delete',
	            'title' => ['en' => 'agency index delete', 'ar' => 'قائمه مسح الشركه'],
            ],
            [
	            'name' => 'agency-restore',
	            'title' => ['en' => 'agency restore', 'ar' => 'استرجاع الشركه'],
            ],
            [
	            'name' => 'agency-remove',
	            'title' => ['en' => 'agency remove', 'ar' => 'حذف الشركه'],
            ],
            [
	            'name' => 'agency-forgot-password',
	            'title' => ['en' => 'agency forgot password', 'ar' => 'تغير كلمه السر الشركه'],
            ],
            //developer
            [
	            'name' => 'developer-list',
	            'title' => ['en' => 'developer list', 'ar' => 'قائمه اذنات المطور'],
            ],
            [
	            'name' => 'developer-index',
	            'title' => ['en' => 'developer index', 'ar' => 'قائمه المطور'],
            ],
            [
	            'name' => 'developer-create',
	            'title' => ['en' => 'developer create', 'ar' => 'اضافه المطور'],
            ],
            [
	            'name' => 'developer-edit',
	            'title' => ['en' => 'developer edit', 'ar' => 'تعديل المطور'],
            ],
            [
	            'name' => 'developer-status',
	            'title' => ['en' => 'developer status', 'ar' => 'تغير حاله المطور'],
            ],
            [
	            'name' => 'developer-delete',
	            'title' => ['en' => 'developer delete', 'ar' => 'مسح المطور'],
            ],
            [
	            'name' => 'developer-index-delete',
	            'title' => ['en' => 'developer index delete', 'ar' => 'قائمه مسح المطور'],
            ],
            [
	            'name' => 'developer-restore',
	            'title' => ['en' => 'developer restore', 'ar' => 'استرجاع المطور'],
            ],
            [
	            'name' => 'developer-remove',
	            'title' => ['en' => 'developer remove', 'ar' => 'حذف المطور'],
            ],
            [
	            'name' => 'developer-forgot-password',
	            'title' => ['en' => 'developer forgot password', 'ar' => 'تغير كلمه السر المطور'],
            ],
            //role
            [
                'name' => 'role-list',
                'title' => ['en' => 'role list', 'ar' => 'قائمه اذنات صلحيات'],
            ],
            [
                'name' => 'role-index',
                'title' => ['en' => 'role index', 'ar' => 'قائمه صلحيات'],
            ],
            [
                'name' => 'role-create',
                'title' => ['en' => 'role create', 'ar' => 'اضافه صلحيات'],
            ],
            [
                'name' => 'role-edit',
                'title' => ['en' => 'role edit', 'ar' => 'تعديل صلحيات'],
            ],
            [
                'name' => 'role-status',
                'title' => ['en' => 'role status', 'ar' => 'تغير حاله صلحيات'],
            ],
            [
                'name' => 'role-delete',
                'title' => ['en' => 'role delete', 'ar' => 'مسح صلحيات'],
            ],
            [
                'name' => 'role-index-delete',
                'title' => ['en' => 'role index delete', 'ar' => 'قائمه مسح صلحيات'],
            ],
            [
                'name' => 'role-restore',
                'title' => ['en' => 'role restore', 'ar' => 'استرجاع صلحيات'],
            ],
            [
                'name' => 'role-remove',
                'title' => ['en' => 'role remove', 'ar' => 'حذف صلحيات'],
            ],
            //setting
            [
                'name' => 'setting-list',
                'title' => ['en' => 'setting list', 'ar' => 'قائمه اذنات الاعدادات'],
            ],
            //meta
            [
                'name' => 'meta-list',
                'title' => ['en' => 'meta list', 'ar' => 'قائمه اذنات كلمه تعريفيه'],
            ],
            [
                'name' => 'meta-index',
                'title' => ['en' => 'meta index', 'ar' => 'قائمه كلمه تعريفيه'],
            ],
            [
                'name' => 'meta-create',
                'title' => ['en' => 'meta create', 'ar' => 'اضافه كلمه تعريفيه'],
            ],
            [
                'name' => 'meta-edit',
                'title' => ['en' => 'meta edit', 'ar' => 'تعديل كلمه تعريفيه'],
            ],
            [
                'name' => 'meta-status',
                'title' => ['en' => 'meta status', 'ar' => 'تغير حاله كلمه تعريفيه'],
            ],
            [
                'name' => 'meta-delete',
                'title' => ['en' => 'meta delete', 'ar' => 'مسح كلمه تعريفيه'],
            ],
            [
                'name' => 'meta-index-delete',
                'title' => ['en' => 'meta index delete', 'ar' => 'قائمه مسح كلمه تعريفيه'],
            ],
            [
                'name' => 'meta-restore',
                'title' => ['en' => 'meta restore', 'ar' => 'استرجاع كلمه تعريفيه'],
            ],
            [
                'name' => 'meta-remove',
                'title' => ['en' => 'meta remove', 'ar' => 'حذف كلمه تعريفيه'],
            ],
            //fq
            [
                'name' => 'fq-list',
                'title' => ['en' => 'fq list', 'ar' => 'قائمه اذنات اسئله و اجابه'],
            ],
            [
                'name' => 'fq-index',
                'title' => ['en' => 'fq index', 'ar' => 'قائمه اسئله و اجابه'],
            ],
            [
                'name' => 'fq-create',
                'title' => ['en' => 'fq create', 'ar' => 'اضافه اسئله و اجابه'],
            ],
            [
                'name' => 'fq-edit',
                'title' => ['en' => 'fq edit', 'ar' => 'تعديل اسئله و اجابه'],
            ],
            [
                'name' => 'fq-status',
                'title' => ['en' => 'fq status', 'ar' => 'تغير حاله اسئله و اجابه'],
            ],
            [
                'name' => 'fq-delete',
                'title' => ['en' => 'fq delete', 'ar' => 'مسح اسئله و اجابه'],
            ],
            [
                'name' => 'fq-index-delete',
                'title' => ['en' => 'fq index delete', 'ar' => 'قائمه مسح اسئله و اجابه'],
            ],
            [
                'name' => 'fq-restore',
                'title' => ['en' => 'fq restore', 'ar' => 'استرجاع اسئله و اجابه'],
            ],
            [
                'name' => 'fq-remove',
                'title' => ['en' => 'fq remove', 'ar' => 'حذف اسئله و اجابه'],
            ],
            //core data
            [
                'name' => 'core-data-list',
                'title' => ['en' => 'core data list', 'ar' => 'قائمه اذنات بيانات الاساسيه'],
            ],
            //rejoin
            [
                'name' => 'rejoin-list',
                'title' => ['en' => 'rejoin list', 'ar' => 'قائمه اذنات المنطقه'],
            ],
            [
                'name' => 'rejoin-index',
                'title' => ['en' => 'rejoin index', 'ar' => 'قائمه المنطقه'],
            ],
            [
                'name' => 'rejoin-create',
                'title' => ['en' => 'rejoin create', 'ar' => 'اضافه المنطقه'],
            ],
            [
                'name' => 'rejoin-edit',
                'title' => ['en' => 'rejoin edit', 'ar' => 'تعديل المنطقه'],
            ],
            [
                'name' => 'rejoin-status',
                'title' => ['en' => 'rejoin status', 'ar' => 'تغير حاله المنطقه'],
            ],
            [
                'name' => 'rejoin-delete',
                'title' => ['en' => 'rejoin delete', 'ar' => 'مسح المنطقه'],
            ],
            [
                'name' => 'rejoin-index-delete',
                'title' => ['en' => 'rejoin index delete', 'ar' => 'قائمه مسح المنطقه'],
            ],
            [
                'name' => 'rejoin-restore',
                'title' => ['en' => 'rejoin restore', 'ar' => 'استرجاع المنطقه'],
            ],
            [
                'name' => 'rejoin-remove',
                'title' => ['en' => 'rejoin remove', 'ar' => 'حذف المنطقه'],
            ],
            //city
            [
                'name' => 'city-list',
                'title' => ['en' => 'city list', 'ar' => 'قائمه اذنات المدينه'],
            ],
            [
                'name' => 'city-index',
                'title' => ['en' => 'city index', 'ar' => 'قائمه المدينه'],
            ],
            [
                'name' => 'city-create',
                'title' => ['en' => 'city create', 'ar' => 'اضافه المدينه'],
            ],
            [
                'name' => 'city-edit',
                'title' => ['en' => 'city edit', 'ar' => 'تعديل المدينه'],
            ],
            [
                'name' => 'city-status',
                'title' => ['en' => 'city status', 'ar' => 'تغير حاله المدينه'],
            ],
            [
                'name' => 'city-delete',
                'title' => ['en' => 'city delete', 'ar' => 'مسح المدينه'],
            ],
            [
                'name' => 'city-index-delete',
                'title' => ['en' => 'city index delete', 'ar' => 'قائمه مسح المدينه'],
            ],
            [
                'name' => 'city-restore',
                'title' => ['en' => 'city restore', 'ar' => 'استرجاع المدينه'],
            ],
            [
                'name' => 'city-remove',
                'title' => ['en' => 'city remove', 'ar' => 'حذف المدينه'],
            ],
            //country
            [
                'name' => 'country-list',
                'title' => ['en' => 'country list', 'ar' => 'قائمه اذنات البلد'],
            ],
            [
                'name' => 'country-index',
                'title' => ['en' => 'country index', 'ar' => 'قائمه البلد'],
            ],
            [
                'name' => 'country-create',
                'title' => ['en' => 'country create', 'ar' => 'اضافه البلد'],
            ],
            [
                'name' => 'country-edit',
                'title' => ['en' => 'country edit', 'ar' => 'تعديل البلد'],
            ],
            [
                'name' => 'country-status',
                'title' => ['en' => 'country status', 'ar' => 'تغير حاله البلد'],
            ],
            [
                'name' => 'country-delete',
                'title' => ['en' => 'country delete', 'ar' => 'مسح البلد'],
            ],
            [
                'name' => 'country-index-delete',
                'title' => ['en' => 'country index delete', 'ar' => 'قائمه مسح البلد'],
            ],
            [
                'name' => 'country-restore',
                'title' => ['en' => 'country restore', 'ar' => 'استرجاع البلد'],
            ],
            [
                'name' => 'country-remove',
                'title' => ['en' => 'country remove', 'ar' => 'حذف البلد'],
            ],
            //language
            [
                'name' => 'language-list',
                'title' => ['en' => 'language list', 'ar' => 'قائمه اذنات اللغه'],
            ],
            [
                'name' => 'language-index',
                'title' => ['en' => 'language index', 'ar' => 'قائمه اللغه'],
            ],
            [
                'name' => 'language-create',
                'title' => ['en' => 'language create', 'ar' => 'اضافه اللغه'],
            ],
            [
                'name' => 'language-edit',
                'title' => ['en' => 'language edit', 'ar' => 'تعديل اللغه'],
            ],
            [
                'name' => 'language-status',
                'title' => ['en' => 'language status', 'ar' => 'تغير حاله اللغه'],
            ],
            [
                'name' => 'language-delete',
                'title' => ['en' => 'language delete', 'ar' => 'مسح اللغه'],
            ],
            [
                'name' => 'language-index-delete',
                'title' => ['en' => 'language index delete', 'ar' => 'قائمه مسح اللغه'],
            ],
            [
                'name' => 'language-restore',
                'title' => ['en' => 'language restore', 'ar' => 'استرجاع اللغه'],
            ],
            [
                'name' => 'language-remove',
                'title' => ['en' => 'language remove', 'ar' => 'حذف اللغه'],
            ],
            //amenity
            [
                'name' => 'amenity-list',
                'title' => ['en' => 'amenity list', 'ar' => 'قائمه اذنات مميزات'],
            ],
            [
                'name' => 'amenity-index',
                'title' => ['en' => 'amenity index', 'ar' => 'قائمه مميزات'],
            ],
            [
                'name' => 'amenity-create',
                'title' => ['en' => 'amenity create', 'ar' => 'اضافه مميزات'],
            ],
            [
                'name' => 'amenity-edit',
                'title' => ['en' => 'amenity edit', 'ar' => 'تعديل مميزات'],
            ],
            [
                'name' => 'amenity-status',
                'title' => ['en' => 'amenity status', 'ar' => 'تغير حاله مميزات'],
            ],
            [
                'name' => 'amenity-delete',
                'title' => ['en' => 'amenity delete', 'ar' => 'مسح مميزات'],
            ],
            [
                'name' => 'amenity-index-delete',
                'title' => ['en' => 'amenity index delete', 'ar' => 'قائمه مسح مميزات'],
            ],
            [
                'name' => 'amenity-restore',
                'title' => ['en' => 'amenity restore', 'ar' => 'استرجاع مميزات'],
            ],
            [
                'name' => 'amenity-remove',
                'title' => ['en' => 'amenity remove', 'ar' => 'حذف مميزات'],
            ],
            //category
            [
                'name' => 'category-list',
                'title' => ['en' => 'category list', 'ar' => 'قائمه اذنات تخصص'],
            ],
            [
                'name' => 'category-index',
                'title' => ['en' => 'category index', 'ar' => 'قائمه تخصص'],
            ],
            [
                'name' => 'category-create',
                'title' => ['en' => 'category create', 'ar' => 'اضافه تخصص'],
            ],
            [
                'name' => 'category-edit',
                'title' => ['en' => 'category edit', 'ar' => 'تعديل تخصص'],
            ],
            [
                'name' => 'category-status',
                'title' => ['en' => 'category status', 'ar' => 'تغير حاله تخصص'],
            ],
            [
                'name' => 'category-delete',
                'title' => ['en' => 'category delete', 'ar' => 'مسح تخصص'],
            ],
            [
                'name' => 'category-index-delete',
                'title' => ['en' => 'category index delete', 'ar' => 'قائمه مسح تخصص'],
            ],
            [
                'name' => 'category-restore',
                'title' => ['en' => 'category restore', 'ar' => 'استرجاع تخصص'],
            ],
            [
                'name' => 'category-remove',
                'title' => ['en' => 'category remove', 'ar' => 'حذف تخصص'],
            ],
            //package
            [
                'name' => 'package-list',
                'title' => ['en' => 'package list', 'ar' => 'قائمه اذنات باقه'],
            ],
            [
                'name' => 'package-index',
                'title' => ['en' => 'package index', 'ar' => 'قائمه باقه'],
            ],
            [
                'name' => 'package-create',
                'title' => ['en' => 'package create', 'ar' => 'اضافه باقه'],
            ],
            [
                'name' => 'package-edit',
                'title' => ['en' => 'package edit', 'ar' => 'تعديل باقه'],
            ],
            [
                'name' => 'package-status',
                'title' => ['en' => 'package status', 'ar' => 'تغير حاله باقه'],
            ],
            [
                'name' => 'package-delete',
                'title' => ['en' => 'package delete', 'ar' => 'مسح باقه'],
            ],
            [
                'name' => 'package-index-delete',
                'title' => ['en' => 'package index delete', 'ar' => 'قائمه مسح باقه'],
            ],
            [
                'name' => 'package-restore',
                'title' => ['en' => 'package restore', 'ar' => 'استرجاع باقه'],
            ],
            [
                'name' => 'package-remove',
                'title' => ['en' => 'package remove', 'ar' => 'حذف باقه'],
            ],
            //status
            [
                'name' => 'status-list',
                'title' => ['en' => 'status list', 'ar' => 'قائمه اذنات حاله'],
            ],
            [
                'name' => 'status-index',
                'title' => ['en' => 'status index', 'ar' => 'قائمه حاله'],
            ],
            [
                'name' => 'status-create',
                'title' => ['en' => 'status create', 'ar' => 'اضافه حاله'],
            ],
            [
                'name' => 'status-edit',
                'title' => ['en' => 'status edit', 'ar' => 'تعديل حاله'],
            ],
            [
                'name' => 'status-status',
                'title' => ['en' => 'status status', 'ar' => 'تغير حاله حاله'],
            ],
            [
                'name' => 'status-delete',
                'title' => ['en' => 'status delete', 'ar' => 'مسح حاله'],
            ],
            [
                'name' => 'status-index-delete',
                'title' => ['en' => 'status index delete', 'ar' => 'قائمه مسح حاله'],
            ],
            [
                'name' => 'status-restore',
                'title' => ['en' => 'status restore', 'ar' => 'استرجاع حاله'],
            ],
            [
                'name' => 'status-remove',
                'title' => ['en' => 'status remove', 'ar' => 'حذف حاله'],
            ],
            //type
            [
                'name' => 'type-list',
                'title' => ['en' => 'type list', 'ar' => 'قائمه اذنات نوع'],
            ],
            [
                'name' => 'type-index',
                'title' => ['en' => 'type index', 'ar' => 'قائمه نوع'],
            ],
            [
                'name' => 'type-create',
                'title' => ['en' => 'type create', 'ar' => 'اضافه نوع'],
            ],
            [
                'name' => 'type-edit',
                'title' => ['en' => 'type edit', 'ar' => 'تعديل نوع'],
            ],
            [
                'name' => 'type-status',
                'title' => ['en' => 'type status', 'ar' => 'تغير حاله نوع'],
            ],
            [
                'name' => 'type-delete',
                'title' => ['en' => 'type delete', 'ar' => 'مسح نوع'],
            ],
            [
                'name' => 'type-index-delete',
                'title' => ['en' => 'type index delete', 'ar' => 'قائمه مسح نوع'],
            ],
            [
                'name' => 'type-restore',
                'title' => ['en' => 'type restore', 'ar' => 'استرجاع نوع'],
            ],
            [
                'name' => 'type-remove',
                'title' => ['en' => 'type remove', 'ar' => 'حذف نوع'],
            ],
            //highlight
            [
                'name' => 'highlight-list',
                'title' => ['en' => 'highlight list', 'ar' => 'قائمه اذنات عروض'],
            ],
            [
                'name' => 'highlight-index',
                'title' => ['en' => 'highlight index', 'ar' => 'قائمه عروض'],
            ],
            [
                'name' => 'highlight-create',
                'title' => ['en' => 'highlight create', 'ar' => 'اضافه عروض'],
            ],
            [
                'name' => 'highlight-edit',
                'title' => ['en' => 'highlight edit', 'ar' => 'تعديل عروض'],
            ],
            [
                'name' => 'highlight-status',
                'title' => ['en' => 'highlight status', 'ar' => 'تغير حاله عروض'],
            ],
            [
                'name' => 'highlight-delete',
                'title' => ['en' => 'highlight delete', 'ar' => 'مسح عروض'],
            ],
            [
                'name' => 'highlight-restore',
                'title' => ['en' => 'highlight restore', 'ar' => 'استرجاع عروض'],
            ],
            [
                'name' => 'highlight-remove',
                'title' => ['en' => 'highlight remove', 'ar' => 'حذف عروض'],
            ],
        ];
        foreach ($permission as $value) {
            $data = Permission::create(['name' => $value['name']]);
            foreach (language() as $lang) {
                $data->translation()->create(['key' => 'title', 'value' => $value['title'][$lang->code],
                    'language_id' => $lang->id]);
            }
        }
    }
}
