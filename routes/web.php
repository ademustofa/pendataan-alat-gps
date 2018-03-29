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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile', 'HomeController@profile')->name('profile');
Route::get('/getName', 'HomeController@getName');
Route::post('/changeName', 'HomeController@updateName');
Route::post('/changePassword', 'HomeController@updatePassword');
Route::get('/data-gps', 'HomeController@showDataGps')->name('dataGps');
Route::get('/getDataGps', 'HomeController@getAllGps');
Route::post('/createData', 'HomeController@createGps');
Route::post('/updateData', 'HomeController@updateGps');
Route::delete('/deleteDataGps/{id}', 'HomeController@deleteGps');
Route::get('/users/logout', 'Auth\LoginController@userLogout')->name('user.logout');



Route::get('/admin', 'AdminController@index')->name('admin.dashboard');
Route::get('/admin/users', 'AdminController@getUser')->name('admin.user');
Route::get('/admin/manage-gps', 'AdminController@manageGps')->name('admin.dataGps');
Route::get('/admin/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('/admin/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
Route::get('/admin/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
Route::get('/admin/getDataGps', 'AdminController@getAllGps');
Route::post('/admin/createData', 'AdminController@createGps');
Route::post('/admin/updateData', 'AdminController@updateGps');
Route::delete('/admin/deleteDataGps/{id}', 'AdminController@deleteGps');

Route::get('/admin/getAllUser', 'AdminController@getDataUser');
Route::post('/admin/createUser', 'AdminController@createUser');
Route::post('/admin/updateUser', 'AdminController@updateUser');
Route::delete('/admin/deleteUser/{id}', 'AdminController@deleteUser');



