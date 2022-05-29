<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ForgotpasswordController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RoomtypeController;
use App\Models\Roomtype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// all
Route::get('/type/{roomtype}', [\App\Http\Controllers\RoomtypeController::class, 'viewTypes']);
Route::get('/hall/{hall}', [\App\Http\Controllers\HallController::class, 'viewHall']);
Route::apiResource('users', \App\Http\Controllers\UserController::class);
Route::get('/viewroomtypes', [App\Http\Controllers\RoomtypeController::class, 'index']);
Route::get('/viewhalls', [App\Http\Controllers\HallController::class, 'index']);
Route::put('/changestatus/{book}', [BookController::class, 'changeBookingStatus']);
Route::put('/changehallbookstatus/{hallbook}', [App\Http\Controllers\HallbookController::class, 'changeBookingStatus']);
Route::post('/viewavailable', [App\Http\Controllers\FrontController::class, 'roomAvailability']);
Route::post('/hallavailability', [App\Http\Controllers\FrontController::class, 'hallAvailability']);
Route::get('/count', [\App\Http\Controllers\CountController::class, 'countAll']);
Route::get('/myorders', [FrontController::class, 'foodOrders'])->middleware('auth:sanctum');


// forget password
Route::post('/forgotpassword', [ForgotpasswordController::class, 'email']);
Route::post('/token', [ForgotpasswordController::class, 'token']);
Route::put('/updatepassword/{user}', [ForgotpasswordController::class, 'updatePassword']);
Route::post('/deletetoken/{user}', [ForgotpasswordController::class, 'deleteToken']);

// auth
// Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::post('/register', [\App\Http\Controllers\CustomerController::class, 'register']);
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout']);

// customer
Route::middleware(['auth:sanctum', 'isCustomer'])->group(function () {
    Route::post('/book-room', [App\Http\Controllers\BookController::class, 'store']);
    Route::post('/book-hall', [App\Http\Controllers\HallbookController::class, 'store']);
    Route::get('/foodavailables', [App\Http\Controllers\FoodController::class, 'foodAvailables']);
    Route::post('/order-food', [App\Http\Controllers\OrderController::class, 'order_food']);
    Route::get('/mybookings', [App\Http\Controllers\BookController::class, 'showBookingOfUser']);
    Route::get('/myhallbookings', [App\Http\Controllers\HallbookController::class, 'showBookingOfUser']);
    Route::get("/canorderfood", [FrontController::class, 'canOrderFood']);
    Route::get('/foodavailable', [App\Http\Controllers\FoodController::class, 'foodAvailable']);
});


// kitchen
Route::middleware(['auth:sanctum', 'isKitchen'])->group(function () {
    Route::get('/foods', [App\Http\Controllers\FoodController::class, 'index']);
    Route::post('/foods', [App\Http\Controllers\FoodController::class, 'store']);
    Route::get('/foods/{food}', [App\Http\Controllers\FoodController::class, 'show']);
    Route::put('/foods/{food}', [App\Http\Controllers\FoodController::class, 'update']);
    Route::delete('/foods/{food}', [App\Http\Controllers\FoodController::class, 'destroy']);
    Route::put('/changeavailability/{food}', [App\Http\Controllers\FoodController::class, 'changeAvailability']);
    Route::put('/changeorderstatus/{order}', [OrderController::class, 'changeStatus']);
    Route::get('/orders', [OrderController::class, 'index']);
});


// admin & front office
Route::middleware(['auth:sanctum', 'isAdminOrFront'])->group(function () {
    Route::post('/updatebookings/{id}', [App\Http\Controllers\BookController::class, 'update']);
    Route::get('/viewbookings', [App\Http\Controllers\BookController::class, 'index']);
    Route::get('/calculate/{id}', [App\Http\Controllers\BookController::class, 'calculate']);
    Route::apiResource('customers', \App\Http\Controllers\CustomerController::class);
    Route::apiResource('halls', \App\Http\Controllers\HallController::class);
    Route::apiResource('roomtypes', \App\Http\Controllers\RoomTypeController::class);
    Route::apiResource('rooms', \App\Http\Controllers\RoomController::class);
    Route::apiResource('floors', \App\Http\Controllers\FloorController::class);
    Route::apiResource('hallbooks', \App\Http\Controllers\HallbookController::class);
    Route::put('/assignRoom/{book}', [BookController::class, 'assignRoom']);
});


// Admin
Route::middleware(['auth:sanctum', 'isAdmin'])->group(function () {

    Route::apiResource('shifts', \App\Http\Controllers\ShiftController::class);

    Route::apiResource('amenities', \App\Http\Controllers\AmenityController::class);


    Route::apiResource('departments', \App\Http\Controllers\DepartmentController::class);

    Route::apiResource('roles', \App\Http\Controllers\RoleController::class);

    Route::apiResource('employees', \App\Http\Controllers\EmployeeController::class);

    Route::apiResource('housekeepings', \App\Http\Controllers\HousekeepingController::class);
});

Route::controller(NotificationController::class)->middleware('auth:sanctum')->group(function () {
    Route::get("/notifications", 'all');
    Route::get("/notifications/markasread/{id}", 'markasread');
    Route::get("/notifications/markallasread", 'markallasread');
    Route::get("/hasnotifications", 'hasNotifications');
    Route::get("/hasunread", 'hasUnread');
    Route::get("/countnotifications", 'countNotifications');
});

Route::apiResource('users', \App\Http\Controllers\UserController::class);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
