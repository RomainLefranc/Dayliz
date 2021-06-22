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

Route::resource('activities', ActivityController::class);
Route::resource('users',UserController::class);
Route::resource('roles', RoleController::class);

Route::get('users/{id}/desactivate', [UserController::class,'desactivate']);
Route::get('users/{id}/activate', [UserController::class,'activate']);

Route::get('activities/{id}/activate', [ActivityController::class, 'activate'])->name('activities.activate');
Route::get('activities/{id}/desactivate', [ActivityController::class, 'desactivate'])->name('activities.desactivate');

Route::get('activities/{id}/users', [ActivityController::class, 'index_activity_user'])->name('activities.users.index');
Route::get('activities/{id}/user/create', [ActivityController::class, 'create_activity_user'])->name('activities.users.create');
Route::post('activities/{id}/user/store', [ActivityController::class, 'store_activity_user'])->name('activities.users.store');
Route::delete('activities/{activity_id}/user/{user_id}/delete', [ActivityController::class, 'delete_activity_user'])->name('activities.users.delete');
Route::get('activities/{id}/show', [ActivityController::class, 'show']);
Route::patch('activities/{id}/update/', [ActivityController::class, 'update']);