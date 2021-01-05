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

Route::get('/', 'HomeController@getIndex')->name('home');
Route::get('admin/login', 'Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('admin/login', 'Admin\LoginController@login')->name('admin.login.post');
Route::get('admin-dashboard', 'DashboardController@getDashboard')->name('dashboard');
Route::get('/menu/{id}/{name}', 'HomeController@getMenu');
Auth::routes();

Route::group(['prefix' => 'admin'], function () {

    Route::group(['prefix' => 'post'], function () {
        Route::get('all', 'PostController@index')->name('post.all');
        Route::get('edit/{id}', 'PostController@edit')->name('post.edit');
        Route::post('update', 'PostController@update')->name('post.update');
        Route::post('delete', 'PostController@destroy')->name('post.delete');
        Route::post('publish', 'PostController@publish')->name('post.publish');
        Route::get('create', 'PostController@create')->name('post.create');
        Route::post('store', 'PostController@store')->name('post.store');
    });

    Route::group(['prefix' => 'menu'], function () {
        Route::get('create', 'WebSettingController@createMenu')->name('menu.create');
        Route::post('create', 'WebSettingController@storeMenu')->name('menu.store');
        Route::get('control', 'WebSettingController@manageMenu')->name('menu.control');
        Route::get('edit/{id}', 'WebSettingController@editMenu')->name('menu.edit');
        Route::post('update/{id}', 'WebSettingController@updateMenu')->name('menu.update');
        Route::post('delete', 'WebSettingController@deleteMenu')->name('menu.delete');
    });
});
