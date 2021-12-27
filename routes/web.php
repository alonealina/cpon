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
Route::get('restaurants/{id}/comment_list', 'App\Http\Controllers\RestaurantController@comment_list')->name('restaurant.comment_list');
Route::get('restaurants/{id}/comment_list_sp', 'App\Http\Controllers\RestaurantController@comment_list_sp')->name('restaurant.comment_list_sp');
Route::get('restaurants/{id}/allmenu', 'App\Http\Controllers\RestaurantController@show_allmenu')->name('restaurant.show_allmenu');
Route::get('restaurants/{id}/comment', 'App\Http\Controllers\RestaurantController@comment_form')->name('restaurant.comment_form');
Route::get('restaurants/{id}/comment_sp', 'App\Http\Controllers\RestaurantController@comment_form_sp')->name('restaurant.comment_form_sp');
Route::post('restaurants/comment_store', 'App\Http\Controllers\RestaurantController@comment_store')->name('restaurant.comment_store');

// 以下管理側 //
Route::get('admin/', 'App\Http\Controllers\AdminController@index')->name('admin.index');
// ->middleware('login');
Route::get('admin/restaurant_list', 'App\Http\Controllers\AdminRestaurantController@restaurant_list')->name('admin.restaurant_list')->middleware('login');
Route::get('admin/restaurant_list_update', 'App\Http\Controllers\AdminRestaurantController@restaurant_list_update')->name('admin.restaurant_list_update')->middleware('login');
Route::get('admin/restaurant_regist', 'App\Http\Controllers\AdminRestaurantController@restaurant_regist')->name('admin.restaurant_regist')->middleware('login');
Route::post('admin/restaurant_store', 'App\Http\Controllers\AdminRestaurantController@restaurant_store')->name('admin.restaurant_store')->middleware('login');
Route::get('admin/restaurant_edit/{id}/', 'App\Http\Controllers\AdminRestaurantController@restaurant_edit')->name('admin.restaurant_edit')->middleware('login');
Route::post('admin/restaurant_update', 'App\Http\Controllers\AdminRestaurantController@restaurant_update')->name('admin.restaurant_update')->middleware('login');
Route::get('admin/restaurant_csv_export', 'App\Http\Controllers\AdminRestaurantController@restaurant_csv_export')->name('admin.restaurant_csv_export')->middleware('login');
Route::post('admin/restaurant_csv_import', 'App\Http\Controllers\AdminRestaurantController@restaurant_csv_import')->name('admin.restaurant_csv_import')->middleware('login');
Route::get('admin/restaurant_delete/{id}/', 'App\Http\Controllers\AdminRestaurantController@restaurant_delete')->name('admin.restaurant_delete')->middleware('login');

Route::get('admin/menu_list/{id}/', 'App\Http\Controllers\MenuController@menu_list')->name('admin.menu_list')->middleware('login');
Route::get('admin/menu_list_update', 'App\Http\Controllers\MenuController@menu_list_update')->name('admin.menu_list_update')->middleware('login');
Route::get('admin/menu_regist/{id}/', 'App\Http\Controllers\MenuController@menu_regist')->name('admin.menu_regist')->middleware('login');
Route::post('admin/menu_store', 'App\Http\Controllers\MenuController@menu_store')->name('admin.menu_store')->middleware('login');
Route::get('admin/menu_edit/{id_r}/{id_m}/', 'App\Http\Controllers\MenuController@menu_edit')->name('admin.menu_edit')->middleware('login');
Route::post('admin/menu_update', 'App\Http\Controllers\MenuController@menu_update')->name('admin.menu_update')->middleware('login');
Route::get('admin/menu_csv_export', 'App\Http\Controllers\MenuController@menu_csv_export')->name('admin.menu_csv_export')->middleware('login');
Route::post('admin/menu_csv_import', 'App\Http\Controllers\MenuController@menu_csv_import')->name('admin.menu_csv_import')->middleware('login');
Route::get('admin/menu_delete/{id_r}/{id_m}/', 'App\Http\Controllers\MenuController@menu_delete')->name('admin.menu_delete')->middleware('login');

