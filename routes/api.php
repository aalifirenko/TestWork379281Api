<?php

use Illuminate\Support\Facades\Route;
use App\Http\Resources\User\UserResource;

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

Route::group(['middleware' => ['guest:api'], 'namespace' => 'Api', 'as' => 'api.'], function() {

    # Auth
    Route::group(['namespace' => 'Auth', 'as' => 'auth.'], function() {
        #Login
        Route::post('auth/login', ['as' => 'auth.login', 'uses' => 'LoginController']);

        #Register
        Route::post('auth/register', ['as' => 'auth.register', 'uses' => 'RegisterController']);
    });

    # Authorized
    Route::group(['middleware' => ['api.auth']], function() {
        # User
        Route::group(['namespace' => 'User', 'as' => 'user.'], function() {
            Route::get('user/profile', ['as' => 'user.profile', 'uses' => 'ProfileController']);
            Route::post('user/profile/save', ['as' => 'user.profile.save', 'uses' => 'SaveProfileController']);
            Route::post('user/profile/avatar', ['as' => 'user.profile.avatar', 'uses' => 'SaveAvatarController']);
        });
    });
});
