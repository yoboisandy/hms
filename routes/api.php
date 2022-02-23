<?php

use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\Role;

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


Route::apiResource('shifts', \App\Http\Controllers\ShiftController::class);

Route::apiResource('amenities', \App\Http\Controllers\AmenityController::class);

Route::apiResource('floors', \App\Http\Controllers\FloorController::class);

Route::apiResource('departments', \App\Http\Controllers\DepartmentController::class);

Route::apiResource('roles', \App\Http\Controllers\RoleController::class);

Route::apiResource('employees', \App\Http\Controllers\EmployeeController::class);

Route::apiResource('housekeepings', \App\Http\Controllers\HousekeepingController::class);

Route::apiResource('halls', \App\Http\Controllers\HallController::class);

Route::apiResource('roomtypes', \App\Http\Controllers\RoomTypeController::class);
