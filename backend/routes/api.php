<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\RoomBookingsController;
use App\Http\Controllers\RoomsController;
use App\Http\Controllers\UsersController;
use App\Models\RoomBookings;
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
//Guest
Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
});
Route::get('/rooms', [RoomsController::class, 'list']);
Route::post('roombooking', [RoomBookingsController::class, 'create']);

//User
Route::middleware(['auth:sanctum'])->prefix('user')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::controller(RoomBookingsController::class)->group(function () {
        Route::get('/roombooking', 'list');
        Route::post('roombooking', 'create');
    });
});

//Admin
Route::middleware(['auth:sanctum', 'admin'])->prefix('admin')->group(function () {
    Route::controller(UsersController::class)->group(function () {
        Route::get('/user', 'list');
        Route::put('/user/{id}', 'update');
    });

    Route::controller(RoomBookingsController::class)->group(function () {
        Route::get('/roombooking', 'list');
        Route::put('/roombooking/{id}', 'update');
    });
    Route::get('/permissions', [PermissionsController::class, 'list']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
