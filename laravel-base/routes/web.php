<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('activity', ActivityController::class);
Route::resource('users',UserController::class);
Route::resource('role', RoleController::class);

Route::get('user/desactivate/{id}', [UserController::class,'desactivate']);
Route::get('user/activate/{id}', [UserController::class,'activate']);
