<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
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
/* cache list */
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    return redirect('admin');
});
/* error route list */
Route::get('/error/403', [HomeController::class, 'error_403'])->name('error.403');
/* migrate fresh*/
Route::get('/migrate_fresh', function () {
    Artisan::call('migrate:fresh');
    return redirect('admin');
});
/* migrate fresh seed */
Route::get('/migrate_fresh_seed', function () {
    Artisan::call('migrate:fresh --seed');
    return redirect('admin');
});
/* seed list */
Route::get('/seed', function () {
    Artisan::call('db:seed');
    return redirect('admin');
});
/* artisan list */
Route::get('/{artisan}', function ($artisan) {
    Artisan::call($artisan);
    return redirect('admin');
});
