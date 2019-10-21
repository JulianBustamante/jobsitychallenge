<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', function () {
    return redirect('dashboard');
});
Route::get('/dashboard', 'DashboardController@index')->name('home');


Route::middleware('auth')->group(function () {
    Route::group(['namespace' => 'Users'], function () {
        // views
        Route::group(['prefix' => 'users'], function () {
            Route::view('/', 'users.index')
                ->middleware('permission:read-users');
            Route::view('/create', 'users.create')
                ->middleware('permission:create-users');
            Route::view('/{user}/edit', 'users.edit')
                ->middleware('permission:update-users');
        });

        // api
        Route::group(['prefix' => 'api/users'], function () {
            Route::get('/getUserRoles/{user}', 'UserController@getUserRoles');
            Route::get('/count', 'UserController@count');
            Route::post('/filter', 'UserController@filter')
                ->middleware('permission:read-users');

            Route::get('/{user}', 'UserController@show')
                ->middleware('permission:read-users');
            Route::post('/store', 'UserController@store')
                ->middleware('permission:create-users');
            Route::put('/update/{user}', 'UserController@update')
                ->middleware('permission:update-users');
            Route::delete('/{user}', 'UserController@destroy')
                ->middleware('permission:delete-users');
        });
    });
});

Route::middleware('auth')->group(function () {
    Route::group(['namespace' => 'Roles'], function() {
        // views
        Route::group(['prefix' => 'roles'], function() {
            Route::view('/', 'roles.index')->middleware('permission:read-roles');
            Route::view('/create', 'roles.create')->middleware('permission:create-roles');
            Route::view('/{role}/edit', 'roles.edit')->middleware('permission:update-roles');
        });
        // api
        Route::group(['prefix' => 'api/roles'], function() {
            Route::get('/count', 'RoleController@count');
            Route::get('/all', 'RoleController@all');
            Route::get('/getRoleModulesPermissions/{role}','RoleController@getRoleModulesPermissions');
            Route::post('/filter', 'RoleController@filter')->middleware('permission:read-roles');
            Route::get('/{role}', 'RoleController@show')->middleware('permission:read-roles');
            Route::post('/store', 'RoleController@store')->middleware('permission:create-roles');
            Route::put('/update/{role}', 'RoleController@update')->middleware('permission:update-roles');
            Route::delete('/{user}', 'RoleController@destroy')->middleware('permission:delete-roles');
        });
    });
});


Route::middleware('auth')->group(function () {
    Route::group(['namespace' => 'Roles'], function () {

        // api
        Route::group(['prefix' => 'api/permissions'], function () {
            Route::get('/count', 'PermissionController@count');
        });
    });
});

