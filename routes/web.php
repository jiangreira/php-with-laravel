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
// testpage

use App\Http\Controllers\DataController;

Route::get('/', function () {
    return view('welcome');
});

//for login
Route::get('/sign', 'SignInOutController@Sign')->name('login');
Route::post('/sign', 'SignInOutController@SignIn')->name('loginprocess');
Route::get('/newregister', 'SignInOutController@Register');
Route::post('/newregister', 'SignInOutController@Newregister')->name('register');

// for logout
Route::get('/signout','SignInOutController@SignOut');

// after login 
Route::get('/home', 'NavLinkController@Showmenu')->name('home');
Route::get('/list', 'NavLinkController@ShowList')->name('list');
Route::get('/create', 'NavLinkController@Showcreate')->name('create');
Route::get('/charts', 'NavLinkController@Showcharts')->name('charts');

//Create 
Route::post('/create/add','DataController@add');
Route::get('/create/add','DataController@add');

//Edit
Route::get('/edit/{id}','DataController@ShowEdit');
Route::post('/edit/{id?}','DataController@edit');

//chart js

Route::get('/chooseperiod','DataController@ChoosePeriod');
Route::get('/chart1period','DataController@Chart1Period');
// test export
Route::get('excel/export','ExcelController@export');
Route::get('excel/import','ExcelController@import');
// list export
Route::get('list/exportlist','ExcelController@exportlist');
// list delete
Route::post('list/deletelist','DataController@deletedetail');
