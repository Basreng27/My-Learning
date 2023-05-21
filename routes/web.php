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
        Route::post('proses-regist', [\App\Http\Controllers\Auth\AuthController::class, 'regist'])->name('proses-regist');
        Route::post('proses-login', [\App\Http\Controllers\Auth\AuthController::class, 'login'])->name('proses-login');
    });

// logout
Route::get('logout', [\App\Http\Controllers\Auth\AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['verified', 'auth', 'acl']], function () {
    // Home
    Route::get('home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('dashboard', [\App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

    // Admin
    Route::prefix('/admin')->group(function () {
        // Menu
        Route::resource('menu', \App\Http\Controllers\MenuController::class, ['names' => 'menu']);
        Route::get('create-menu', [\App\Http\Controllers\MenuController::class, 'create'])->name('create-menu');
        // Route::delete('destroy-menu/{id}', [\App\Http\Controllers\MenuController::class, 'destroy'])->name('destroy-menu');
        Route::get('destroy-menu/{id}', [\App\Http\Controllers\MenuController::class, 'destroy'])->name('destroy-menu');
        Route::get('data-menu', [\App\Http\Controllers\MenuController::class, 'data'])->name('data-menu');
        Route::get('edit-menu/{menu}', [\App\Http\Controllers\MenuController::class, 'edit'])->name('edit-menu');
        // Route::put('edit-menu/{menu}', [\App\Http\Controllers\MenuController::class, 'edit'])->name('edit-menu');
        Route::put('menu-orderSave', [\App\Http\Controllers\MenuController::class, 'saveOrder'])->name('menu-saveOrder');
    });
});

Route::get('/templates/admin/gentelellaMaster', function () {
    return view('templates.admins.gentelellaMaster.production.index');
});

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
