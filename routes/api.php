<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout']);

Route::middleware(['auth:sanctum', 'isCustomer'])->group(function () {
    Route::post('/book-room', [App\Http\Controllers\BookController::class, 'store']);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/viewroomtypes', [App\Http\Controllers\RoomtypeController::class, 'index']);
Route::get('/viewhalls', [App\Http\Controllers\HallController::class, 'index']);



Route::middleware(['auth:sanctum', 'isAdmin'])->group(function () {

    Route::apiResource('shifts', \App\Http\Controllers\ShiftController::class);

    Route::apiResource('amenities', \App\Http\Controllers\AmenityController::class);

    Route::apiResource('floors', \App\Http\Controllers\FloorController::class);

    Route::apiResource('departments', \App\Http\Controllers\DepartmentController::class);

    Route::apiResource('roles', \App\Http\Controllers\RoleController::class);

    Route::apiResource('employees', \App\Http\Controllers\EmployeeController::class);

    Route::apiResource('housekeepings', \App\Http\Controllers\HousekeepingController::class);

    Route::apiResource('halls', \App\Http\Controllers\HallController::class);

    Route::apiResource('roomtypes', \App\Http\Controllers\RoomTypeController::class)->except('index');

    Route::apiResource('rooms', \App\Http\Controllers\RoomController::class);

    Route::apiResource('customers', \App\Http\Controllers\CustomerController::class);

    Route::get('/count', [\App\Http\Controllers\CountController::class, 'countAll']);
});

Route::apiResource('users', \App\Http\Controllers\UserController::class);
