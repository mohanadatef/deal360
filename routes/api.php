<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Acl\AuthController;
use App\Http\Controllers\Api\Acl\UserController;
use App\Http\Controllers\Api\Acl\ForgotPasswordController;
use App\Http\Controllers\Api\Acl\AgentController;
use App\Http\Controllers\Api\Acl\CompanyController;
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
use App\Http\Controllers\Api\Setting\MetaController;
use App\Http\Controllers\Api\Setting\FQController;
use App\Http\Controllers\Api\Property\PropertyController;

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
            //forgot password
            Route::prefix('/forgotpassword')->name('forgotpassword.')->group(function () {
                //search
                Route::get('/search', [ForgotPasswordController::class, 'search'])->name('search');
                //check
                Route::get('/check', [ForgotPasswordController::class, 'check'])->name('check');
                //change
                Route::post('/change', [ForgotPasswordController::class, 'changePassowrd'])->name('change');
            });
        });
        //core data
        Route::prefix('/core_data')->name('core_data.')->group(function () {
            //language
            Route::prefix('/language')->group(function () {
                Route::get('/list', [LanguageController::class, 'listIndex'])->name('language.list');
            });
            //status
            Route::prefix('/status')->name('status.')->group(function () {
                Route::get('/list', [StatusController::class, 'listIndex'])->name('list');
            });
            //type
            Route::prefix('/type')->name('type.')->group(function () {
                Route::get('/list', [TypeController::class, 'listIndex'])->name('list');
            });
            //category
            Route::prefix('/category')->name('category.')->group(function () {
                Route::get('/list', [CategoryController::class, 'listIndex'])->name('list');
            });
            //country
            Route::prefix('/country')->name('country.')->group(function () {
                Route::get('/list', [CountryController::class, 'listIndex'])->name('list');
            });
            //city
            Route::prefix('/city')->name('city.')->group(function () {
                Route::get('/list', [CityController::class, 'listIndex'])->name('list');
            });
            //area
            Route::prefix('/rejoin')->name('rejoin.')->group(function () {
                Route::get('/list', [RejoinController::class, 'listIndex'])->name('list');
            });
            //amenity
            Route::prefix('/amenity')->name('amenity.')->group(function () {
                Route::get('/list', [AmenityController::class, 'listIndex'])->name('list');
            });
            //package
            Route::prefix('/package')->name('package.')->group(function () {
                Route::get('/list', [PackageController::class, 'listIndex'])->name('list');
            });
            //currency
            Route::prefix('/currency')->name('currency.')->group(function () {
                Route::get('/list', [CurrencyController::class, 'listIndex'])->name('list');
            });
            //high light
            Route::prefix('/highlight')->name('highlight.')->group(function () {
                Route::get('/list', [HighLightController::class, 'listIndex'])->name('list');
            });
        });
        Route::prefix('/setting')->name('setting.')->group(function () {
            //meta
            Route::prefix('/meta')->name('meta.')->group(function () {
                Route::get('/list', [MetaController::class, 'listIndex'])->name('list');
            });
            //fq
            Route::prefix('/fq')->name('fq.')->group(function () {
                Route::get('/list', [FQController::class, 'listIndex'])->name('list');
            });
            });
        //company
        Route::prefix('/company')->name('company.')->group(function () {
            //index
            Route::get('/index', [CompanyController::class, 'index'])->name('index');
            //profile
            Route::get('/profile', [CompanyController::class, 'show'])->name('show');
        });
        //agent
        Route::prefix('/agent')->name('agent.')->group(function () {
            //index
            Route::get('/index', [AgentController::class, 'index'])->name('index');
            //profile
            Route::get('/profile', [AgentController::class, 'show'])->name('show');
        });
        //property
        Route::prefix('/property')->name('property.')->group(function () {
            //index
            Route::get('/index', [PropertyController::class, 'index'])->name('index');
            //profile
            Route::get('/profile', [PropertyController::class, 'show'])->name('show');
        });
    });
});
