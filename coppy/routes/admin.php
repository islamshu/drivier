<?php

// Route::group(
// [
//     'prefix' => LaravelLocalization::setLocale(),
//     'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ],
//     'namespace' => 'Admin',
// ], function(){ 
    
// });
Route::group(
    ['namespace' => 'Admin'], function() {


    
    // Route::get('/', 'HomeController@index')->name('admin.dashboard');

    // Route::get('profile' , 'AdminController@showAdminProfile')->name('admin.profile');

    // // Login
    // Route::get('login', 'Auth\LoginController@showLoginForm')->name('admin.login');
    // Route::post('login', 'Auth\LoginController@login');
    // Route::post('logout', 'Auth\LoginController@logout')->name('admin.logout');

    // // Register
    // Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('admin.register');
    // Route::post('register', 'Auth\RegisterController@register');
    // Route::get('/{admin}/edit', 'Auth\RegisterController@edit')->name('admin.edit');
    // Route::delete('/{admin}', 'Auth\RegisterController@destroy')->name('admin.delete');
    // Route::patch('/{admin}', 'Auth\RegisterController@update')->name('admin.update');

    // // Passwords
    // Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    // Route::post('password/reset', 'Auth\ResetPasswordController@reset');
    // Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    // Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('admin.password.reset');
    // Route::GET('/password/change', 'AdminController@showChangePasswordForm')->name('admin.password.change');
    // Route::POST('/password/change', 'AdminController@changePassword');
    

    // // Must verify email
    // Route::get('email/resend','Auth\VerificationController@resend')->name('admin.verification.resend');
    // Route::get('email/verify','Auth\VerificationController@show')->name('admin.verification.notice');
    // Route::get('email/verify/{id}','Auth\VerificationController@verify')->name('admin.verification.verify');

    

    // Route::get('/show', 'AdminController@show')->name('admin.show');

    // // Admin Roles
    // Route::post('/{admin}/role/{role}', 'AdminRoleController@attach')->name('admin.attach.roles');
    // Route::delete('/{admin}/role/{role}', 'AdminRoleController@detach');
    
    // // Roles
    // Route::get('/roles', 'RoleController@index')->name('admin.roles');
    // Route::get('/role/create', 'RoleController@create')->name('admin.role.create');
    // Route::post('/role/store', 'RoleController@store')->name('admin.role.store');
    // Route::delete('/role/{role}', 'RoleController@destroy')->name('admin.role.delete');
    // Route::get('/role/{role}/edit', 'RoleController@edit')->name('admin.role.edit');
    // Route::patch('/role/{role}', 'RoleController@update')->name('admin.role.update');
    

    
    

    // // this app
    // Route::resource('customer' , 'CustomerController');
    // Route::post('customer/imports/store' , 'CustomerController@import')->name('admin.customer.import');
    
    // Route::resource('cities' , 'CityController');
    // Route::post('cities/{id}/update' , 'CityController@update')->name('cities.edit.update');
    // Route::get('cities/{id}/delete', 'CityController@destroy');
    // Route::get('cities/{city_id}/region', 'CityController@addRegion')->name('cities.region');
    // Route::post('cities/{city_id}/region/store', 'CityController@storeRegion')->name('cities.region.store');
    
    // Route::resource('companies' , 'CompanyController');
    // Route::post('companies/{id}/update' , 'CompanyController@update')->name('companies.edit.update');

    // Route::resource('orders' , 'OrderController');
    // Route::get('orders/{id}/pdf/{order_id}' , 'OrderController@pdf')->name('admin.order.pdf');
    // Route::post('orders/{id}/update' , 'OrderController@update')->name('orders.edit.update');
    // Route::post('orders/status/change' , 'OrderController@changeStatus')->name('admin.order.changeStatus');
    
    // Route::resource('drivers' , 'DriverController');
    // Route::post('drivers/{id}/update' , 'DriverController@update')->name('drivers.edit.update');
    // Route::get('driver/destroy/{id}', 'DriverController@destroy')->name('drivers.destroy.delete');

    // // Reports 

    // Route::get('reports/clients' , 'ReportController@clients')->name('clients.index');
    // Route::get('reports/companies' , 'ReportController@companies')->name('report.companies.index');
});