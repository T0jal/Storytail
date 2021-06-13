<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('index');
});

Route::post('upload', [\App\Http\Controllers\FileUploadController::class, 'store']);

Route::prefix('admin')->group(function() {

    Route::get('/', 'HomeController@index')->name('home');

    //BOOKS
    Route::prefix('books')->group(function () {
        Route::get('', 'BookController@index')->name('books');
        Route::get('idAsc', 'BookController@indexByIdAsc')->name('booksByIdAsc');

        Route::get('titleAtoZ', 'BookController@indexByTitleAtoZ')->name('booksByTitleAtoZ');
        Route::get('titleZtoA', 'BookController@indexByTitleZtoA')->name('booksByTitleZtoA');

        Route::get('create', 'BookController@create')->name('addBook');
        Route::post('', 'BookController@store');
        Route::get('{book}', 'BookController@show');
        Route::get('{book}/edit', 'BookController@edit');
        Route::put('{book}', 'BookController@update');
        Route::delete('{book}', 'BookController@destroy');
    });

    //AUTHORS
    Route::prefix('authors')->group(function () {
        Route::get('', 'AuthorController@index')->name('authors');
        Route::get('idAsc', 'AuthorController@indexByIdAsc')->name('authorsByIdAsc');

        Route::get('nameAtoZ', 'AuthorController@indexByNameAtoZ')->name('authorsByNameAtoZ');
        Route::get('nameZtoA', 'AuthorController@indexByNameZtoA')->name('authorsByNameZtoA');

        Route::get('create', 'AuthorController@create')->name('addAuthor');
        Route::post('', 'AuthorController@store');
        Route::get('{author}', 'AuthorController@show');
        Route::get('{author}/edit', 'AuthorController@edit');
        Route::put('{author}', 'AuthorController@update');
        Route::delete('{author}', 'AuthorController@destroy');
    });

    //ACTIVITIES
    Route::prefix('activities')->group(function () {
        Route::get('', 'activityController@index')->name('activities');
        Route::get('idAsc', 'activityController@indexByIdAsc')->name('activitiesByIdAsc');

        Route::get('titleAtoZ', 'activityController@indexByTitleAtoZ')->name('activitiesByTitleAtoZ');
        Route::get('titleZtoA', 'activityController@indexByTitleZtoA')->name('activitiesByTitleZtoA');

        Route::get('create', 'activityController@create')->name('addActivity');
        Route::post('', 'activityController@store');
        Route::get('{activity}', 'activityController@show');
        Route::get('{activity}/edit', 'activityController@edit');
        Route::put('{activity}', 'activityController@update');
        Route::delete('{activity}', 'activityController@destroy');
    });

    //PLANS
    Route::prefix('plans')->group(function () {
        Route::get('', 'PlanController@index')->name('plans');
        Route::get('idAsc', 'PlanController@indexByIdAsc')->name('plansByIdAsc');

        Route::get('nameAtoZ', 'PlanController@indexByNameAtoZ')->name('plansByNameAtoZ');
        Route::get('nameZtoA', 'PlanController@indexByNameZtoA')->name('plansByNameZtoA');

        Route::get('create', 'PlanController@create')->name('addPlan');
        Route::post('', 'PlanController@store');
        Route::get('{plan}', 'PlanController@show');
        Route::get('{plan}/edit', 'PlanController@edit');
        Route::put('{plan}', 'PlanController@update');
        Route::delete('{plan}', 'PlanController@destroy');
    });
});


////ACTIVITY IMAGES
//Route::prefix('activityImages')->group(function () {
//
//    Route::get('', 'ActivityImageController@index');
//    Route::get('{activityImage}', 'ActivityImageController@show');
//    Route::get('create', 'ActivityImageController@create');
//    Route::post('', 'ActivityImageController@store');
//    Route::get('{activityImage}/edit', 'ActivityImageController@edit');
//    Route::put('{activityImage}', 'ActivityImageController@update');
//    Route::delete('{activityImage}', 'ActivityImageController@destroy');
//
//});

//
////PAGES
//Route::prefix('pages')->group(function () {
//
//    Route::get('', 'PageController@index');
//    Route::get('{page}', 'PageController@show');
//
//    // Auth Middleware
//    Route::group(['middleware' => 'auth'], function () {
//        Route::get('create', 'PageController@create');
//        Route::post('', 'PageController@store');
//        Route::get('{page}/edit', 'PageController@edit');
//        Route::put('{page}', 'PageController@update');
//        Route::delete('{page}', 'PageController@destroy');
//    });
//});
//
//
//
//
////SUBSCRIPTIONS
//Route::prefix('subscriptions')->group(function () {
//
//    Route::get('', 'SubscriptionController@index');
//    Route::get('{subscription}', 'SubscriptionController@show');
//
//    // Auth Middleware
//    Route::group(['middleware' => 'auth'], function () {
//        Route::get('create', 'SubscriptionController@create');
//        Route::post('', 'SubscriptionController@store');
//        Route::get('{subscription}/edit', 'SubscriptionController@edit');
//        Route::put('{subscription}', 'SubscriptionController@update');
//        Route::delete('{subscription}', 'SubscriptionController@destroy');
//    });
//});
//
//
////VIDEO
//Route::prefix('videos')->group(function () {
//
//    Route::get('', 'VideoController@index');
//    Route::get('{video}', 'VideoController@show');
//
//    // Auth Middleware
//    Route::group(['middleware' => 'auth'], function () {
//        Route::get('create', 'VideoController@create');
//        Route::post('', 'VideoController@store');
//        Route::get('{video}/edit', 'VideoController@edit');
//        Route::put('{video}', 'VideoController@update');
//        Route::delete('{video}', 'VideoController@destroy');
//    });
//});
