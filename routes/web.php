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
Route::get('/', 'StoreController@home')->name('home');
Route::get('/home', 'StoreController@home');

Route::get('/signup', 'StoreController@signup')->name('signup');
Route::post('/signup', 'StoreController@storeSignup')->name('signupPost');
Route::get('/login', 'StoreController@login')->name('login');
Route::get('/logout', 'StoreController@logout');
Route::post('/login', 'StoreController@storeLogin')->name('loginPost');
Route::get('/user', 'StoreController@userPage')->name('user');
Route::post('/storeRequest', 'StoreController@storeRequest')->name('storeRequest');
Route::post('/addEmployee', 'StoreController@addEmployee')->name('addEmployee');
Route::post('/removeEmployee/{employee}', 'StoreController@removeEmployee')->name('removeEmployee');
Route::get('/inventory', 'StoreController@inventory')->name('inventory');
Route::post('/removeStore/{store}', 'StoreController@removeStore')->name('removeStore');
Route::post('/acceptStore/{store}', 'StoreController@acceptStore')->name('acceptStore');
Route::get('/manageStores', 'StoreController@manageStores')->name('manageStores');
Route::post('/disableStore/{store}', 'StoreController@disableStore')->name('disableStore');
Route::post('/viewInventory/{store}', 'StoreController@viewInventory')->name('viewInventory');
Route::get('/viewInventory/{store}', 'StoreController@viewInventory')->name('viewInventory');
Route::post('/editItem/{item}', 'StoreController@editItem')->name('editItem');
Route::post('/saveItemEdits/{item}', 'StoreController@saveItemEdits')->name('saveItemEdits');
Route::get('/editItem/{item}', 'StoreController@editItem')->name('editItem');
Route::post('/addItem', 'StoreController@addItem')->name('addItem');
Route::post('/removeItem/{item}', 'StoreController@removeItem')->name('removeItem');
Route::post('/editAddress', 'StoreController@editAddress')->name('editAddress');