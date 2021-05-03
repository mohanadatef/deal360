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
    Route::get('/list', [LanguageController::class, 'list_all'])
        ->name('language.list');
});
Route::prefix('/status')->group(function () {
    Route::get('/list', [StatusController::class, 'list_all'])
        ->name('status.list');
});
Route::prefix('/type')->group(function () {
    Route::get('/list', [TypeController::class, 'list_all'])
        ->name('type.list');
});
Route::prefix('/category')->group(function () {
    Route::get('/list', [CategoryController::class, 'list_all'])
        ->name('category.list');
});
Route::prefix('/country')->group(function () {
    Route::get('/list', [CountryController::class, 'list_all'])
        ->name('country.list');
});
Route::prefix('/city')->group(function () {
    Route::get('/list/{country}', [CityController::class, 'list_all'])
        ->name('city.list');
});
Route::prefix('/area')->group(function () {
    Route::get('/list/{country}/{city}', [AreaController::class, 'list_all'])
        ->name('area.list');
});
Route::prefix('/amenity')->group(function () {
    Route::get('/list', [AmenityController::class, 'list_all'])
        ->name('amenity.list');
});
Route::prefix('/package')->group(function () {
    Route::get('/list', [PackageController::class, 'list_all'])
        ->name('package.list');
});
Route::prefix('/highlight')->group(function () {
    Route::get('/list', [HighLightController::class, 'list_all'])
        ->name('highlight.list');
});
