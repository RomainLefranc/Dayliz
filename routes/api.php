<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ExamenController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('users',[UserController::class,'getUsers']);
Route::get('users/{id}',[UserController::class,'showUser']);
Route::get('users/{id}/examens',[UserController::class,'showUserExamens']);
Route::get('users/{id}/activities',[UserController::class,'showUserActivities']);
Route::get('users/{id}/promotion',[UserController::class,'showUserPromotion']);

Route::get('promotions',[PromotionController::class,'getPromotions']);
Route::get('promotions/{id}',[PromotionController::class,'showPromotion']);
Route::get('promotions/{id}/examens',[PromotionController::class,'showPromotionExamens']);
Route::get('promotions/{id}/users',[PromotionController::class,'showPromotionUsers']);

Route::get('examens',[ExamenController::class,'getExamens']);
Route::get('examens/{id}',[ExamenController::class,'showExamen']);
Route::get('examens/{id}/promotion',[ExamenController::class,'showExamenPromotion']);
Route::get('examens/{id}/activities',[ExamenController::class,'showExamenActivities']);
Route::get('examens/{id}/users',[ExamenController::class,'showExamenUsers']);

Route::get('activities',[ActivityController::class,'getActivities']);
Route::get('activities/{id}',[ActivityController::class,'showActivities']);
Route::get('activities/{id}/user',[ActivityController::class,'showActivitiesUser']);
Route::get('activities/{id}/examen',[ActivityController::class,'showActivitiesExamen']);
