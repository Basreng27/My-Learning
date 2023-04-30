<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// handle unknow all request
Route::fallback(function () {
    return view('common.errors.404');
});

// login url
Route::get('/', function () {
    return redirect()->route('login-page');
});

Route::prefix('/login')->middleware('guest')
    ->group(function () {
        Route::get('login-page', [\App\Http\Controllers\Auth\AuthController::class, 'index'])->name('login-page');
    });

Route::get('/templates/admin/gentelellaMaster', function () {
    return view('templates.admins.gentelellaMaster.production.index');
});
