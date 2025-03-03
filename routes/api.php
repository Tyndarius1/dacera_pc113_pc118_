<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\Auth\StudentAuthController;
use App\Http\Controllers\Auth\EmployeeAuthController;



//Student
Route::get('/students', [StudentController::class, 'show']);
Route::put('/student/{id}', [StudentController::class, 'update']);
Route::delete('/student/{id}', [StudentController::class, 'destroy']);


Route::post('/student-registration', [StudentAuthController::class, 'register']);
Route::post('/student-login', [StudentAuthController::class, 'login']);






//Employee
Route::get('/employees', [EmployeeController::class, 'index']);
Route::put('/employee/{id}', [EmployeeController::class, 'update']);
Route::delete('/employee/{id}', [EmployeeController::class, 'destroy']);

Route::post('/employee-registration', [EmployeeAuthController::class, 'register']);
Route::post('/employee-login', [EmployeeAuthController::class, 'login']);






//User
Route::post('/user-registration', [UserController::class, 'register']);
Route::post('/user-login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);





































Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');