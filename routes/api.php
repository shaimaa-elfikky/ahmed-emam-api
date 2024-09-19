<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

  //all routes must be authenticated


    Route::group(['middleware'=> ['api', 'checkpassword', 'checklanguage']], function(){

            Route::post('get_main_categories', 'CategoryController@index');

            Route::post('get_category_by_id', 'CategoryController@getCategoryById');

            Route::group(['prefix' => 'admin' ,'namespace'=> 'Admin'],function(){

            Route::post('login', 'AuthController@login');

            Route::post('logout', 'AuthController@logout')->middleware('auth.guard:admin-api');

            });

            Route::group(['prefix' =>'user', 'namespace' => 'User'], function () {
            Route::post('login', 'AuthController@login');
            });


            Route::group(['prefix'=>'user' , 'middleware'=> 'auth.guard:user-api'] ,function()
            {
                Route::post('profile' ,function(){
                    return  Auth::user();
                });
            });


    });

    Route::group(
        ['middleware' => ['api', 'checkpassword', 'checklanguage', 'checkAdminToken:admin-api']],
        function () {
        Route::post('offers', 'CategoryController@getCategoryById');
        }
    );
