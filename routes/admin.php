<?php

    Route::GET('/home', 'AdminController@index')->name('admin.home');
    // Login and Logout
    Route::GET('/', 'LoginController@showLoginForm')->name('admin.login');
    Route::POST('/', 'LoginController@login');
    Route::POST('/logout', 'LoginController@logout')->name('admin.logout');

    // Password Resets
    Route::POST('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::GET('/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::POST('/password/reset', 'ResetPasswordController@reset');
    Route::GET('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::GET('/password/change', 'AdminController@showChangePasswordForm')->name('admin.password.change');
    // Route::POST('/password/change', 'AdminController@changePassword');
    Route::POST('/password/change', '\App\Http\Controllers\Admin\AdminController@changePassword')->middleware('auth:admin')->middleware('role:super;restaturaa');
    // Register Admins
    Route::get('/register', 'RegisterController@showRegistrationForm')->name('admin.register');
    Route::post('/register', 'RegisterController@register');
    Route::get('/{admin}/edit', 'RegisterController@edit')->name('admin.edit');
    Route::delete('/{admin}', 'RegisterController@destroy')->name('admin.delete');
    Route::patch('/{admin}', 'RegisterController@update')->name('admin.update');

    // Admin Lists
    Route::get('/show', 'AdminController@show')->name('admin.show');
    Route::get('/me', 'AdminController@me')->name('admin.me');

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

    // active status
    Route::post('activation/{admin}', 'ActivationController@activate')->name('admin.activation');
    Route::delete('activation/{admin}', 'ActivationController@deactivate');
    Route::resource('permission', 'PermissionController');

    Route::fallback(function () {
        return abort(404);
    });

    Route::get('dashboard','\App\Http\Controllers\Admin\DashboardController@fetch')->middleware('auth:admin')->middleware('role:super;restaturaa');

    Route::get('maindashboard','\App\Http\Controllers\Admin\DashboardController@maindashboard')->middleware('auth:admin')->middleware('role:super;restaturaa');

    Route::get('update/{id}/{status}','\App\Http\Controllers\Admin\DashboardController@update')->middleware('auth:admin')->middleware('role:super;restaturaa');

    Route::get('upload','\App\Http\Controllers\Admin\UploadController@index')->middleware('auth:admin')->middleware('role:super;restaturaa');
    
    Route::post('uploadCategory', '\App\Http\Controllers\Admin\UploadController@uploadCategory')->middleware('auth:admin')->middleware('role:super;restaturaa');

    Route::post('uploadCategoryItem', '\App\Http\Controllers\Admin\UploadController@uploadCategoryItem')->middleware('auth:admin')->middleware('role:super;restaturaa');

    Route::post('uploadHindiCategory', '\App\Http\Controllers\Admin\UploadController@uploadHindiCategory')->middleware('auth:admin')->middleware('role:super;restaturaa');

    Route::post('uploadHindiCategoryItems', '\App\Http\Controllers\Admin\UploadController@uploadHindiCategoryItems')->middleware('auth:admin')->middleware('role:super;restaturaa');

    Route::get('profile','\App\Http\Controllers\Admin\DashboardController@profile')->middleware('auth:admin')->middleware('role:super;restaturaa');

    Route::get('past_orders','\App\Http\Controllers\Admin\DashboardController@past_orders')->middleware('auth:admin')->middleware('role:super;restaturaa');

    Route::get('analytics','\App\Http\Controllers\Admin\AnalyticsController@index')->middleware('auth:admin')->middleware('role:super;restaturaa');

    Route::get('menu_upload','\App\Http\Controllers\Admin\MenuController@index')->middleware('auth:admin')->middleware('role:super;restaturaa');

    Route::post('category','\App\Http\Controllers\Admin\MenuController@add')->middleware('auth:admin')->middleware('role:super;restaturaa');

    Route::post('delete','\App\Http\Controllers\Admin\MenuController@delete')->middleware('auth:admin')->middleware('role:super;restaturaa');

    Route::post('edit','\App\Http\Controllers\Admin\MenuController@edit')->middleware('auth:admin')->middleware('role:super;restaturaa');

    Route::get('settings','\App\Http\Controllers\Admin\DashboardController@settings')->middleware('auth:admin')->middleware('role:super;restaturaa');

    Route::post('update_tax','\App\Http\Controllers\Admin\DashboardController@update_settings')->middleware('auth:admin')->middleware('role:super;restaturaa');

    Route::get('license','\App\Http\Controllers\Admin\LicenseController@index')->middleware('auth:admin')->middleware('role:super;restaturaa')->name('license');

    Route::post('update_license','\App\Http\Controllers\Admin\LicenseController@update_license')->middleware('auth:admin')->middleware('role:super;restaturaa');

    Route::get('generatekey','\App\Http\Controllers\Admin\LicenseController@generatekey')->middleware('auth:admin')->middleware('role:super')->name('generatekey');

    Route::post('license_generate','\App\Http\Controllers\Admin\LicenseController@license_generate')->middleware('auth:admin')->middleware('role:super;restaturaa');

    Route::post('refresh','\App\Http\Controllers\Admin\DashboardController@refresh')->middleware('auth:admin')->middleware('role:super;restaturaa');