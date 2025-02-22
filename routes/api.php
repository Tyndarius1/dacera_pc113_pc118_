<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\EmployeeController;



//Student
Route::get('/students', [StudentController::class, 'index']);
Route::get('/student-registration', [StudentController::class, 'store']);
Route::put('/student/{id}', [StudentController::class, 'update']);
Route::delete('/student/{id}', [StudentController::class, 'destroy']);





//Employee
Route::get('/employees', [EmployeeController::class, 'index']);
Route::get('/employee-registration', [EmployeeController::class, 'store']);
Route::put('/employee/{id}', [EmployeeController::class, 'update']);
Route::delete('/employee/{id}', [EmployeeController::class, 'destroy']);






Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');