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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('/kos', 'KosController@store');
    Route::get('/kos/{id}', 'KosController@detail');
    Route::put('/kos/{id}', 'KosController@update');
    Route::delete('/kos/{id}', 'KosController@delete');
    Route::get('logout', 'UserController@logout');
});
Route::get('/kosAll', 'KosController@index');
Route::get('carikos', 'KosController@search');
