<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use App\Models\CoreData\Language;
use Illuminate\Support\Facades\Schema;

//get locale from app file
if (!function_exists('languageLocale')) {
    function languageLocale()
    {
        return App::getLocale();
    }
}
//get all language
if (!function_exists('language')) {
    function language()
    {
        if (Schema::hasTable('languages'))//check in table exit in database
        {
            return Language::Order('asc')->get();
        }
    }
}
//get all language for status is 1
if (!function_exists('languageActive')) {
    function languageActive()
    {
        if (Schema::hasTable('languages'))//check in table exit in database
        {
            //status function in model
            //order function in model
            return Language::status('1')->order('asc')->get();
        }
    }
}
//check permission name if in role for user
if (!function_exists('permissionShow')) {
    //$name => permission name we want check it
    function permissionShow($name)
    {
        return cache()->remember('permission_show', 60 * 60 * 60, function () use ($name) {
            return DB::table('permissions')
                ->join('role_permissions', 'role_permissions.permission_id', '=', 'permissions.id')
                ->where('role_permissions.role_id', Auth::user()->role_id)->where('permissions.name', $name)->count();
        });
    }
}
//change locale language in app function
if (!function_exists('changeLocaleLanguage')) {
    //$id => language id we want change it
    function changeLocaleLanguage($id)
    {
        $id ? App::setLocale(checkLocaleLanguage($id)) : false;
    }
}
//get code language by id if not found id return locale code language
if (!function_exists('checkLocaleLanguage')) {
    //$id => language id we want get code it
    function checkLocaleLanguage($id)
    {
        return $id ? Language::find($id) ? Language::find($id)->code : languageLocale() : languageLocale();
    }
}
//get id language by code
if (!function_exists('language_id')) {
    function languageId()
    {
        return Language::where('code', App::getLocale())->first()->id;
    }
}
//check view if exists or return page 404
if (!function_exists('checkView')) {
    //$view => name view we want check it
    function checkView($view)
    {
        return view()->exists($view) ? $view : 'errors.404';
    }
}
//return image but if not found return default image
if (!function_exists('getImag')) {
    //$image => name image we want get it
    //$file_name => name file we will found image it
    function getImag($image, $file_name)
    {
        if ($image) {
            $images = isset($image) ? public_path('images/' . $file_name . '/' . $image->image) : public_path('images/test.png');
            if (file_exists($images) == false) {
                return asset('public/images/test.png');//image default
            } else {
                return asset('public/images/' . $file_name . '/' . $image->image);//image we want get it
            }
        } else {
            return asset('public/images/test.png'); //image default
        }
    }
}
//execution time to start again
if (!function_exists('executionTime')) {
    function executionTime()
    {
        ini_set('max_execution_time', 120000);
        ini_set('post_max_size', 120000);
        ini_set('upload_max_filesize', 100000);
    }
}
//names day of week
if (!function_exists('nameDay')) {
    function nameDay()
    {
        return array('saturday', 'sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday');
    }
}
