<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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



Route::post('login', 'Api\AuthController@login');
Route::post('signup', 'Api\UserController@store');
Route::post('logout', 'Api\AuthController@logout');

Route::prefix('/user')->group(function(){
    //Route::get('users', 'Api\UserrController@index');
    //Route::middleware('apiJwt')->get('/', 'Api\UserrController@index');
    Route::middleware('apiJwt')->get('/current', 'Api\UserrController@currentUser');
    Route::middleware('apiJwt')->get('/activity/', 'Api\UserrController@getActivitiesFromUser');
    Route::middleware('apiJwt')->get('/activity/{id}', 'Api\UserrController@saveOrDeleteActivity');
    Route::middleware('apiJwt')->get('/bookRead/{id}', 'Api\UserrController@bookUserRead');
    Route::middleware('apiJwt')->post('/bookRead/', 'Api\UserrController@saveUserRead');
    Route::middleware('apiJwt')->get('/bookFavourite/{id}', 'Api\UserrController@bookUserFavourite');
    Route::middleware('apiJwt')->get('/getFavourites/', 'Api\UserrController@getBookUserFavourites');
    Route::middleware('apiJwt')->post('/saveFavourite/', 'Api\UserrController@saveBookUserFavourite');
    Route::middleware('apiJwt')->delete('/deleteFavourite/{id}', 'Api\UserrController@deleteBookUserFavourite');
    Route::middleware('apiJwt')->get('/calcProgressBooks', 'Api\UserrController@calcProgressBooks');

    Route::middleware('apiJwt')->post('/update/{id}', 'Api\UserController@update');
    
    Route::middleware('apiJwt')->post('/message', 'Api\UserrController@message');
  //Route::get('/bookFavourite/{id}', 'Api\UserrController@bookUserFavourite');
    //Route::middleware('apiJwt')->get('/activities', 'Api\ActivityBookController@index');
});


//Rota personalizada para API
Route::prefix('books')->group(function () {
    //Não mexer nesta rota sff
    Route::get('sort', 'Api\BookController@sorting');
    Route::get('search', 'Api\BookController@search');
    Route::get('', 'Api\BookController@index');
    Route::get('{book}', 'Api\BookController@show');
});
Route::apiResource('activityBooks', 'Api\ActivityBookController');
 Route::apiResource('activities', 'Api\ActivityController');
// Route::apiResource('activityImages', 'ActivityImageController');
 Route::apiResource('authors', 'Api\AuthorController');
//Route::apiResource('books', 'BookController');
// Route::apiResource('pages', 'PageController');
// Route::apiResource('plans', 'PlanController');
// Route::apiResource('subscriptions', 'SubscriptionController');
// Route::apiResource('users', 'UserController');
// Route::apiResource('userTypes', 'UserTypeController');
// Route::apiResource('subscriptions', 'SubscriptionController');
// Route::apiResource('videos', 'VideoController');
