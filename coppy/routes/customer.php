<?php

Route::group(['namespace' => 'Customer'], function() {
    // Route::get('/', 'HomeController@index')->name('customer.dashboard');

    // // Login
    // Route::get('login', 'Auth\LoginController@showLoginForm')->name('customer.login');
    // Route::post('login', 'Auth\LoginController@login');
    // Route::post('logout', 'Auth\LoginController@logout')->name('customer.logout');

    // // Register
    // Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('customer.register');
    // Route::post('register', 'Auth\RegisterController@register');

    // // Passwords
    // Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('customer.password.email');
    // Route::post('password/reset', 'Auth\ResetPasswordController@reset');
    // Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('customer.password.request');
    // Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('customer.password.reset');

    // // Must verify email
    // Route::get('email/resend','Auth\VerificationController@resend')->name('customer.verification.resend');
    // Route::get('email/verify','Auth\VerificationController@show')->name('customer.verification.notice');
    // Route::get('email/verify/{id}','Auth\VerificationController@verify')->name('customer.verification.verify');


    // Route::get('profile' , 'UserController@index')->name('customer.profile');
    // Route::post('profile/{id}/update' , 'UserController@update')->name('customer.update');
    // Route::post('profile/change' , 'UserController@changePassword')->name('customer.password.change');

    // // create User
    // Route::get('users/index' , 'UserController@users')->name('users.customer.index');
    // Route::get('users/create' , 'UserController@create')->name('users.customer.create');
    // Route::post('users/store' , 'UserController@store')->name('users.customer.store');
    // Route::get('users/{id}/delete' , 'UserController@destroy')->name('users.customer.delete');


    // Route::resource('company' , 'CompanyController');
    // Route::post('company/{id}/update' , 'CompanyController@update')->name('company.customer.update');

    // Route::resource('order' , 'OrderController' , ['except' => ['update', 'destroy','edit']]);
    // Route::get('order/{id}/details/{order_id}' , 'OrderController@show')->name('customer.order.show');
    // Route::get('order/{id}/edit/{order_id}' , 'OrderController@edit')->name('customer.order.edit');
    // Route::post('order/{id}/update' , 'OrderController@update')->name('customer.order.update');
    // Route::get('order/{id}/pdf/{order_id}' , 'OrderController@pdf')->name('customer.order.pdf');
    // Route::post('orders/uploads/store' , 'OrderController@storefile')->name('customer.order.storefile');
    // // Route::post('download' , 'OrderController@downloadawb')->name('customer.order.downloadawb');


    // Route::get('/order/getRegion/{id}', 'OrderController@getRegion');
});