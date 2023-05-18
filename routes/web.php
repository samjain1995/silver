<?php

use Illuminate\Support\Facades\Route;

/*

|--------------------------------------------------------------------------

| Web Routes

|--------------------------------------------------------------------------

|

| Here is where you can register web routes for your application. These

| routes are loaded by the RouteServiceProvider within a group which

| contains the "web" middleware group. Now create something great!

|

 */

Route::get('/', function () {

    return redirect()->route('login');

});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::post('ckeditor/upload', 'HomeController@uploadCkEditorImage')->name('ckeditor.upload');

Route::get('/logout', function () {
    Auth::logout();
    Session::flush();
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('staff')->group(function () {
        Route::name('staff.')->group(function () {
            Route::namespace('Staff')->group(function () {

                Route::get('/', 'HomeController@index')->name('dashboard');
                Route::get('/security-guard', 'HomeController@securityGuard')->name('security-guard');
                Route::get('/security-guard-daly-report', 'HomeController@securityGuardDalyReport')->name('security-guard-daly-report');

                Route::get('/salesman-lead-list', 'HomeController@salesmanLeadList')->name('salesman-lead-list');
                Route::get('/salesman-lead-report', 'HomeController@salesmanLeadReport')->name('salesman-lead-report');

                Route::get('/salesman/customer/{id}', 'HomeController@salesmanCustomer')->name('salesman.customer');

                Route::post('/salesman/customer-update', 'HomeController@salesmanCustomerUpdate')->name('salesman.customer-update');

                Route::post('/salesman/no-sell-update', 'HomeController@noSellUpdate')->name('salesman.no-sell-update');

                Route::get('/customers/mobile-autocomplete', 'CustomerController@getMobileAutocompleteDate')->name('customer.mobile-autocomplete');

                Route::post('/customers/store', 'CustomerController@store')->name('customers.store');

                Route::get('/cashier-lead-list', 'HomeController@cashierLeadList')->name('cashier-lead-list');
                Route::get('/cashier/customer/{id}', 'HomeController@cashierCustomer')->name('cashier.customer');
                Route::post('/cashier/customer-update', 'HomeController@cashierCustomerUpdate')->name('cashier.customer-update');
                Route::get('/cashier', 'HomeController@cashier')->name('cashier');

                Route::post('/customer-by-texi', 'CustomerController@customerByTexi')->name('customer-by-texi');

                Route::post('/get-otp', 'CustomerController@getOtp')->name('get-otp');
                Route::post('/VarifyOtp', 'CustomerController@VarifyOtp')->name('VarifyOtp');

                Route::post('/update-customer-commission', 'CustomerController@updateCustomerCommission')->name('update-customer-commission');

                Route::get('/monthly-report', 'CustomerController@monthlyReport')->name('monthly-report');
                Route::get('/yearly-report', 'CustomerController@yearlyReport')->name('yearly-report');

                Route::get('/sales-person-monthly-report', 'CustomerController@salesPersonMonthlyReport')->name('sales-person-monthly-report');

            });

        });

    });

});

//---------------------------- ADMIN---------------------------------------------------------

Route::get('admin/login', 'Auth\Admin\LoginController@showLoginForm')->name('admin.login');

Route::post('admin-login', 'Auth\Admin\LoginController@login')->name('admin-login');

Route::get('admin/logout', 'Auth\Admin\LoginController@logout')->name('admin.logout');

Route::get('/tv-screen', 'Admin\HomeController@tvScreen')->name('tv-screen');

Route::middleware(['admin'])->group(function () {

    Route::prefix('admin')->group(function () {

        Route::name('admin.')->group(function () {

            Route::namespace('Admin')->group(function () {

                Route::get('/', 'HomeController@index')->name('admin-home');
                Route::get('/dashboard', 'HomeController@index')->name('dashboard');
                // Profile Route
                Route::get('/profile', 'HomeController@profile')->name('profile');
                Route::post('/update-profile', 'HomeController@updateProfile')->name('update.profile');
                // Change Password Route
                Route::get('/change-password', 'HomeController@change_password')->name('change-password');
                Route::post('/update-password', 'HomeController@update_password')->name('password.update');

                Route::prefix('customers')->group(function () {
                    Route::name('customers.')->group(function () {
                        Route::get('/', 'CustomerController@index')->name('index');
                        Route::get('/edit/{id}', 'CustomerController@edit')->name('edit');
                        Route::post('/update/{id}', 'CustomerController@update')->name('update');
                        Route::get('/show', 'CustomerController@show')->name('show');
                        Route::get('/daly-report', 'CustomerController@dalyReport')->name('daly-report');
                        Route::get('/monthly-report', 'CustomerController@monthlyReport')->name('monthly-report');
                        Route::get('/yearly-report', 'CustomerController@yearlyReport')->name('yearly-report');
                        Route::delete('/delete/{id}', 'CustomerController@delete')->name('delete');
                        Route::delete('/bulk-delete', 'CustomerController@bulkDelete')->name('bulk-delete');
                    });
                });

                Route::resources([
                    'roles' => 'RolesController',
                    'users' => 'UserController',
                    'modules' => 'ModuleController',
                    'permissions' => 'PermissionController',
                ]);

                /* Settings Routes */

                Route::prefix('settings')->group(function () {

                    Route::name('settings.')->group(function () {

                        Route::get('/general-settings', 'SettingsController@showGeneralSettingsForm')

                            ->name('general-settings');

                        Route::post('/save-general-settings', 'SettingsController@saveGeneralSettings')

                            ->name('save-general-settings');

                        Route::resources([

                            'email-templates' => 'EmailTemplateController',

                        ]);

                    });

                });

            });

        });

    });

});
