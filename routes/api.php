<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

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

//user
Route::get('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::get('logout', [AuthController::class, 'logout']);

//post
Route::post('alerte/create', [AlerteBeSafeController::class, 'create'])->middleware('jwtAuth');
Route::post('alertes/delete', [AlerteBeSafeController::class, 'delete'])->middleware('jwtAuth');

Route::post('alerte-gouvernementale/create', [AlerteGouvController::class, 'create'])->middleware('jwtAuth');


//get
Route::get('alertes', [AlerteBeSafeController::class, 'alertes'])->middleware('jwtAuth');
Route::get('alertes/user', [AlerteBeSafeController::class, 'alertesUser'])->middleware('jwtAuth');
Route::get('alertes/departement', [AlerteBeSafeController::class, 'alertesParDepartement'])->middleware('jwtAuth');

Route::get('alertes-gouvernementale/departement', [AlerteGouvController::class, 'alertesGouvParDepartement'])->middleware('jwtAuth');
