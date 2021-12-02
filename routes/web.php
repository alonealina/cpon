<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\CponController@index');
Route::get('search/','App\Http\Controllers\CponController@search')->name('search');
Route::get('filter/','App\Http\Controllers\CponController@filter')->name('filter');
Route::get('new/','App\Http\Controllers\CponController@new')->name('new');
Route::get('category/{id}','App\Http\Controllers\CponController@category')->name('category');

Route::resource('cpon', 'CponController');

Route::get('notices/', 'App\Http\Controllers\NoticeController@index')->name('notice.index');
Route::get('notices/{id}', 'App\Http\Controllers\NoticeController@show')->name('notice.show');

Route::get('restaurants/{id}/show', 'App\Http\Controllers\RestaurantController@show')->name('restaurant.show');
Route::get('restaurants/{id}/allmenu', 'App\Http\Controllers\RestaurantController@show_allmenu')->name('restaurant.show_allmenu');
Route::get('restaurants/{id}/comment', 'App\Http\Controllers\RestaurantController@comment_form')->name('restaurant.comment_form');
Route::post('restaurants/comment_store', 'App\Http\Controllers\RestaurantController@comment_store')->name('restaurant.comment_store');

