<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\CponController@index')->name('index');
Route::get('search/','App\Http\Controllers\CponController@search')->name('search');
Route::get('search_sp/','App\Http\Controllers\CponController@search_sp')->name('search_sp');
Route::get('filter/','App\Http\Controllers\CponController@filter')->name('filter');
Route::get('new/','App\Http\Controllers\CponController@new')->name('new');
Route::get('category/{id}','App\Http\Controllers\CponController@category')->name('category');
Route::get('help', 'App\Http\Controllers\CponController@help')->name('help');
Route::get('policy', 'App\Http\Controllers\CponController@policy')->name('policy');
Route::get('terms', 'App\Http\Controllers\CponController@terms')->name('terms');

Route::resource('cpon', 'CponController');

Route::get('notices/', 'App\Http\Controllers\NoticeController@index')->name('notice.index');
Route::get('notices/{id}', 'App\Http\Controllers\NoticeController@show')->name('notice.show');

Route::get('restaurants/{id}/show', 'App\Http\Controllers\RestaurantController@show')->name('restaurant.show');
Route::get('restaurants/{id}/detail', 'App\Http\Controllers\RestaurantController@detail')->name('restaurant.detail');
Route::get('restaurants/{id}/comment_list_sp', 'App\Http\Controllers\RestaurantController@comment_list_sp')->name('restaurant.comment_list_sp');
Route::get('restaurants/{id}/allmenu', 'App\Http\Controllers\RestaurantController@show_allmenu')->name('restaurant.show_allmenu');
Route::get('restaurants/{id}/comment', 'App\Http\Controllers\RestaurantController@comment_form')->name('restaurant.comment_form');
Route::get('restaurants/{id}/comment_sp', 'App\Http\Controllers\RestaurantController@comment_form_sp')->name('restaurant.comment_form_sp');
Route::post('restaurants/comment_store', 'App\Http\Controllers\RestaurantController@comment_store')->name('restaurant.comment_store');

// 以下管理側 //

Route::get('admin/restaurant_regist', 'App\Http\Controllers\AdminController@restaurant_regist')->name('admin.restaurant_regist');
Route::post('admin/restaurant_store', 'App\Http\Controllers\AdminController@restaurant_store')->name('admin.restaurant_store');
Route::get('admin/notice_regist', 'App\Http\Controllers\AdminController@notice_regist')->name('admin.notice_regist');
Route::post('admin/notice_store', 'App\Http\Controllers\AdminController@notice_store')->name('admin.notice_store');
Route::get('admin/notice_edit/{id}/', 'App\Http\Controllers\AdminController@notice_edit')->name('admin.notice_edit');
Route::post('admin/notice_update', 'App\Http\Controllers\AdminController@notice_update')->name('admin.notice_update');
