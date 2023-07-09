<?php

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Rating;
use App\Models\Questionair;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;




// Admin Routes
Route::group(
[
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ],
], function(){
    
    // Route::get('test' , 'Admin\FirebaseController@index');


    // Route::get('payment' , function() {
    //     return view('customer.orders.checkout');
    // });
    Route::get('/', 'AppController@index');

    Route::get('/business' , 'AppController@business');
    Route::get('/fleet' , 'AppController@fleet');
    Route::get('/contact' , 'AppController@contact');
    Route::post('/contact/store' , 'AppController@storeContact')->name('contact.store');
    Route::get('/terms' , 'AppController@terms');
    Route::get('/join' , 'AppController@join');
    Route::get('/careers' , 'AppController@careers');
    Route::post('/cateer/store' , 'AppController@storeCareer')->name('career.store');

    
    Route::get('/driver/signup' , 'AppController@signup')->name('driver.signup');
    Route::post('/driver/store' , 'AppController@signupStore')->name('driver.store');
    Route::get('/privicyandpolicy', 'AppController@privacy');
    Route::get('t/{id}/{code}' , 'AppController@trackingURL');
    Route::get('/track' , 'AppController@track');
    Route::get('user/{id}/rating' , 'AppController@rating')->name('user.rating');
    Route::post('user/rating/{id}/store' , 'AppController@ratingStore')->name('user.store.rating');
    // Admin Panel Routes 

    Route::group(
        [
            'namespace' => 'Admin',
            'prefix' => 'admin',
        ] , function() {
            
            Route::get('/', 'HomeController@index')->name('admin.dashboard');
            Route::get('profile' , 'AdminController@showAdminProfile')->name('admin.profile');

            // Login
            Route::get('login', 'Auth\LoginController@showLoginForm')->name('admin.login');
            Route::post('login', 'Auth\LoginController@login');
            Route::post('logout', 'Auth\LoginController@logout')->name('admin.logout');

            // Register
            Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('admin.register');
            Route::post('register', 'Auth\RegisterController@register');
            Route::get('/{admin}/edit', 'Auth\RegisterController@edit')->name('admin.edit');
            Route::get('user/{admin}', 'Auth\RegisterController@destroy')->name('admin.delete');
            Route::patch('/{admin}', 'Auth\RegisterController@update')->name('admin.update');

            // Passwords
            Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
            Route::post('password/reset', 'Auth\ResetPasswordController@reset');
            Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
            Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('admin.password.reset');
            Route::GET('/password/change', 'AdminController@showChangePasswordForm')->name('admin.password.change');
            Route::POST('/password/change', 'AdminController@changePassword');
            

            // Must verify email
            // Route::get('email/resend','Auth\VerificationController@resend')->name('admin.verification.resend');
            // Route::get('email/verify','Auth\VerificationController@show')->name('admin.verification.notice');
            // Route::get('email/verify/{id}','Auth\VerificationController@verify')->name('admin.verification.verify');

            

            Route::get('/show', 'AdminController@show')->name('admin.show');

            // Admin Roles
            Route::post('/{admin}/role/{role}', 'AdminRoleController@attach')->name('admin.attach.roles');
            Route::delete('/{admin}/role/{role}', 'AdminRoleController@detach');

            // Roles
            Route::get('/roles', 'RoleController@index')->name('admin.roles');
            Route::get('/role/create', 'RoleController@create')->name('admin.role.create');
            Route::post('/role/store', 'RoleController@store')->name('admin.role.store');
            Route::delete('/role/{role}', 'RoleController@destroy')->name('admin.role.delete');
            Route::get('/role/{role}/edit', 'RoleController@edit')->name('admin.role.edit');
            Route::patch('/role/{role}', 'RoleController@update')->name('admin.role.update');

            // this app
            Route::resource('customer' , 'CustomerController');
            Route::get('customer/{id}/change/password','CustomerController@changePassword')->name('customer.changePassword');
            Route::post('customer/{id}/save/password','CustomerController@storePassword')->name('customer.store.changePassword');
            // Route::post('customer/imports/store' , 'CustomerController@import')->name('admin.customer.import');
            Route::get('customer/{id}/delete', 'CustomerController@destroy');
            

            Route::resource('payments' , 'PaymentController');
            Route::get('customer/{customer_id}/payments' , 'PaymentController@payments')->name('customer.payments');
            Route::resource('sendsms'  , 'SendSmsController');


            Route::resource('cities' , 'CityController');
            Route::post('cities/{id}/update' , 'CityController@update')->name('cities.edit.update');
            Route::get('cities/{id}/delete', 'CityController@destroy');
            Route::get('cities/{city_id}/region', 'CityController@addRegion')->name('cities.region');
            Route::post('cities/{city_id}/region/store', 'CityController@storeRegion')->name('cities.region.store');
            
            Route::resource('companies' , 'CompanyController');
            Route::post('companies/{id}/update' , 'CompanyController@update')->name('companies.edit.update');
            Route::get('companies/{id}/active' , 'CompanyController@active')->name('companies.active');
            Route::get('companies/{id}/deactive','CompanyController@deactive')->name('companies.deactive');
            Route::get('companies/{id}/addBranch','CompanyController@addBranch')->name('companies.addBranch');
            Route::post('companies/{id}/storeBranch','CompanyController@storeBranch')->name('companies.storeBranch');

            Route::resource('orders' , 'OrderController');
            Route::get('ordres/goods_deliverey' , 'OrderController@goods_deliverey')->name('orders.goods_deliverey');
            Route::get('ordres/fast_deliverey' , 'OrderController@fast_deliverey')->name('orders.fast_deliverey');
            Route::get('orders/{id}/pdf/{order_id}' , 'OrderController@pdf')->name('admin.order.pdf');
            Route::post('orders/{id}/update' , 'OrderController@update')->name('orders.edit.update');
            Route::post('orders/status/change' , 'OrderController@changeStatus')->name('admin.order.changeStatus');
            Route::post('orders/upload' , 'OrderController@import')->name('admin.orders.import');


            Route::get('orders/requrire/attention' , 'OrderController@requrireAttention')->name('admin.orders.requrireAttention');
            Route::get('orders/suports/requests' , 'OrderController@supportRequest')->name('admin.orders.supportRequest');
            Route::post('orders/suports/{support_id}/store' , 'OrderController@supportStore')->name('admin.orders.supportStore');

            Route::post('orders/{id}/cancelOrder' , 'OrderController@cancelOrder')->name('admin.status.cancelOrder');

            

            Route::get('notifications' , 'OrderController@notifications')->name('admin.notifications');
            // Route::get('orders/out/riyadh' , 'OrderController@outriyadh')->name('orders.outriyadh');

            Route::get('map' , 'OrderController@map')->name('admin.map');

            Route::resource('vehicles' , 'VehiclesController');
            Route::post('vehicles/{id}/update' , 'VehiclesController@update')->name('vehicles.edit.update');
            Route::get('vehicle/active/{id}', 'VehiclesController@active')->name('vehicles.active');
            Route::get('vehicle/deactive/{id}', 'VehiclesController@deactive')->name('vehicles.deactive');

            Route::get('vehicle/all/active', 'VehiclesController@activeVeclies')->name('vehicles.index.active');
            Route::get('vehicle/all/deactive', 'VehiclesController@deactiveVeclies')->name('vehicles.index.deactive');


            Route::resource('drivers' , 'DriverController');
            Route::post('drivers/{id}/update' , 'DriverController@update')->name('drivers.edit.update');
            // Route::get('driver/destroy/{id}', 'DriverController@destroy')->name('drivers.destroy.delete');
            Route::get('driver/{driver_id}/status/{status_id}', 'DriverController@status')->name('drivers.status.change');
            Route::post('driver/{id}/addAttendance' , 'DriverController@attendance')->name('addAttendance.store');

            Route::get('drivers/all/activeDrivers' , 'DriverController@activeDrivers')->name('drivers.index.active');
            Route::get('drivers/all/pendingDrivers' , 'DriverController@pendingDrivers')->name('drivers.index.pending');
            Route::get('drivers/all/blockDrivers' , 'DriverController@blockDrivers')->name('drivers.index.block');

            Route::get('drivers/{id}/change/password','DriverController@changePassword')->name('drivers.changePassword');
            Route::post('drivers/{id}/save/password','DriverController@storePassword')->name('drivers.store.changePassword');

            // Reports 

            Route::get('reports/payments' , 'ReportController@payments')->name('report.payments.index');
            Route::post('reports/makePaid' , 'ReportController@makePaid')->name('report.makePaid.index');
            Route::get('reports/orders' , 'ReportController@orders')->name('report.orders.index');
            Route::get('reports/companies' , 'ReportController@companies')->name('report.companies.index');
            Route::get('reports/orders_by_company' , 'ReportController@orders_by_company')->name('report.orders_by_company.index');
            Route::get('reports/orders_by_driver' , 'ReportController@orders_by_driver')->name('report.orders_by_driver.index');
            Route::get('reports/reportpercity' , 'ReportController@reportpercity')->name('reportpercity.index');


            
            // Rating questions

            Route::resource('ratings/questionair' , 'RatingController');

            // ajax request
            Route::get('makeNotificationRead/{id}', 'OrderController@makeNotificationRead');
            Route::get('getUnreadNotification/{id}', 'OrderController@getUnreadNotification');


            Route::get('/map/mapCustomers/{id}', 'OrderController@mapCustomers');
            Route::get('/map/mapOrders/{id}', 'OrderController@mapOrders');
            Route::get('/map/mapOnlineDrivers/{id}', 'OrderController@mapOnlineDrivers');
            Route::get('/map/mapDrivers/{id}', 'OrderController@mapDrivers');
            
    });
    
    // customer Routes

    Route::group(
        [
            'namespace' => 'Customer',
            'prefix' => 'customer',
        ] , function() {

            Route::get('/', 'HomeController@index')->name('customer.dashboard');
            
            // Login
            Route::get('login', 'Auth\LoginController@showLoginForm')->name('customer.login');
            Route::post('login', 'Auth\LoginController@login');
            Route::post('logout', 'Auth\LoginController@logout')->name('customer.logout');

            // Register
            // Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('customer.register');
            // Route::post('register', 'Auth\RegisterController@register');
            // Route::post('register', 'Auth\RegisterController@comapnyRegister');

            Route::get('register' , 'RegCompanyController@showRegistrationForm')->name('customer.register'); 
            Route::post('company/singup' , 'RegCompanyController@signup')->name('company.signup'); 


            // Passwords
            Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('customer.password.email');
            Route::post('password/reset', 'Auth\ResetPasswordController@reset');
            Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('customer.password.request');
            Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('customer.password.reset');

            // Must verify email
            Route::get('email/resend','Auth\VerificationController@resend')->name('customer.verification.resend');
            Route::get('email/verify','Auth\VerificationController@show')->name('customer.verification.notice');
            Route::get('email/verify/{id}','Auth\VerificationController@verify')->name('customer.verification.verify');


            


            Route::group(['middleware' => 'CustomerAccNotActive'] , function() {
                
                Route::get('profile' , 'UserController@index')->name('customer.profile');
                Route::post('profile/{id}/update' , 'UserController@update')->name('customer.update');
                Route::post('profile/change' , 'UserController@changePassword')->name('customer.password.change');

                    // Customer Roles
                Route::post('/{customer}/role/{role}', 'CustomerRoleController@attach')->name('customer.attach.roles');
                Route::delete('/{customer}/role/{role}', 'CustomerRoleController@detach');
                
                // Roles
                Route::get('/roles', 'RoleController@index')->name('customer.roles');
                Route::get('/role/create', 'RoleController@create')->name('customer.role.create');
                Route::post('/role/store', 'RoleController@store')->name('customer.role.store');
                Route::delete('/role/{role}', 'RoleController@destroy')->name('customer.role.delete');
                Route::get('/role/{role}/edit', 'RoleController@edit')->name('customer.role.edit');
                Route::patch('/role/{role}', 'RoleController@update')->name('customer.role.update');



                // create User
                Route::get('users/index' , 'UserController@users')->name('users.customer.index');
                Route::get('users/create' , 'UserController@create')->name('users.customer.create');
                Route::post('users/store' , 'UserController@store')->name('users.customer.store');
                Route::get('users/{id}/delete' , 'UserController@destroy')->name('users.customer.delete');


                Route::resource('company' , 'CompanyController');
                Route::post('company/{id}/update' , 'CompanyController@update')->name('company.customer.update');

                Route::resource('order' , 'OrderController');
                Route::get('order/{id}/details/{order_id}' , 'OrderController@show')->name('customer.order.show');

                Route::post('order/upload' , 'OrderController@import')->name('customer.order.import');
                // Route::get('order/{id}/payment/{order_id}/checkout' , 'OrderController@checkout')->name('customer.order.checkout');
                // Route::post('order/{id}/payment/{order_id}/payment' , 'OrderController@payment')->name('customer.order.payment');

                Route::post('order/fastDelivery/store' , 'OrderController@fastOrder')->name('order.fastOrder.store');
                Route::get('orders/{id}/select_driver' , 'OrderController@select_driver')->name('orders.select_driver');
                
                Route::get('order/{id}/edit/{order_id}' , 'OrderController@edit')->name('customer.order.edit');
                Route::post('order/{id}/update' , 'OrderController@update')->name('customer.order.update');
                Route::get('order/{id}/pdf/{order_id}' , 'OrderController@pdf')->name('customer.order.pdf');
                Route::post('orders/uploads/store' , 'OrderController@storefile')->name('customer.order.storefile');
                Route::get('reports/payment' , 'ReportController@payments')->name('customer.report.payments');

                

                Route::post('orders/{id}/cancelOrder' , 'OrderController@cancelOrder')->name('order.status.cancelOrder');
                Route::post('orders/{id}/support' , 'OrderController@contact_to_support')->name('order.contact_to_support');

                // Route::get('map' , 'OrderController@map')->name('customer.map');

                Route::get('payment' , 'PaymentController@index')->name('customer.payment.index');
                Route::get('payment/addbalance' , 'PaymentController@payment_gateway')->name('customer.payment.gateway');
                Route::get('payment/gateway/credit' , 'PaymentController@payment_gateway_credit')->name('customer.payment.gateway.credit');
                Route::get('payment/gateway/STC_PAY' , 'PaymentController@payment_gateway_stc_pay')->name('customer.payment.gateway.stc_pay');
                Route::get('payment/checkout' , 'PaymentController@getCheckOutId')->name('customer.payment.checkout');
                Route::get('payment/checkout/card' , 'PaymentController@getCheckOutIdCredit')->name('customer.payment.checkout_card');
                Route::get('payment/checkout/STC_PAY' , 'PaymentController@getCheckOutId_STC_PAY')->name('customer.payment.checkout_STC_PAY');

                
                // ajax json for create order

                Route::get('/order/getRegion/{id}', 'OrderController@getRegion');
                Route::get('/order/getLatlng/{id}', 'OrderController@getLatlng');

            });
        
    });




    // Driver Routes

    Route::group(
        [
            'namespace' => 'Driver',
            'prefix' => 'driver',
        ], function() {
        
        Route::get('/', function() {

            if (Auth::guard('driver')->user()) {
                Auth::logout();
            }
            return view('driver.auth.passwords.resetDone')->with(['type' => 'success' , 'message' => trans('app.passwordSuccess')]);
        })->name('driver.dashboard');
    
        // // Login
        // Route::get('login', 'Auth\LoginController@showLoginForm')->name('driver.login');
        // Route::post('login', 'Auth\LoginController@login');
        // Route::post('logout', 'Auth\LoginController@logout')->name('driver.logout');
    
        // // Register
        // Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('driver.register');
        // Route::post('register', 'Auth\RegisterController@register');
    
        // // Passwords
        // Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('driver.password.email');
        Route::post('password/reset', 'Auth\ResetPasswordController@reset');
        Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('driver.password.request');
        Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('driver.password.reset');
    
        // Route::POST('/password/change', 'Auth\ResetPasswordController@changePassword')->name('driver.password.change');
            
        // // Must verify email
        // Route::get('email/resend','Auth\VerificationController@resend')->name('driver.verification.resend');
        // Route::get('email/verify','Auth\VerificationController@show')->name('driver.verification.notice');
        // Route::get('email/verify/{id}','Auth\VerificationController@verify')->name('driver.verification.verify');
    
    
        // Route::get('profile' , 'UserController@index')->name('driver.profile');
        // Route::post('profile/{id}/update' , 'UserController@update')->name('driver.update');
        // Route::post('profile/change' , 'UserController@changePassword')->name('driver.password.change');
    
    
        // Route::resource('myorders' , 'OrdersController');
        // Route::get('myorders/{id}/pdf/{order_id}' , 'OrdersController@pdf')->name('myorders.order.pdf');
        // Route::post('myorders/status/' , 'OrdersController@changeStatus')->name('myorders.order.changeStatus');
        

        // Route::get('map' , 'OrdersController@map')->name('driver.map');

        // Route::resource('driverReport' , 'ReportController');
    });

});



