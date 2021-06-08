<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Wordpress\WordpressController;
use App\Http\Controllers\Wordpress\CoreData\PackageController;
use App\Http\Controllers\Wordpress\CoreData\AmenityController;
use App\Http\Controllers\Wordpress\CoreData\CategoryController;
use App\Http\Controllers\Wordpress\CoreData\TypeController;
use App\Http\Controllers\Wordpress\CoreData\CityController;
use App\Http\Controllers\Wordpress\CoreData\HighLightController;
use App\Http\Controllers\Wordpress\Acl\UserController;
use App\Http\Controllers\Wordpress\Property\PropertyController;
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

Route::get('data/{return}', [WordpressController::class, 'index'])->name('wordpress.data.index');
Route::get('package/{return}', [PackageController::class, 'index'])->name('wordpress.package.index');
Route::get('amenity/{return}', [AmenityController::class, 'index'])->name('wordpress.amenity.index');
Route::get('category/{return}', [CategoryController::class, 'index'])->name('wordpress.category.index');
Route::get('type/{return}', [TypeController::class, 'index'])->name('wordpress.type.index');
Route::get('city/{return}', [CityController::class, 'index'])->name('wordpress.city.index');
Route::get('high_light/{return}', [HighLightController::class, 'index'])->name('wordpress.high_light.index');
Route::get('user/{return}', [UserController::class, 'index'])->name('wordpress.user.index');
Route::get('property/{return}', [PropertyController::class, 'index'])->name('wordpress.user.index');
