<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

Route::prefix('v1')->group(function () {

    Route::post('login' , [ 'uses' => 'API\DriverController@login' ]);
    
    
    Route::post('password/email', ['uses' => 'Driver\Auth\ForgotPasswordController@sendResetLinkEmail'])->name('driver.password.email');
    Route::post('password/reset', ['uses' => 'Driver\Auth\ResetPasswordController@reset']);
    

});

Route::group(['middleware' => 'auth:api' , 'prefix' => 'v1'] , function() {
    Route::post('changePassword' , ['uses' => 'API\DriverController@changePassword']);
    Route::post('listOrders' , ['uses' => 'API\DriverController@listOrders']);
    Route::post('orders/history' , ['uses' => 'API\DriverController@ordersHistory']);

    Route::post('ar/notifications' , ['uses' => 'API\DriverController@ar_notifications']);
    Route::post('en/notifications' , ['uses' => 'API\DriverController@en_notifications']);

    Route::get('order/{id}/pdf/{order_id}' , 'API\DriverController@pdf')->name('driver.order.pdf');
    Route::post('showOrder' , ['uses' => 'API\DriverController@showOrder']);

    Route::post('driver/logout' , ['uses' => 'API\DriverController@userLogout']);

    Route::post('changeOrderStatus'        , ['uses' => 'API\DriverController@changeStatus']);
    
    Route::post('scanOrder'        , ['uses' => 'API\DriverController@scanOrder']);
    Route::post('driver/device_token'        , ['uses' => 'API\DriverController@device_token']);
    Route::post('driver/lat_long'        , ['uses' => 'API\DriverController@lat_long']);
    Route::post('order/support' , ['uses' => 'API\DriverController@support']);
    Route::post('order/response' , ['uses' => 'API\DriverController@accept']);

});



Route::prefix('v1')->group(function () {
    
    Route::get('down' , function() {
        Artisan::call('down');

        return 'yes';
    });


});