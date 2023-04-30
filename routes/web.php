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

Route::fallback(function () {
    return view('common.errors.404');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/templates/admin/gentelellaMaster', function () {
    return view('templates.admins.gentelellaMaster.production.index');
});
