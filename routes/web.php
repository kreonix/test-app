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

Route::get('/', 'ProductController@index')->name('index');
Route::post('/updateDataForm/{id}', 'ProductController@update');
Route::get('/getDataForm/{id}','ProductController@getDataForm');
Route::get('/deleteProduct/{id}','ProductController@delete');
Route::post('/createProduct', 'ProductController@create');
Route::get('/sort/{fieldsort}/{typesort}','ProductController@sort');
Route::get('/sort/{fieldsort}/{typesort}/view','ProductController@sortView');