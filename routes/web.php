<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CoreData\LanguageController;
use App\Http\Controllers\Admin\CoreData\StatusController;
use App\Http\Controllers\Admin\CoreData\TypeController;
use App\Http\Controllers\Admin\CoreData\CurrencyController;
use App\Http\Controllers\Admin\CoreData\CategoryController;
use App\Http\Controllers\Admin\CoreData\CountryController;
use App\Http\Controllers\Admin\CoreData\CityController;
use App\Http\Controllers\Admin\CoreData\RejoinController;
use App\Http\Controllers\Admin\CoreData\AmenityController;
use App\Http\Controllers\Admin\CoreData\PackageController;
use App\Http\Controllers\Admin\CoreData\HighLightController;
use App\Http\Controllers\Admin\Setting\MetaController;
use App\Http\Controllers\Admin\Setting\FQController;
use App\Http\Controllers\Admin\Acl\PermissionController;
use App\Http\Controllers\Admin\Acl\RoleController;
use App\Http\Controllers\Admin\Acl\AgencyController;
use App\Http\Controllers\Admin\Acl\DeveloperController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
//core data
//language
Route::prefix('/language')->group(function () {
    Route::get('/list', [LanguageController::class, 'listIndex'])
        ->name('language.list');
    Route::post('/setLang', [LanguageController::class, 'language'])
    ->name('setLang');
});
//status
Route::prefix('/status')->group(function () {
    Route::get('/list', [StatusController::class, 'listIndex'])
        ->name('status.list');
});
//type
Route::prefix('/type')->group(function () {
    Route::get('/list', [TypeController::class, 'listIndex'])
        ->name('type.list');
});
//category
Route::prefix('/category')->group(function () {
    Route::get('/list', [CategoryController::class, 'listIndex'])
        ->name('category.list');
});
//country
Route::prefix('/country')->group(function () {
    Route::get('/list', [CountryController::class, 'listIndex'])
        ->name('country.list');
});
//city
Route::prefix('/city')->group(function () {
    Route::get('/list/{country}', [CityController::class, 'listIndex'])
        ->name('city.list');
});
//area
Route::prefix('/rejoin')->group(function () {
    Route::get('/list/{country}/{city}', [RejoinController::class, 'listIndex'])
        ->name('area.list');
});
//amenity
Route::prefix('/amenity')->group(function () {
    Route::get('/list', [AmenityController::class, 'listIndex'])
        ->name('amenity.list');
});
//package
Route::prefix('/package')->group(function () {
    Route::get('/list', [PackageController::class, 'listIndex'])
        ->name('package.list');
});
//currency
Route::prefix('/currency')->group(function () {
    Route::get('/list', [CurrencyController::class, 'listIndex'])
        ->name('currency.list');
});
//high light
Route::prefix('/highlight')->group(function () {
    Route::get('/list', [HighLightController::class, 'listIndex'])
        ->name('highlight.list');
});
//setting
//meta
Route::prefix('/meta')->group(function () {
    Route::get('/list', [MetaController::class, 'listIndex'])
        ->name('meta.list');
});
//fq
Route::prefix('/fq')->group(function () {
    Route::get('/list', [FQController::class, 'listIndex'])
        ->name('fq.list');
});
//acl
//permission
Route::prefix('/permission')->group(function () {
    Route::get('/list', [PermissionController::class, 'listIndex'])
        ->name('permission.list');
});
//role
Route::prefix('/role')->group(function () {
    Route::get('/list', [RoleController::class, 'listIndex'])
        ->name('role.list');
});
//agency
Route::prefix('/agency')->group(function () {
	Route::get('/list', [AgencyController::class, 'listIndex'])
		->name('agency.list');
});
//developer
Route::prefix('/developer')->group(function () {
	Route::get('/list', [DeveloperController::class, 'listIndex'])
		->name('developer.list');
});
