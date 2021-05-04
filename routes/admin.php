<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\Acl\UserController;
use App\Http\Controllers\Admin\Acl\RoleController;
use App\Http\Controllers\Admin\Acl\PermissionController;
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

Route::group(['middleware' => /*'admin', 'auth',*/ 'language' /*, 'permission:dashboard-show'*/], function () {
/* error dashboard list */
Route::get('/', [HomeController::class, 'index'])
    /*->middleware('permission:dashboard-show')*/
    ->name('admin.dashboard');
/* error route list */
Route::get('/error/403', [HomeController::class, 'error_403'])->name('error.403');
/* Acl route list */
Route::middleware('permission:acl-list')->group(function () {
    /* user route list */
    Route::middleware('permission:user-list')->group(function () {
        Route::resource('user', UserController::class)->parameters(['user' => 'id']);
        Route::prefix('/user')->group(function () {
            Route::get('/change_status/{id}', [UserController::class, 'change_status'])
                ->middleware('permission:user-status')->name('user.status');
            Route::get('/change_many_status', [UserController::class, 'change_many_status'])
                ->middleware('permission:user-many-status')->name('language.many_status');
        });
    });
    /* role route list */
    Route::middleware('permission:role-list')->group(function () {
        Route::resource('role', RoleController::class)->parameters(['role' => 'id']);
        Route::prefix('/role')->group(function () {
            Route::get('/change_status/{id}', [RoleController::class, 'change_status'])
                ->middleware('permission:role-status')->name('role.status');
            Route::get('/change_many_status', [RoleController::class, 'change_many_status'])
                ->middleware('permission:role-many-status')->name('language.many_status');
        });
    });
    /* permission route list */
    Route::middleware('permission:permission-list')->group(function () {
        Route::resource('permission', PermissionController::class)->parameters(['permission' => 'id']);
        Route::prefix('/permission')->group(function () {
            Route::get('/change_status/{id}', [PermissionController::class, 'change_status'])
                ->middleware('permission:permission-status')->name('permission.status');
            Route::get('/change_many_status', [PermissionController::class, 'change_many_status'])
                ->middleware('permission:permission-many-status')->name('language.many_status');
        });
    });
});
/* Core Data route list */
/*Route::middleware('permission:core-data-list')->group(function () {*/
/* language route list */
/*Route::middleware('permission:language-list')->group(function () {*/
Route::apiresource('language', LanguageController::class,
    ['except' => ['show', 'update']])->parameters(['language' => 'id']);
Route::prefix('/language')->name('language.')->group(function () {
    Route::get('/change_status/{id}', [LanguageController::class, 'change_status'])
        /*->middleware('permission:language-status')*/ ->name('status');
    Route::get('/delete', [LanguageController::class, 'destroy_index'])
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
    Route::get('/change_status/{id}', [StatusController::class, 'change_status'])
        /*->middleware('permission:status-status')*/ ->name('status');
    Route::get('/delete', [StatusController::class, 'destroy_index'])
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
    Route::get('/change_status/{id}', [TypeController::class, 'change_status'])
        /*->middleware('permission:type-status')*/ ->name('status');
    Route::get('/delete', [TypeController::class, 'destroy_index'])
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
    Route::get('/change_status/{id}', [CategoryController::class, 'change_status'])
        /*->middleware('permission:category-status')*/ ->name('status');
    Route::get('/delete', [CategoryController::class, 'destroy_index'])
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
    Route::get('/change_status/{id}', [CountryController::class, 'change_status'])
        /*->middleware('permission:country-status')*/ ->name('status');
    Route::get('/delete', [CountryController::class, 'destroy_index'])
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
    Route::get('/change_status/{id}', [AmenityController::class, 'change_status'])
        /*->middleware('permission:amenity-status')*/ ->name('status');
    Route::get('/delete', [AmenityController::class, 'destroy_index'])
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
    Route::get('/change_status/{id}', [CityController::class, 'change_status'])
        /*->middleware('permission:city-status')*/ ->name('status');
    Route::get('/delete', [CityController::class, 'destroy_index'])
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
    Route::get('/change_status/{id}', [PackageController::class, 'change_status'])
        /*->middleware('permission:package-status')*/ ->name('status');
    Route::get('/delete', [PackageController::class, 'destroy_index'])
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
    Route::get('/change_status/{id}', [HighLightController::class, 'change_status'])
        /*->middleware('permission:highlight-status')*/ ->name('status');
    Route::get('/delete', [HighLightController::class, 'destroy_index'])
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
    Route::get('/change_status/{id}', [AreaController::class, 'change_status'])
        /*->middleware('permission:area-status')*/ ->name('status');
    Route::get('/delete', [AreaController::class, 'destroy_index'])
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
});
