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

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {

    //Post Routes
    Route::group(['prefix' => 'posts'], function () {
        Route::get('/', 'PostController@index')->middleware('permission:list-posts')->name('posts');
        Route::get('/create', 'PostController@create')->middleware('permission:add-post')->name('add-post');
        Route::post('/', 'PostController@store')->middleware('permission:add-post')->name('store-post');
        Route::get('/{id}/edit', 'PostController@edit')->middleware('permission:edit-post')->name('edit-post');
        Route::put('/{id}/update', 'PostController@update')->middleware('permission:edit-post')->name('update-post');
        Route::delete('/{id}/delete', 'PostController@delete')->middleware('permission:delete-post')->name('delete-post');
    });

    //Role Routes
    Route::group(['prefix' => 'roles'], function () {
        Route::get('/', 'RoleController@index')->middleware('permission:list-roles')->name('roles');
        Route::get('/create', 'RoleController@create')->middleware('permission:add-role')->name('add-role');
        Route::post('/', 'RoleController@store')->middleware('permission:add-role')->name('store-role');
        Route::get('/{id}/edit', 'RoleController@edit')->middleware('permission:edit-role')->name('edit-role');
        Route::put('/{id}/update', 'RoleController@update')->middleware('permission:edit-role')->name('update-role');
        Route::delete('/{id}/delete', 'RoleController@delete')->middleware('permission:delete-role')->name('delete-role');
    });

    //User Routes
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', 'UserController@index')->middleware('permission:list-users')->name('users');
        Route::get('/{id}/delete', 'UserController@delete')->middleware('permission:delete-user')->name('delete-user');
        Route::put('/ajax/role/update', 'UserController@ajaxRoleUpdate')->middleware('permission:edit-user')->name('update-user-role');
    });


});

