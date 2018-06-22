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

Route::resource('/', 'ShowController');

Route::get('province/{id}', 'ShowController@province');
Route::get('district/{id}', 'ShowController@district');

Route::get('detail/{id}', 'DetailController@show');

Route::get('search', 'SearchController@Search');

// post home
Route::get('dang-tin', 'PostController@index');
Route::post('dang-tin', 'PostController@posthome');

Route::get('type/{type}', 'ShowController@ShowType');

Route::get('datatable', 'ShowController@Datatable');

Route::get('export-excel', 'ShowController@export');

Route::post('import-excel', 'ShowController@import');

Route::get('user', 'ShowController@user');

Route::post('login', ['as' => 'login', 'uses' => 'LoginController@login']);

Route::get('logout', ['as' => 'logout', 'uses' => 'LoginController@logout']);

Route::get('register', 'LoginController@register');
Route::post('register', 'LoginController@postuser');

Route::get('quan-ly-bai-dang', 'ShowController@manager');

Route::get('export-database', 'ShowController@export_db');

Route::post('import-db', 'ShowController@import_db');

Route::get('drop-home/{id}', 'AdminController@Drop_home');

Route::get('edit-home/{id}', 'AdminController@Edit_home');

Route::post('save-home', 'AdminController@Savehome');

Route::get('admin/dang-nhap', 'AdminController@Login');
Route::post('admin/dang-nhap', 'AdminController@PostLogin');
//contact
Route::get('lien-he', 'ShowController@Contact');

// Admin page
Route::group(['prefix' => 'admin', 'middleware' => 'adminmiddleware'], function () {
	Route::get('/', 'AdminController@index');
	Route::get('quan-ly-bai-dang', 'AdminController@manager_post_home');
	Route::get('editshow/{id}/{val}', 'AdminController@EditShow');
	Route::get('del-home/{id}', 'AdminController@DelHome');
	Route::get('quan-ly-nguoi-dung', 'AdminController@ManagerUser');
	Route::get('getuser/{id}', 'AdminController@GetUser');
	Route::post('option-user', 'AdminController@OptinoUser');
	Route::get('signout', 'AdminController@SignOut');
	Route::get('del-account/{id}', 'AdminController@DelAcount');
	Route::get('quan-ly-chuyen-muc', 'AdminController@ManagerType');
	Route::get('option-type/{id}', 'AdminController@OptionType');
	Route::post('option-type', 'AdminController@PostOptionType');
	Route::post('add-type', 'AdminController@AddType');
	Route::get('del-type/{id}', 'AdminController@DelType');
});