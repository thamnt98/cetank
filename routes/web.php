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
Route::get('admin/logout', 'Admin\LoginController@logout')->name('admin.logout');

Route::get('admin-dashboard', 'DashboardController@getDashboard')->name('dashboard');
Route::get('/{slug}', 'HomeController@getList')->name('post.list');
Route::get('tags/{tag}', 'HomeController@getPostByTag')->name('tag.list')->where('tag', '.*');
Route::get('post/{slug}','HomeController@detailsBlog')->name('post.detail');
Route::post('user/comments', 'HomeController@createComment')->name('comment.create');
Auth::routes();
Route::get('user/logout', 'Auth\LoginController@logout')->name('user.logout');
Route::get('/auth/redirect/{provider}', 'Auth\SocialController@redirect');
Route::get('/callback/{provider}', 'Auth\SocialController@callback');
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
    Route::group(['prefix' => 'f319'], function () {
        Route::get('all', 'CrawalPostController@all')->name('f319.all')->middleware('auth:admin');
        Route::get('edit/{id}', 'CrawalPostController@createPost')->name('f319.edit')->middleware('auth:admin');
        Route::post('delete', 'CrawalPostController@delete')->name('f319.delete')->middleware('auth:admin');

    });
        Route::get('all', 'StaffController@index')->name('staff.all');
        Route::get('edit/{id}', 'StaffController@edit')->name('staff.edit');
        Route::post('update', 'StaffController@update')->name('staff.update');
        Route::post('delete', 'StaffController@destroy')->name('staff.delete');
        Route::post('publish', 'StaffController@publish')->name('staff.publish');
        Route::get('create', 'StaffController@create')->name('staff.create');
        Route::post('store', 'StaffController@store')->name('staff.store');
    Route::get('manage-category','Admin\CategoryController@manageCategory')->name('category.list');
    Route::post('manage-category', 'Admin\CategoryController@storeCategory')->name('category.store');
    Route::get('manage-category/{product_id?}','Admin\CategoryController@editCategory')->name('category.edit');
    Route::put('manage-category/{product_id?}','Admin\CategoryController@updateCategory')->name('category.update');
    Route::delete('/manage-category/{product_id?}','Admin\CategoryController@deleteItem')->name('category.delete');
});
