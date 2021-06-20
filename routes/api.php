<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Acl\AuthController;
use App\Http\Controllers\Api\Acl\UserController;

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

Route::group(['middleware' => 'api','language_api'], function () {
    Route::name('api.')->group(function () {
        Route::prefix('/auth')->name('auth.')->group(function () {
            Route::post('/login', [AuthController::class, 'login'])->name('login');
            Route::post('/register', [UserController::class, 'register'])->name('register');
        });
    });
});
