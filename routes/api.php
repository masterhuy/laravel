<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartmentsController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// User
Route::get('/user/{id}', [UserController::class, 'show']);
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/create', [UserController::class, 'create']);
Route::post('/users', [UserController::class, 'store']);
Route::get('/users/{id}/edit', [UserController::class, 'edit']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);

//Department
Route::get('/departments', [DepartmentsController::class, 'index']);
Route::get('/departments/create', [DepartmentsController::class, 'create']);
Route::post('/departments', [DepartmentsController::class, 'store']);
Route::get('/departments/{id}/edit', [DepartmentsController::class, 'edit']);
Route::put('/departments/{id}', [DepartmentsController::class, 'update']);
Route::delete('/departments/{id}', [DepartmentsController::class, 'destroy']);
