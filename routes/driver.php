<?php

// Route::group(['namespace' => 'Driver'], function() {
//     Route::get('/', 'HomeController@index')->name('driver.dashboard');

//     // Login
//     Route::get('login', 'Auth\LoginController@showLoginForm')->name('driver.login');
//     Route::post('login', 'Auth\LoginController@login');
//     Route::post('logout', 'Auth\LoginController@logout')->name('driver.logout');

//     // Register
//     Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('driver.register');
//     Route::post('register', 'Auth\RegisterController@register');

//     // Passwords
//     Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('driver.password.email');
//     Route::post('password/reset', 'Auth\ResetPasswordController@reset');
//     Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('driver.password.request');
//     Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('driver.password.reset');

//     // Must verify email
//     Route::get('email/resend','Auth\VerificationController@resend')->name('driver.verification.resend');
//     Route::get('email/verify','Auth\VerificationController@show')->name('driver.verification.notice');
//     Route::get('email/verify/{id}','Auth\VerificationController@verify')->name('driver.verification.verify');


//     Route::get('profile' , 'UserController@index')->name('driver.profile');
//     Route::post('profile/{id}/update' , 'UserController@update')->name('driver.update');
//     Route::post('profile/change' , 'UserController@changePassword')->name('driver.password.change');


//     Route::resource('myorders' , 'OrdersController');
//     Route::get('myorders/{id}/pdf/{order_id}' , 'OrdersController@pdf')->name('myorders.order.pdf');
//     Route::post('myorders/status/' , 'OrdersController@changeStatus')->name('myorders.order.changeStatus');


//     Route::resource('driverReport' , 'ReportController');
// });