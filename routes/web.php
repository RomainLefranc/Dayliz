<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ExamenController;
use App\Http\Controllers\PromotionController;
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
    return redirect('/users');
});

Route::resource('roles', RoleController::class);

Route::resource('users',UserController::class);
Route::get('users/{id}/desactivate', [UserController::class,'desactivate'])->name('users.desactivate');
Route::get('users/{id}/activate', [UserController::class,'activate'])->name('users.activate');
Route::get('listUsers',[UserController::class,'listUser'])->name('users.list');
Route::get('users/{token}/activities',[UserController::class,'showActivities']);
Route::get('users/{id}/generateToken',[UserController::class,'generateToken'])->name('users.generate');

Route::resource('promotions', PromotionController::class);
Route::get('promotions/{id}/generateToken',[PromotionController::class,'generateToken'])->name('promotions.generate');
Route::get('promotions/{token}/activities',[PromotionController::class,'showActivities']);

Route::resource('examens', ExamenController::class);

Route::resource('examens/{id_examen}/activities', ActivityController::class);
Route::get('examens/{id_examen}/activities/{id}/activate', [ActivityController::class, 'activate'])->name('activities.activate');
Route::get('examens/{id_examen}/activities/{id}/desactivate', [ActivityController::class, 'desactivate'])->name('activities.desactivate');
Route::get('examens/{id_examen}/activities/{id}/show', [ActivityController::class, 'show']);
Route::patch('examens/{id_examen}/activities/{id}/update', [ActivityController::class, 'update']);
Route::get('listActivities/{id_examen}',[ActivityController::class,'listActivities'])->name('activities.list');
