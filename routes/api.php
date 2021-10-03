<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



Route::group(['namespace' => 'App\Http\Controllers\Api\Admin','prefix' => 'admin'],function(){

    Route::post('/login', 'Auth\LoginController@login');
    Route::post('/register', 'Auth\RegisterController@register');
    Route::post("users/login","UsersController@login");

    Route::group(['middleware' => 'jwt.verify'], function(){
        // Route::get('/', 'DashboardController@index');
        // Route::get('/dashboard', 'DashboardController@index');
        Route::post('/logout', 'Auth\LoginController@logout');
        Route::resource("/admins",AdminsController::class);
        Route::resource("/users",UsersController::class);
        Route::resource("/roles",RolesController::class);
    });

});


