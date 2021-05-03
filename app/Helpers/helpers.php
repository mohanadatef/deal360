<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\App;
use \App\Models\CoreData\Language;

if (!function_exists('Language_Locale')) {
    function Language_Locale()
    {
        return App::getLocale();
    }
}

if (!function_exists('Language')) {
    function Language()
    {
        return Language::Order('asc')->get();
    }
}

if (!function_exists('permission_show')) {
    function permission_show($title)
    {
        $permission = DB::table('permissions')
            ->join('permission_roles', 'permission_roles.permission_id', '=', 'permissions.id')
            ->where('permission_roles.role_id', Auth::user()->role_id)
            ->where('permissions.title', $title)
            ->count();
        return $permission ? true : false;
    }
}

if (!function_exists('change_locale_language')) {
    function change_locale_language($id)
    {
        $id ? App::setLocale(check_locale_language($id)) : false;
    }
}

if (!function_exists('check_locale_language')) {
    function check_locale_language($id)
    {
        return $id ? Language::find($id) ? Language::find($id)->code : Language_Locale() : Language_Locale();
    }
}

if (!function_exists('Language_id')) {
    function Language_id()
    {
        return Language::where('code', App::getLocale())->select('id')->first();
    }
}

if (!function_exists('Language_code')) {
    function Language_code($code)
    {
        return Language::where('code', $code)->select('id')->first();
    }
}

if (!function_exists('Language_code_by_id')) {
    function Language_code_by_id($id)
    {
        return Language::find($id)->code;
    }
}

if (!function_exists('check_view')) {
    function check_view($view)
    {
        return view()->exists($view) ? $view : 'errors.404';
    }
}

if (!function_exists('image_get')) {
    function image_get($image, $file_name)
    {
        $images = isset($image) ? public_path('images/' . $file_name . '/' . $image->image) : public_path('images/test.png');
        if (file_exists($images) == false) {
            return asset('public/images/test.png');
        } else {
            return asset('public/images/' . $file_name . '/' . $image->image);
        }
    }
}
