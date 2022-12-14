<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
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
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::get('logout', [AuthController::class, 'logout']);

//post
Route::post('alertv/create', [AlertVController::class, 'create'])->middleware('jwtAuth');
Route::post('alertv/update', [AlertVController::class, 'update'])->middleware('jwtAuth');
Route::post('alertv/delete', [AlertVController::class, 'delate'])->middleware('jwtAuth');

Route::post('alertvv/create', [AlertVVController::class, 'create'])->middleware('jwtAuth');
Route::post('alertvv/update', [AlertVVController::class, 'update'])->middleware('jwtAuth');
Route::post('alertvv/delete', [AlertVVController::class, 'delete'])->middleware('jwtAuth');

Route::post('alertvp/create', [AlertVPController::class, 'create'])->middleware('jwtAuth');
Route::post('alertvp/update', [AlertVPController::class, 'update'])->middleware('jwtAuth');
Route::post('alertvp/delete', [AlertVPController::class, 'delete'])->middleware('jwtAuth');

Route::post('alerteGouv/create', [AlerteGouvController::class, 'create'])->middleware('jwtAuth');
Route::post('alerteGouv/update', [AlerteGouvController::class, 'update'])->middleware('jwtAuth');
Route::post('alerteGouv/delete', [AlerteGouvController::class, 'delete'])->middleware('jwtAuth');

Route::post('position/create', [PositionController::class, 'create'])->middleware('jwtAuth');
Route::post('position/update', [PositionController::class, 'update'])->middleware('jwtAuth');
Route::post('position/delete', [PositionController::class, 'delete'])->middleware('jwtAuth');

Route::post('adresse/create', [AdresseController::class, 'create'])->middleware('jwtAuth');
Route::post('adresse/update', [AdresseController::class, 'update'])->middleware('jwtAuth');
Route::post('adresse/delete', [AdresseController::class, 'delete'])->middleware('jwtAuth');


//get

Route::get('alertvs', [AlertVController::class, 'alertvs'])->middleware('jwtAuth');
Route::get('alertvvs', [AlertVVController::class, 'alertvvs'])->middleware('jwtAuth');
Route::get('alertvps', [AlertVPController::class, 'alertvps'])->middleware('jwtAuth');
Route::get('alerteGouvs', [AlerteGouvController::class, 'alerteGouvs'])->middleware('jwtAuth');