Route::get('admin/notice_list', 'App\Http\Controllers\NoticeController@notice_list')->name('admin.notice_list')->middleware('login');
Route::get('admin/notice_list_update', 'App\Http\Controllers\NoticeController@notice_list_update')->name('admin.notice_list_update')->middleware('login');
Route::get('admin/notice_regist', 'App\Http\Controllers\NoticeController@notice_regist')->name('admin.notice_regist')->middleware('login');
Route::post('admin/notice_store', 'App\Http\Controllers\NoticeController@notice_store')->name('admin.notice_store')->middleware('login');
Route::get('admin/notice_edit/{id}/', 'App\Http\Controllers\NoticeController@notice_edit')->name('admin.notice_edit')->middleware('login');
Route::post('admin/notice_update', 'App\Http\Controllers\NoticeController@notice_update')->name('admin.notice_update')->middleware('login');
Route::get('admin/notice_delete/{id}/', 'App\Http\Controllers\NoticeController@notice_delete')->name('admin.notice_delete')->middleware('login');

Route::get('admin/banner_list', 'App\Http\Controllers\BannerController@banner_list')->name('admin.banner_list')->middleware('login');
Route::get('admin/banner_regist', 'App\Http\Controllers\BannerController@banner_regist')->name('admin.banner_regist')->middleware('login');
Route::post('admin/banner_store', 'App\Http\Controllers\BannerController@banner_store')->name('admin.banner_store')->middleware('login');
Route::get('admin/banner_edit/{id}/', 'App\Http\Controllers\BannerController@banner_edit')->name('admin.banner_edit')->middleware('login');
Route::post('admin/banner_update', 'App\Http\Controllers\BannerController@banner_update')->name('admin.banner_update')->middleware('login');
Route::get('admin/banner_delete/{id}/', 'App\Http\Controllers\BannerController@banner_delete')->name('admin.banner_delete')->middleware('login');

Route::get('admin/setting_list', 'App\Http\Controllers\SettingController@setting_list')->name('admin.setting_list')->middleware('login');
Route::get('admin/scene_regist', 'App\Http\Controllers\SettingController@scene_regist')->name('admin.scene_regist')->middleware('login');
Route::post('admin/scene_store', 'App\Http\Controllers\SettingController@scene_store')->name('admin.scene_store')->middleware('login');
Route::get('admin/scene_edit/{id}/', 'App\Http\Controllers\SettingController@scene_edit')->name('admin.scene_edit')->middleware('login');
Route::post('admin/scene_update', 'App\Http\Controllers\SettingController@scene_update')->name('admin.scene_update')->middleware('login');
Route::get('admin/scene_delete/{id}/', 'App\Http\Controllers\SettingController@scene_delete')->name('admin.scene_delete')->middleware('login');
Route::get('admin/commitment_regist', 'App\Http\Controllers\SettingController@commitment_regist')->name('admin.commitment_regist')->middleware('login');
Route::post('admin/commitment_store', 'App\Http\Controllers\SettingController@commitment_store')->name('admin.commitment_store')->middleware('login');
Route::get('admin/commitment_edit/{id}/', 'App\Http\Controllers\SettingController@commitment_edit')->name('admin.commitment_edit')->middleware('login');
Route::post('admin/commitment_update', 'App\Http\Controllers\SettingController@commitment_update')->name('admin.commitment_update')->middleware('login');
Route::get('admin/commitment_delete/{id}/', 'App\Http\Controllers\SettingController@commitment_delete')->name('admin.commitment_delete')->middleware('login');

Route::get('admin/comment_list/{id}/', 'App\Http\Controllers\CommentController@comment_list')->name('admin.comment_list')->middleware('login');
Route::get('admin/comment_list_update', 'App\Http\Controllers\CommentController@comment_list_update')->name('admin.comment_list_update')->middleware('login');
Route::get('admin/comment_detail/{id_r}/{id_c}/', 'App\Http\Controllers\CommentController@comment_detail')->name('admin.comment_detail')->middleware('login');
Route::get('admin/comment_delete/{id_r}/{id_c}/', 'App\Http\Controllers\CommentController@comment_delete')->name('admin.comment_delete')->middleware('login');

// ログイン
Route::get('admin/login', function () {
    return view('admin/login');
});
Route::POST('/admin_login', 'App\Http\Controllers\AdminController@login')->name('admin.login');
Route::get('/admin_logout', 'App\Http\Controllers\AdminController@logout')->name('admin.logout')->middleware('login');