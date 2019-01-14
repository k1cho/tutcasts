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
Route::get('/redisss', function() {
    //Redis::sadd('frontend-frameworks', ['angular', 'ember']);
    dd(Redis::smembers('frontend-frameworks'));
});

Route::get('/', function () {
    return view('welcome');
    //return new App\Mail\ConfirmYourEmail();
});

//Route::post('/series/{series}/lesson/{lesson}/complete-lesson', 'WatchSeriesController@completeLesson')->name('lesson.complete');
Route::get('/profile/{user}', 'ProfileController@index')->name('profile');

Route::get('/home', 'FrontendController@index')->name('home');
Route::get('/series/{series}', 'FrontendController@series')->name('series');

Route::get('/subscribe', function() {
    return view('subscribe');
});

Route::post('/subscribe', 'SubscriptionsController@store');
Route::post('/subscribe/update', 'SubscriptionsController@update')->name('subscriptions.change');

Route::middleware(['auth'])->group(function () {
    Route::get('watch-series/{series}', 'WatchSeriesController@index')->name('series.learning');
    Route::get('/series/{series}/lesson/{lesson}', 'WatchSeriesController@show')->name('series.watch');
    Route::post('/series/complete-lesson/{lesson}', 'WatchSeriesController@completeLesson')->name('lesson.complete');
});

Auth::routes();

Route::get('register/confirm', 'ConfirmEmailController@index')->name('confirm-email');