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
Route::resource('role', RoleController::class);

Route::get('user/desactivate/{id}', [UserController::class,'desactivate']);
Route::get('user/activate/{id}', [UserController::class,'activate']);

Route::get('activity/activate/{id}', [ActivityController::class, 'activate']);
Route::get('activity/desactivate/{id}', [ActivityController::class, 'desactivate']);

Route::get('activities/{id}/user', [ActivityController::class, 'index_activity_user']);
Route::get('activities/{id}/user/create', [ActivityController::class, 'create_activity_user']);
Route::get('activities/show/{id}', [ActivityController::class, 'show']);
Route::get('activities/update/{id}', [ActivityController::class, 'update']);
Route::post('activities/{id}/user/store', [ActivityController::class, 'store_activity_user']);
Route::delete('activities/{activity_id}/user/{user_id}/delete', [ActivityController::class, 'delete_activity_user']);