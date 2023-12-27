<?php

use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SickController;
use App\Http\Controllers\UserController;
use App\Models\Sick;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [LoginController::class, 'login']);
//Login
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



//Sick
Route::post('/sick', [SickController::class, 'store']);
Route::get('/sick', [SickController::class, 'index']);
Route::get('/sick/{id}', [SickController::class, 'show']);
Route::patch('/sick/{id}', [SickController::class, 'update']);
Route::delete('/sick/{id}', [SickController::class, 'destroy']);

//Consultation
Route::post('/consultation', [ConsultationController::class, 'store']);
Route::get('/consultation', [ConsultationController::class, 'index']);
Route::post('/consultation/{id}', [ConsultationController::class, 'show']);
Route::get('/consultation/{id}', [ConsultationController::class, 'update']);
Route::post('/consultation/{id}', [ConsultationController::class, 'destroy']);

//User
Route::post('/user', [UserController::class, 'store']);
Route::get('/user', [UserController::class, 'index']);
Route::get('/user/{id}', [UserController::class, 'show']);
Route::patch('/user/{id}', [UserController::class, 'update']);
Route::delete('/user/{id}', [UserController::class, 'destroy']);

//Doctor
Route::post('/doctor', [DoctorController::class, 'store']);
Route::get('/doctor', [DoctorController::class, 'index']);
Route::get('/doctor/{id}', [DoctorController::class, 'show']);
Route::put('/doctor/{id}', [DoctorController::class, 'update']);
Route::delete('/doctor/{id}', [DoctorController::class, 'destroy']);
