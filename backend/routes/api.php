<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
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

Route::group(["prefix" => "dating"], function () {

    // add/signup  user
    Route::post("signup", [AuthController::class, "signup"])->name("signup");
    //login
    Route::post('login', [AuthController::class, 'login'])->name("login");

    Route::get('getMales', [UserController::class, 'getMales']);
    Route::get('getFemales', [UserController::class, 'getFemales']);

    //JWT auth  
    Route::group(["middleware" => "security"], function () {
        Route::get('getMales', [UserController::class, 'getMales']);
        Route::get('getFemales', [UserController::class, 'getFemales']);
    });
});

// Route::group([

//     'middleware' => 'api',
//     'prefix' => 'auth'

// ], function ($router) {

//     Route::post('/login', AuthController::class,'AuthController@login');
//     Route::post('logout', 'AuthController@logout');
//     Route::post('refresh', 'AuthController@refresh');
//     Route::post('me', 'AuthController@me');
// });
