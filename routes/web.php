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

Route::middleware(['auth', 'CheckRole:admin'])->group(function () {

    Route::resource('roles', RoleController::class);

    // Users
    Route::resource('users',UserController::class);
    Route::get('users/{id}/desactivate', [UserController::class,'desactivate'])->name('users.desactivate');
    Route::get('users/{id}/activate', [UserController::class,'activate'])->name('users.activate');

    // Promotions
    Route::resource('promotions', PromotionController::class);
    Route::get('promotions/{id}/desactivate', [PromotionController::class,'desactivate'])->name('promotions.desactivate');
    Route::get('promotions/{id}/activate', [PromotionController::class,'activate'])->name('promotions.activate');

    // Examens
    Route::resource('examens', ExamenController::class);

    // /Activités
    Route::resource('examens/{id_examen}/activities', ActivityController::class);
    Route::get('examens/{id_examen}/activities/{id}/activate', [ActivityController::class, 'activate'])->name('activities.activate');
    Route::get('examens/{id_examen}/activities/{id}/desactivate', [ActivityController::class, 'desactivate'])->name('activities.desactivate');
    Route::patch('examens/{id_examen}/activities/{id}/update', [ActivityController::class, 'update']);
    Route::get('examens/{id_examen}/activities/{id}/up', [ActivityController::class, 'up'])->name('activities.up');
    Route::get('examens/{id_examen}/activities/{id}/down', [ActivityController::class, 'down'])->name('activities.down');

});

require __DIR__.'/auth.php';

