<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\App;
use \App\Models\CoreData\Language;

if (!function_exists('languageLocale')) {
    function languageLocale()
    {
        return App::getLocale();
    }
}

if (!function_exists('language')) {
    function language()
    {
        return Language::Order('asc')->get();
    }
}

if (!function_exists('languageActive')) {
    function languageActive()
    {
        return Language::status('1')->Order('asc')->get();
    }
}

if (!function_exists('permissionShow')) {
    function permissionShow($title)
    {
        $permission = DB::table('permissions')
            ->join('permission_roles', 'permission_roles.permission_id', '=', 'permissions.id')
            ->where('permission_roles.role_id', Auth::user()->role_id)
            ->where('permissions.title', $title)
            ->count();
        return $permission ? true : false;
    }
}

if (!function_exists('changeLocaleLanguage')) {
    function changeLocaleLanguage($id)
    {
        $id ? App::setLocale(checkLocaleLanguage($id)) : false;
    }
}

if (!function_exists('checkLocaleLanguage')) {
    function checkLocaleLanguage($id)
    {
        return $id ? Language::find($id) ? Language::find($id)->code : languageLocale() : languageLocale();
    }
}

if (!function_exists('language_id')) {
    function languageId()
    {
        return Language::where('code', App::getLocale())->first()->id;
    }
}

if (!function_exists('checkView')) {
    function checkView($view)
    {
        return view()->exists($view) ? $view : 'errors.404';
    }
}

if (!function_exists('getImag')) {
    function getImag($image, $file_name)
    {
        $images = isset($image) ? public_path('images/' . $file_name . '/' . $image->image) : public_path('images/test.png');
        if (file_exists($images) == false) {
            return asset('public/images/test.png');
        } else {
            return asset('public/images/' . $file_name . '/' . $image->image);
        }
    }
}
