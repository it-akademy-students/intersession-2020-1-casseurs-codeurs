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

Route::post('create-checkout-session', 'StripeController@checkout');

Route::get('github/{username}/{repos}/{email}/{migration}/{branch?}', 'ApiController@github');

Route::post('contact', 'ContactController@contact');

// authentication
Route::prefix('auth')->group(function () {
    // Below mention routes are public, user can access those without any restriction.
    // Create New User
    Route::post('register', 'AuthController@register');
    // Login User
    Route::post('login', 'AuthController@login');
    // Send reset password mail
    Route::post('reset-password/', 'AuthController@sendPasswordResetLink');
    // handle reset password form process
    Route::post('reset/password', 'AuthController@callResetPassword');
    
    // Below mention routes are available only for the authenticated users.
    Route::middleware('auth:api')->group(function () {
        // Get user info
        Route::get('user', 'AuthController@user');

        // Route::post('user/{id}/analyzes', 'StatisticsController@totalPerUser');
        // Route::post('user/{id}/repository', 'StatisticsController@repositoryPerUser');

        // Refresh the JWT Token
        Route::get('refresh', 'AuthController@refresh');
        // Logout user from application
        Route::post('logout', 'AuthController@logout');
        // update user datas
        Route::post('user/{id}', 'AuthController@update');
        // delete user
        Route::delete('user/{id}', 'AuthController@destroy');
    
    });
});

Route::get('users/{id}/analyzes', 'StatisticsController@totalPerUser');

Route::get('users/{id}/repository', 'StatisticsController@repositoryPerUser');

Route::get('statistics', 'StatisticsController@generalStatistics');