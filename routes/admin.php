<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\Acl\PermissionController;
use App\Http\Controllers\Admin\Acl\RoleController;
use App\Http\Controllers\Admin\Acl\UserController;
use App\Http\Controllers\Admin\CoreData\LanguageController;
use App\Http\Controllers\Admin\CoreData\StatusController;
use App\Http\Controllers\Admin\CoreData\TypeController;
use App\Http\Controllers\Admin\CoreData\CategoryController;
use App\Http\Controllers\Admin\CoreData\CountryController;
use App\Http\Controllers\Admin\CoreData\AmenityController;
use App\Http\Controllers\Admin\CoreData\CityController;
use App\Http\Controllers\Admin\CoreData\AreaController;
use App\Http\Controllers\Admin\CoreData\PackageController;
use App\Http\Controllers\Admin\CoreData\HighLightController;
use App\Http\Controllers\Admin\Setting\MetaController;

Route::group(['middleware' => /*'admin', 'auth',*/ 'language' /*, 'permission:dashboard-show'*/], function () {
/*dashboard list*/
Route::get('/', [HomeController::class, 'index'])
    /*->middleware('permission:dashboard-show')*/
    ->name('admin.dashboard');
/* Core Data route list */
/*Route::middleware('permission:core-data-list')->group(function () {*/
/* language route list */
/*Route::middleware('permission:language-list')->group(function () {*/
Route::apiresource('language', LanguageController::class,
    ['except' => ['show', 'update']])->parameters(['language' => 'id']);
Route::prefix('/language')->name('language.')->group(function () {
    Route::get('/change_status/{id}', [LanguageController::class, 'changeStatus'])
        /*->middleware('permission:language-status')*/ ->name('status');
    Route::get('/delete', [LanguageController::class, 'destroyIndex'])
        /*->middleware('permission:language-delete')*/ ->name('delete_index');
    Route::get('/restore/{id}', [LanguageController::class, 'restore'])
        /*->middleware('permission:language-restore')*/ ->name('restore');
    Route::get('/remove/{id}', [LanguageController::class, 'remove'])
        /*->middleware('permission:language-remove')*/ ->name('remove');
    Route::post('/{id}', [LanguageController::class, 'update'])
        /*->middleware('permission:language-edit')*/ ->name('update');
    Route::get('/{id}', [LanguageController::class, 'show'])
        /*->middleware('permission:language-show')*/ ->name('show');
});
/* });*/
/* status route list */
/*Route::middleware('permission:status-list')->group(function () {*/
Route::apiresource('status', StatusController::class,
    ['except' => ['show','update']])->parameters(['status' => 'id']);
Route::prefix('/status')->name('status.')->group(function () {
    Route::get('/change_status/{id}', [StatusController::class, 'changeStatus'])
        /*->middleware('permission:status-status')*/ ->name('status');
    Route::get('/delete', [StatusController::class, 'destroyIndex'])
        /*->middleware('permission:status-delete')*/ ->name('delete_index');
    Route::get('/restore/{id}', [StatusController::class, 'restore'])
        /*->middleware('permission:status-restore')*/ ->name('restore');
    Route::get('/remove/{id}', [StatusController::class, 'remove'])
        /*->middleware('permission:status-remove')*/ ->name('remove');
    Route::post('/{id}', [StatusController::class, 'update'])
        /*->middleware('permission:status-edit')*/ ->name('update');
    Route::get('/{id}', [StatusController::class, 'show'])
        /*->middleware('permission:status-show')*/ ->name('show');
});
/* });*/
/* type route list */
/*Route::middleware('permission:type-list')->group(function () {*/
Route::apiresource('type', TypeController::class,
    ['except' => ['show','update']])->parameters(['type' => 'id']);
Route::prefix('/type')->name('type.')->group(function () {
    Route::get('/change_status/{id}', [TypeController::class, 'changeStatus'])
        /*->middleware('permission:type-status')*/ ->name('status');
    Route::get('/delete', [TypeController::class, 'destroyIndex'])
        /*->middleware('permission:type-delete')*/ ->name('delete_index');
    Route::get('/restore/{id}', [TypeController::class, 'restore'])
        /*->middleware('permission:type-restore')*/ ->name('restore');
    Route::get('/remove/{id}', [TypeController::class, 'remove'])
        /*->middleware('permission:type-remove')*/ ->name('remove');
    Route::post('/{id}', [TypeController::class, 'update'])
        /*->middleware('permission:type-edit')*/ ->name('update');
    Route::get('/{id}', [TypeController::class, 'show'])
        /*->middleware('permission:type-show')*/ ->name('show');
});
/* });*/
/* category route list */
/*Route::middleware('permission:category-list')->group(function () {*/
Route::apiresource('category', CategoryController::class,
    ['except' => ['show','update']])->parameters(['category' => 'id']);
Route::prefix('/category')->name('category.')->group(function () {
    Route::get('/change_status/{id}', [CategoryController::class, 'changeStatus'])
        /*->middleware('permission:category-status')*/ ->name('status');
    Route::get('/delete', [CategoryController::class, 'destroyIndex'])
        /*->middleware('permission:category-delete')*/ ->name('delete_index');
    Route::get('/restore/{id}', [CategoryController::class, 'restore'])
        /*->middleware('permission:category-restore')*/ ->name('restore');
    Route::get('/remove/{id}', [CategoryController::class, 'remove'])
        /*->middleware('permission:category-remove')*/ ->name('remove');
    Route::post('/{id}', [CategoryController::class, 'update'])
        /*->middleware('permission:category-edit')*/ ->name('update');
    Route::get('/{id}', [CategoryController::class, 'show'])
        /*->middleware('permission:category-show')*/ ->name('show');
});
/* });*/
/* country route list */
/*Route::middleware('permission:country-list')->group(function () {*/
Route::apiresource('country', CountryController::class,
    ['except' => ['show','update']])->parameters(['country' => 'id']);
Route::prefix('/country')->name('country.')->group(function () {
    Route::get('/change_status/{id}', [CountryController::class, 'changeStatus'])
        /*->middleware('permission:country-status')*/ ->name('status');
    Route::get('/delete', [CountryController::class, 'destroyIndex'])
        /*->middleware('permission:country-delete')*/ ->name('delete_index');
    Route::get('/restore/{id}', [CountryController::class, 'restore'])
        /*->middleware('permission:country-restore')*/ ->name('restore');
    Route::get('/remove/{id}', [CountryController::class, 'remove'])
        /*->middleware('permission:country-remove')*/ ->name('remove');
    Route::post('/{id}', [CountryController::class, 'update'])
        /*->middleware('permission:country-edit')*/ ->name('update');
    Route::get('/{id}', [CountryController::class, 'show'])
        /*->middleware('permission:country-show')*/ ->name('show');
});
/* });*/
/* amenity route list */
/*Route::middleware('permission:amenity-list')->group(function () {*/
Route::apiresource('amenity', AmenityController::class,
    ['except' => ['show','update']])->parameters(['amenity' => 'id']);
Route::prefix('/amenity')->name('amenity.')->group(function () {
    Route::get('/change_status/{id}', [AmenityController::class, 'changeStatus'])
        /*->middleware('permission:amenity-status')*/ ->name('status');
    Route::get('/delete', [AmenityController::class, 'destroyIndex'])
        /*->middleware('permission:amenity-delete')*/ ->name('delete_index');
    Route::get('/restore/{id}', [AmenityController::class, 'restore'])
        /*->middleware('permission:amenity-restore')*/ ->name('restore');
    Route::get('/remove/{id}', [AmenityController::class, 'remove'])
        /*->middleware('permission:amenity-remove')*/ ->name('remove');
    Route::post('/{id}', [AmenityController::class, 'update'])
        /*->middleware('permission:amenity-edit')*/ ->name('update');
    Route::get('/{id}', [AmenityController::class, 'show'])
        /*->middleware('permission:amenity-show')*/ ->name('show');
});
/* });*/
/* city route list */
/*Route::middleware('permission:city-list')->group(function () {*/
Route::apiresource('city', CityController::class,
    ['except' => ['show','update']])->parameters(['city' => 'id']);
Route::prefix('/city')->name('city.')->group(function () {
    Route::get('/change_status/{id}', [CityController::class, 'changeStatus'])
        /*->middleware('permission:city-status')*/ ->name('status');
    Route::get('/delete', [CityController::class, 'destroyIndex'])
        /*->middleware('permission:city-delete')*/ ->name('delete_index');
    Route::get('/restore/{id}', [CityController::class, 'restore'])
        /*->middleware('permission:city-restore')*/ ->name('restore');
    Route::get('/remove/{id}', [CityController::class, 'remove'])
        /*->middleware('permission:city-remove')*/ ->name('remove');
    Route::post('/{id}', [CityController::class, 'update'])
        /*->middleware('permission:city-edit')*/ ->name('update');
    Route::get('/{id}', [CityController::class, 'show'])
        /*->middleware('permission:city-show')*/ ->name('show');
});
/* });*/
/* package route list */
/*Route::middleware('permission:package-list')->group(function () {*/
Route::apiresource('package', PackageController::class,
    ['except' => ['show','update']])->parameters(['package' => 'id']);
Route::prefix('/package')->name('package.')->group(function () {
    Route::get('/change_status/{id}', [PackageController::class, 'changeStatus'])
        /*->middleware('permission:package-status')*/ ->name('status');
    Route::get('/delete', [PackageController::class, 'destroyIndex'])
        /*->middleware('permission:package-delete')*/ ->name('delete_index');
    Route::get('/restore/{id}', [PackageController::class, 'restore'])
        /*->middleware('permission:package-restore')*/ ->name('restore');
    Route::get('/remove/{id}', [PackageController::class, 'remove'])
        /*->middleware('permission:package-remove')*/ ->name('remove');
    Route::post('/{id}', [PackageController::class, 'update'])
        /*->middleware('permission:package-edit')*/ ->name('update');
    Route::get('/{id}', [PackageController::class, 'show'])
        /*->middleware('permission:package-show')*/ ->name('show');
});
/* });*/
/* highlight route list */
/*Route::middleware('permission:highlight-list')->group(function () {*/
Route::apiresource('highlight', HighLightController::class,
    ['except' => ['show','update']])->parameters(['highlight' => 'id']);
Route::prefix('/highlight')->name('highlight.')->group(function () {
    Route::get('/change_status/{id}', [HighLightController::class, 'changeStatus'])
        /*->middleware('permission:highlight-status')*/ ->name('status');
    Route::get('/delete', [HighLightController::class, 'destroyIndex'])
        /*->middleware('permission:highlight-delete')*/ ->name('delete_index');
    Route::get('/restore/{id}', [HighLightController::class, 'restore'])
        /*->middleware('permission:highlight-restore')*/ ->name('restore');
    Route::get('/remove/{id}', [HighLightController::class, 'remove'])
        /*->middleware('permission:highlight-remove')*/ ->name('remove');
    Route::post('/{id}', [HighLightController::class, 'update'])
        /*->middleware('permission:highlight-edit')*/ ->name('update');
    Route::get('/{id}', [HighLightController::class, 'show'])
        /*->middleware('permission:highlight-show')*/ ->name('show');
});
/* });*/
/* area route list */
/*Route::middleware('permission:area-list')->group(function () {*/
Route::apiresource('area', AreaController::class,
    ['except' => ['show','update']])->parameters(['area' => 'id']);
Route::prefix('/area')->name('area.')->group(function () {
    Route::get('/change_status/{id}', [AreaController::class, 'changeStatus'])
        /*->middleware('permission:area-status')*/ ->name('status');
    Route::get('/delete', [AreaController::class, 'destroyIndex'])
        /*->middleware('permission:area-delete')*/ ->name('delete_index');
    Route::get('/restore/{id}', [AreaController::class, 'restore'])
        /*->middleware('permission:area-restore')*/ ->name('restore');
    Route::get('/remove/{id}', [AreaController::class, 'remove'])
        /*->middleware('permission:area-remove')*/ ->name('remove');
    Route::post('/{id}', [AreaController::class, 'update'])
        /*->middleware('permission:area-edit')*/ ->name('update');
    Route::get('/{id}', [AreaController::class, 'show'])
        /*->middleware('permission:area-show')*/ ->name('show');
});
/* });*/
    /* meta route list */
    /*Route::middleware('permission:meta-list')->group(function () {*/
    Route::apiresource('meta', MetaController::class,
        ['except' => ['show','update']])->parameters(['meta' => 'id']);
    Route::prefix('/meta')->name('meta.')->group(function () {
        Route::get('/change_status/{id}', [MetaController::class, 'changeStatus'])
            /*->middleware('permission:meta-status')*/ ->name('status');
        Route::get('/delete', [MetaController::class, 'destroyIndex'])
            /*->middleware('permission:meta-delete')*/ ->name('delete_index');
        Route::get('/restore/{id}', [MetaController::class, 'restore'])
            /*->middleware('permission:meta-restore')*/ ->name('restore');
        Route::get('/remove/{id}', [MetaController::class, 'remove'])
            /*->middleware('permission:meta-remove')*/ ->name('remove');
        Route::post('/{id}', [MetaController::class, 'update'])
            /*->middleware('permission:meta-edit')*/ ->name('update');
        Route::get('/{id}', [MetaController::class, 'show'])
            /*->middleware('permission:meta-show')*/ ->name('show');
    });
    /* });*/
    /* Acl route list */
    /*Route::middleware('permission:acl-list')->group(function () {*/
    /* permission route list */
    /*Route::middleware('permission:permission-list')->group(function () {*/
    Route::apiresource('permission', PermissionController::class,
        ['except' => ['show', 'update']])->parameters(['permission' => 'id']);
    Route::prefix('/permission')->name('permission.')->group(function () {
        Route::get('/delete', [PermissionController::class, 'destroyIndex'])
            /*->middleware('permission:permission-delete')*/ ->name('delete_index');
        Route::get('/restore/{id}', [PermissionController::class, 'restore'])
            /*->middleware('permission:permission-restore')*/ ->name('restore');
        Route::get('/remove/{id}', [PermissionController::class, 'remove'])
            /*->middleware('permission:permission-remove')*/ ->name('remove');
        Route::post('/{id}', [PermissionController::class, 'update'])
            /*->middleware('permission:permission-edit')*/ ->name('update');
        Route::get('/{id}', [PermissionController::class, 'show'])
            /*->middleware('permission:permission-show')*/ ->name('show');
    });
    /* });*/
    /* role route list */
    /*Route::middleware('permission:role-list')->group(function () {*/
    Route::resource('role', RoleController::class,
        ['except' => ['show', 'update']])->parameters(['role' => 'id']);
    Route::prefix('/role')->name('role.')->group(function () {
        Route::get('/change_status/{id}', [RoleController::class, 'changeStatus'])
            /*->middleware('permission:role-status')*/ ->name('status');
        Route::get('/delete', [RoleController::class, 'destroyIndex'])
            /*->middleware('permission:role-delete')*/ ->name('delete_index');
        Route::get('/restore/{id}', [RoleController::class, 'restore'])
            /*->middleware('permission:role-restore')*/ ->name('restore');
        Route::get('/remove/{id}', [RoleController::class, 'remove'])
            /*->middleware('permission:role-remove')*/ ->name('remove');
        Route::post('/{id}', [RoleController::class, 'update'])
            /*->middleware('permission:role-edit')*/ ->name('update');
    });
    /* });*/
    /* user route list */
    /*Route::middleware('permission:user-list')->group(function () {*/
    Route::resource('user', UserController::class,
        ['except' => ['show', 'update']])->parameters(['user' => 'id']);
    Route::prefix('/user')->name('user.')->group(function () {
        Route::get('/change_status/{id}', [UserController::class, 'changeStatus'])
            /*->middleware('permission:user-status')*/ ->name('status');
        Route::get('/delete', [UserController::class, 'destroyIndex'])
            /*->middleware('permission:user-delete')*/ ->name('delete_index');
        Route::get('/restore/{id}', [UserController::class, 'restore'])
            /*->middleware('permission:user-restore')*/ ->name('restore');
        Route::get('/remove/{id}', [UserController::class, 'remove'])
            /*->middleware('permission:user-remove')*/ ->name('remove');
        Route::post('/{id}', [UserController::class, 'update'])
            /*->middleware('permission:user-edit')*/ ->name('update');
    });
    /* });*/
    /* });*/
});
