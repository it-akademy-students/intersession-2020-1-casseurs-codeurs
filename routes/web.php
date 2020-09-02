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

Route::get('github/{username}/{repos}/{email}/{migration}/{branch?}', 'ApiController@github');
// Route to handle page reload in Vue except for api routes
Route::get('/{any?}', function (){
    return view('app');
})->where('any', '^(?!api\/)[\/\w\.-]*');
// Route::get('/{any}', 'SinglePageController@index')->where('any', '.*');
//Route::get('github/{username}/{repos}', 'ApiController@github');
