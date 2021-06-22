<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Acl\AuthController;
use App\Http\Controllers\Api\Acl\UserController;
use App\Http\Controllers\Api\Acl\AgencyController;
use App\Http\Controllers\Api\Acl\AgentController;
use App\Http\Controllers\Api\Acl\DeveloperController;
use App\Http\Controllers\Api\CoreData\LanguageController;
use App\Http\Controllers\Api\CoreData\StatusController;
use App\Http\Controllers\Api\CoreData\TypeController;
use App\Http\Controllers\Api\CoreData\CategoryController;
use App\Http\Controllers\Api\CoreData\CountryController;
use App\Http\Controllers\Api\CoreData\CityController;
use App\Http\Controllers\Api\CoreData\RejoinController;
use App\Http\Controllers\Api\CoreData\AmenityController;
use App\Http\Controllers\Api\CoreData\PackageController;
use App\Http\Controllers\Api\CoreData\CurrencyController;
use App\Http\Controllers\Api\CoreData\HighLightController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'api', 'language_api'], function () {
    Route::name('api.')->group(function () {
        //auth
        Route::prefix('/auth')->name('auth.')->group(function () {
            //login
            Route::post('/login', [AuthController::class, 'login'])->name('login');
            //register
            Route::post('/register', [UserController::class, 'register'])->name('register');
        });
        //core data
        Route::prefix('/core_data')->name('core_data.')->group(function () {
            //language
            Route::prefix('/language')->group(function () {
                Route::get('/list', [LanguageController::class, 'listIndex'])->name('language.list');
            });
            //status
            Route::prefix('/status')->group(function () {
                Route::get('/list', [StatusController::class, 'listIndex'])->name('status.list');
            });
            //type
            Route::prefix('/type')->group(function () {
                Route::get('/list', [TypeController::class, 'listIndex'])->name('type.list');
            });
            //category
            Route::prefix('/category')->group(function () {
                Route::get('/list', [CategoryController::class, 'listIndex'])->name('category.list');
            });
            //country
            Route::prefix('/country')->group(function () {
                Route::get('/list', [CountryController::class, 'listIndex'])->name('country.list');
            });
            //city
            Route::prefix('/city')->group(function () {
                Route::get('/list', [CityController::class, 'listIndex'])->name('city.list');
            });
            //area
            Route::prefix('/rejoin')->group(function () {
                Route::get('/list', [RejoinController::class, 'listIndex'])->name('area.list');
            });
            //amenity
            Route::prefix('/amenity')->group(function () {
                Route::get('/list', [AmenityController::class, 'listIndex'])->name('amenity.list');
            });
            //package
            Route::prefix('/package')->group(function () {
                Route::get('/list', [PackageController::class, 'listIndex'])->name('package.list');
            });
            //currency
            Route::prefix('/currency')->group(function () {
                Route::get('/list', [CurrencyController::class, 'listIndex'])->name('currency.list');
            });
            //high light
            Route::prefix('/highlight')->group(function () {
                Route::get('/list', [HighLightController::class, 'listIndex'])->name('highlight.list');
            });
        });
        //agency
        Route::prefix('/agency')->name('agency.')->group(function () {
            //index
            Route::get('/index', [AgencyController::class, 'index'])->name('index');
            //profile
            Route::get('/profile', [AgencyController::class, 'show'])->name('show');
        });
        //Developer
        Route::prefix('/developer')->name('developer.')->group(function () {
            //index
            Route::get('/index', [DeveloperController::class, 'index'])->name('index');
            //profile
            Route::get('/profile', [DeveloperController::class, 'show'])->name('show');
        });
        //agent
        Route::prefix('/agent')->name('agent.')->group(function () {
            //index
            Route::get('/index', [AgentController::class, 'index'])->name('index');
            //profile
            Route::get('/profile', [AgentController::class, 'show'])->name('show');
        });
    });
});
