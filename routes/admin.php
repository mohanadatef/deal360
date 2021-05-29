<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\Acl\PermissionController;
use App\Http\Controllers\Admin\Acl\RoleController;
use App\Http\Controllers\Admin\Acl\UserController;
use App\Http\Controllers\Admin\Acl\ForgotPasswordController;
use App\Http\Controllers\Admin\CoreData\LanguageController;
use App\Http\Controllers\Admin\CoreData\StatusController;
use App\Http\Controllers\Admin\CoreData\TypeController;
use App\Http\Controllers\Admin\CoreData\CategoryController;
use App\Http\Controllers\Admin\CoreData\CountryController;
use App\Http\Controllers\Admin\CoreData\AmenityController;
use App\Http\Controllers\Admin\CoreData\CurrencyController;
use App\Http\Controllers\Admin\CoreData\CityController;
use App\Http\Controllers\Admin\CoreData\RejoinController;
use App\Http\Controllers\Admin\CoreData\PackageController;
use App\Http\Controllers\Admin\CoreData\HighLightController;
use App\Http\Controllers\Admin\Setting\MetaController;
use App\Http\Controllers\Admin\Setting\FQController;

Route::group(['middleware' => /*'admin',*/ 'auth', 'language', 'permission:dashboard-show'], function () {
    /*dashboard list*/
    Route::get('/', [HomeController::class, 'index'])->name('admin.dashboard');
    /* Core Data route list */
    /* language route list */
    Route::apiresource('language', LanguageController::class,
        ['except' => ['show', 'update']])->parameters(['language' => 'id']);
    Route::prefix('/language')->name('language.')->group(function () {
        Route::get('/change_status/{id}', [LanguageController::class, 'changeStatus'])->name('status');
        Route::get('/delete', [LanguageController::class, 'destroyIndex'])->name('delete_index');
        Route::get('/restore/{id}', [LanguageController::class, 'restore'])->name('restore');
        Route::get('/remove/{id}', [LanguageController::class, 'remove'])->name('remove');
        Route::post('/{id}', [LanguageController::class, 'update'])->name('update');
        Route::get('/{id}', [LanguageController::class, 'show'])->name('show');
    });
    /* status route list */
    Route::apiresource('status', StatusController::class,
        ['except' => ['show', 'update']])->parameters(['status' => 'id']);
    Route::prefix('/status')->name('status.')->group(function () {
        Route::get('/change_status/{id}', [StatusController::class, 'changeStatus'])->name('status');
        Route::get('/delete', [StatusController::class, 'destroyIndex'])->name('delete_index');
        Route::get('/restore/{id}', [StatusController::class, 'restore'])->name('restore');
        Route::get('/remove/{id}', [StatusController::class, 'remove'])->name('remove');
        Route::post('/{id}', [StatusController::class, 'update'])->name('update');
        Route::get('/{id}', [StatusController::class, 'show'])->name('show');
    });
    /* type route list */
    Route::apiresource('type', TypeController::class,
        ['except' => ['show', 'update']])->parameters(['type' => 'id']);
    Route::prefix('/type')->name('type.')->group(function () {
        Route::get('/change_status/{id}', [TypeController::class, 'changeStatus'])->name('status');
        Route::get('/delete', [TypeController::class, 'destroyIndex'])->name('delete_index');
        Route::get('/restore/{id}', [TypeController::class, 'restore'])->name('restore');
        Route::get('/remove/{id}', [TypeController::class, 'remove'])->name('remove');
        Route::post('/{id}', [TypeController::class, 'update'])->name('update');
        Route::get('/{id}', [TypeController::class, 'show'])->name('show');
    });
    /* category route list */
    Route::apiresource('category', CategoryController::class,
        ['except' => ['show', 'update']])->parameters(['category' => 'id']);
    Route::prefix('/category')->name('category.')->group(function () {
        Route::get('/change_status/{id}', [CategoryController::class, 'changeStatus'])->name('status');
        Route::get('/delete', [CategoryController::class, 'destroyIndex'])->name('delete_index');
        Route::get('/restore/{id}', [CategoryController::class, 'restore'])->name('restore');
        Route::get('/remove/{id}', [CategoryController::class, 'remove'])->name('remove');
        Route::post('/{id}', [CategoryController::class, 'update'])->name('update');
        Route::get('/{id}', [CategoryController::class, 'show'])->name('show');
    });
    /* country route list */
    Route::apiresource('country', CountryController::class,
        ['except' => ['show', 'update']])->parameters(['country' => 'id']);
    Route::prefix('/country')->name('country.')->group(function () {
        Route::get('/change_status/{id}', [CountryController::class, 'changeStatus'])->name('status');
        Route::get('/delete', [CountryController::class, 'destroyIndex'])->name('delete_index');
        Route::get('/restore/{id}', [CountryController::class, 'restore'])->name('restore');
        Route::get('/remove/{id}', [CountryController::class, 'remove'])->name('remove');
        Route::post('/{id}', [CountryController::class, 'update'])->name('update');
        Route::get('/{id}', [CountryController::class, 'show'])->name('show');
    });
    /* amenity route list */
    Route::apiresource('amenity', AmenityController::class,
        ['except' => ['show', 'update']])->parameters(['amenity' => 'id']);
    Route::prefix('/amenity')->name('amenity.')->group(function () {
        Route::get('/change_status/{id}', [AmenityController::class, 'changeStatus'])->name('status');
        Route::get('/delete', [AmenityController::class, 'destroyIndex'])->name('delete_index');
        Route::get('/restore/{id}', [AmenityController::class, 'restore'])->name('restore');
        Route::get('/remove/{id}', [AmenityController::class, 'remove'])->name('remove');
        Route::post('/{id}', [AmenityController::class, 'update'])->name('update');
        Route::get('/{id}', [AmenityController::class, 'show'])->name('show');
    });
    /* city route list */
    Route::apiresource('city', CityController::class,
        ['except' => ['show', 'update']])->parameters(['city' => 'id']);
    Route::prefix('/city')->name('city.')->group(function () {
        Route::get('/change_status/{id}', [CityController::class, 'changeStatus'])->name('status');
        Route::get('/delete', [CityController::class, 'destroyIndex'])->name('delete_index');
        Route::get('/restore/{id}', [CityController::class, 'restore'])->name('restore');
        Route::get('/remove/{id}', [CityController::class, 'remove'])->name('remove');
        Route::post('/{id}', [CityController::class, 'update'])->name('update');
        Route::get('/{id}', [CityController::class, 'show'])->name('show');
    });
    /* package route list */
    Route::resource('package', PackageController::class,
        ['except' => ['show', 'update']])->parameters(['package' => 'id']);
    Route::prefix('/package')->name('package.')->group(function () {
        Route::get('/change_status/{id}', [PackageController::class, 'changeStatus'])->name('status');
        Route::get('/delete', [PackageController::class, 'destroyIndex'])->name('delete_index');
        Route::get('/restore/{id}', [PackageController::class, 'restore'])->name('restore');
        Route::get('/remove/{id}', [PackageController::class, 'remove'])->name('remove');
        Route::post('/{id}', [PackageController::class, 'update'])->name('update');
    });
    /* highlight route list */
    Route::apiresource('highlight', HighLightController::class,
        ['except' => ['show', 'update']])->parameters(['highlight' => 'id']);
    Route::prefix('/highlight')->name('highlight.')->group(function () {
        Route::get('/change_status/{id}', [HighLightController::class, 'changeStatus'])->name('status');
        Route::get('/delete', [HighLightController::class, 'destroyIndex'])->name('delete_index');
        Route::get('/restore/{id}', [HighLightController::class, 'restore'])->name('restore');
        Route::get('/remove/{id}', [HighLightController::class, 'remove'])->name('remove');
        Route::post('/{id}', [HighLightController::class, 'update'])->name('update');
        Route::get('/{id}', [HighLightController::class, 'show'])->name('show');
    });
    /* currency route list */
    Route::apiresource('currency', CurrencyController::class,
        ['except' => ['show', 'update']])->parameters(['currency' => 'id']);
    Route::prefix('/currency')->name('currency.')->group(function () {
        Route::get('/change_status/{id}', [CurrencyController::class, 'changeStatus'])->name('status');
        Route::get('/delete', [CurrencyController::class, 'destroyIndex'])->name('delete_index');
        Route::get('/restore/{id}', [CurrencyController::class, 'restore'])->name('restore');
        Route::get('/remove/{id}', [CurrencyController::class, 'remove'])->name('remove');
        Route::post('/{id}', [CurrencyController::class, 'update'])->name('update');
        Route::get('/{id}', [CurrencyController::class, 'show'])->name('show');
    });
    /* rejoin route list */
    Route::apiresource('rejoin', RejoinController::class,
        ['except' => ['show', 'update']])->parameters(['rejoin' => 'id']);
    Route::prefix('/rejoin')->name('rejoin.')->group(function () {
        Route::get('/change_status/{id}', [RejoinController::class, 'changeStatus'])->name('status');
        Route::get('/delete', [RejoinController::class, 'destroyIndex'])->name('delete_index');
        Route::get('/restore/{id}', [RejoinController::class, 'restore'])->name('restore');
        Route::get('/remove/{id}', [RejoinController::class, 'remove'])->name('remove');
        Route::post('/{id}', [RejoinController::class, 'update'])->name('update');
        Route::get('/{id}', [RejoinController::class, 'show'])->name('show');
    });
    /* Setting route list */
    /* meta route list */
    Route::apiresource('meta', MetaController::class,
        ['except' => ['show', 'update']])->parameters(['meta' => 'id']);
    Route::prefix('/meta')->name('meta.')->group(function () {
        Route::get('/change_status/{id}', [MetaController::class, 'changeStatus'])->name('status');
        Route::get('/delete', [MetaController::class, 'destroyIndex'])->name('delete_index');
        Route::get('/restore/{id}', [MetaController::class, 'restore'])->name('restore');
        Route::get('/remove/{id}', [MetaController::class, 'remove'])->name('remove');
        Route::post('/{id}', [MetaController::class, 'update'])->name('update');
        Route::get('/{id}', [MetaController::class, 'show'])->name('show');
    });
    /* fq route list */
    Route::apiresource('fq', FQController::class,
        ['except' => ['show', 'update']])->parameters(['fq' => 'id']);
    Route::prefix('/fq')->name('fq.')->group(function () {
        Route::get('/change_status/{id}', [FQController::class, 'changeStatus'])->name('status');
        Route::get('/delete', [FQController::class, 'destroyIndex'])->name('delete_index');
        Route::get('/restore/{id}', [FQController::class, 'restore'])->name('restore');
        Route::get('/remove/{id}', [FQController::class, 'remove'])->name('remove');
        Route::post('/{id}', [FQController::class, 'update'])->name('update');
        Route::get('/{id}', [FQController::class, 'show'])->name('show');
    });
    /* Acl route list */
    /*permission route list */
    Route::apiresource('permission', PermissionController::class,
        ['except' => ['show', 'update']])->parameters(['permission' => 'id']);
    Route::prefix('/permission')->name('permission.')->group(function () {
        Route::get('/delete', [PermissionController::class, 'destroyIndex'])->name('delete_index');
        Route::get('/restore/{id}', [PermissionController::class, 'restore'])->name('restore');
        Route::get('/remove/{id}', [PermissionController::class, 'remove'])->name('remove');
        Route::post('/{id}', [PermissionController::class, 'update'])->name('update');
        Route::get('/{id}', [PermissionController::class, 'show'])->name('show');
    });
    /* role route list */
    Route::resource('role', RoleController::class,
        ['except' => ['show', 'update']])->parameters(['role' => 'id']);
    Route::prefix('/role')->name('role.')->group(function () {
        Route::get('/change_status/{id}', [RoleController::class, 'changeStatus'])->name('status');
        Route::get('/delete', [RoleController::class, 'destroyIndex'])->name('delete_index');
        Route::get('/restore/{id}', [RoleController::class, 'restore'])->name('restore');
        Route::get('/remove/{id}', [RoleController::class, 'remove'])->name('remove');
        Route::post('/{id}', [RoleController::class, 'update'])->name('update');
    });
    /* user route list */
    Route::resource('user', UserController::class,
        ['except' => ['show', 'update']])->parameters(['user' => 'id']);
    Route::prefix('/user')->name('user.')->group(function () {
        Route::get('/change_status/{id}', [UserController::class, 'changeStatus'])->name('status');
        Route::get('/delete', [UserController::class, 'destroyIndex'])->name('delete_index');
        Route::get('/restore/{id}', [UserController::class, 'restore'])->name('restore');
        Route::get('/remove/{id}', [UserController::class, 'remove'])->name('remove');
        Route::post('/{id}', [UserController::class, 'update'])->name('update');
    });
    /* forgot password route list */
    Route::prefix('/forgotpassword')->name('forgotpassword.')->group(function () {
        Route::post('/{id}', [ForgotPasswordController::class, 'update'])->name('update');
    });
});
