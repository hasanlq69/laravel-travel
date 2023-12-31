<?php

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

//group route with prefix "admin"
Route::prefix('admin')->group(function () {

    //route login
    Route::post('/login', App\Http\Controllers\Api\Admin\LoginController::class, ['as' => 'admin']);

    //group route with middleware "auth:api"
    Route::group(['middleware' => 'auth:api'], function() {

        //route user logged in
        Route::get('/user', function (Request $request) {
            return $request->user();
        })->name('user');

        //route logout
        Route::post('/logout', App\Http\Controllers\Api\Admin\LogoutController::class, ['as' => 'admin']);
        //dashboard
        Route::get('/dashboard', App\Http\Controllers\Api\Admin\DashboardController::class, ['as' => 'admin']);
        //categories resource
        Route::apiResource('/categories', App\Http\Controllers\Api\Admin\CategoryController::class, ['except' => ['create', 'edit'], 'as' => 'admin']);

    });


});
