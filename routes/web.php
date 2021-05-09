<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CoreData\LanguageController;
use App\Http\Controllers\Admin\CoreData\StatusController;
use App\Http\Controllers\Admin\CoreData\TypeController;
use App\Http\Controllers\Admin\CoreData\CategoryController;
use App\Http\Controllers\Admin\CoreData\CountryController;
use App\Http\Controllers\Admin\CoreData\CityController;
use App\Http\Controllers\Admin\CoreData\AreaController;
use App\Http\Controllers\Admin\CoreData\AmenityController;
use App\Http\Controllers\Admin\CoreData\PackageController;
use App\Http\Controllers\Admin\CoreData\HighLightController;
use App\Http\Controllers\Admin\Setting\MetaController;
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
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    return redirect('admin');
});
Route::prefix('/language')->group(function () {
    Route::get('/list', [LanguageController::class, 'listIndex'])
        ->name('language.list');
    Route::post('/setLang', [LanguageController::class, 'language'])
    ->name('setLang');
});
Route::prefix('/status')->group(function () {
    Route::get('/list', [StatusController::class, 'listIndex'])
        ->name('status.list');
});
Route::prefix('/type')->group(function () {
    Route::get('/list', [TypeController::class, 'listIndex'])
        ->name('type.list');
});
Route::prefix('/category')->group(function () {
    Route::get('/list', [CategoryController::class, 'listIndex'])
        ->name('category.list');
});
Route::prefix('/country')->group(function () {
    Route::get('/list', [CountryController::class, 'listIndex'])
        ->name('country.list');
});
Route::prefix('/city')->group(function () {
    Route::get('/list/{country}', [CityController::class, 'listIndex'])
        ->name('city.list');
});
Route::prefix('/area')->group(function () {
    Route::get('/list/{country}/{city}', [AreaController::class, 'listIndex'])
        ->name('area.list');
});
Route::prefix('/amenity')->group(function () {
    Route::get('/list', [AmenityController::class, 'listIndex'])
        ->name('amenity.list');
});
Route::prefix('/package')->group(function () {
    Route::get('/list', [PackageController::class, 'listIndex'])
        ->name('package.list');
});
Route::prefix('/highlight')->group(function () {
    Route::get('/list', [HighLightController::class, 'listIndex'])
        ->name('highlight.list');
});
Route::prefix('/meta')->group(function () {
    Route::get('/list', [MetaController::class, 'listIndex'])
        ->name('meta.list');
});
