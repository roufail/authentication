<?php
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name("loginform");
    Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name("registerform");
    Route::post('/login', 'Auth\LoginController@login')->name("login");
    Route::post('/register', 'Auth\RegisterController@register')->name("register");

Route::group(['middleware' => 'admin'],function(){
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::post('/logout', 'Auth\LoginController@logout')->name("logout");
    Route::resource("/admins",AdminsController::class);
    Route::resource("/users",UsersController::class);
    Route::resource("/roles",RolesController::class);
});