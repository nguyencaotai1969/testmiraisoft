<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

#task 1
Route::prefix('/user')->group(function () {

    //get all account or getone
    Route::get('/{getone?}', 'Api\AccountController@index')->name('get-user');

    //create account
    Route::post('/', 'Api\AccountController@create')->name('post-user');

    //update account
    Route::put('/{registerID}', 'Api\AccountController@update')->name('update-user');
    
    //delete account
    Route::delete('/{registerID}', 'Api\AccountController@delete')->name('delete-user');
});

#task 2
Route::post('/showserialpaso', 'Api\SerialpasoController@create')->name('get-serialpaso');

#task 3
Route::get('/comparefile', 'Api\CompareController@index')->name('get-file');