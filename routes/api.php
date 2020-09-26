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

// Api routes
Route::group(['namespace' => 'Api'], function () {

    Route::group(['middleware' => ['auth:api'], 'as' => 'api.'], function() {
        Route::get('news', 'ArticleController@index')->name('news');
        Route::get('news/categories', 'ArticleController@categories')->name('news.categories');
        Route::get('news/{alias}', 'ArticleController@show')->name('news.show');
        Route::get('news/category/{alias}', 'ArticleController@category')->name('news.category.show');

        Route::get('page/{alias}', 'PageController@show')->name('page.show');

        Route::get('handbook', 'HandbookController@index')->name('handbook');
        Route::get('handbook/home', 'HandbookController@home')->name('handbook.home');
        Route::get('handbook/{alias}', 'HandbookController@show')->name('handbook.show');

        Route::get('faq', 'FaqController@index')->name('faq');

        Route::get('notice/home', 'AdvertController@index')->name('adverts.home');
        Route::get('notice', 'AdvertController@paginate')->name('adverts');
        // Route::get('notice/{notice}', 'AdvertController@show')->name('advert.show');

        Route::get('polls', 'PollController@index')->name('polls');
        Route::get('poll', 'PollController@show')->name('polls.show');
        Route::post('polls/store', 'PollController@store')->name('polls.store');

        Route::get('user', 'UserController@show')->name('user.show');
        Route::post('avatar_store', 'UserController@avatarStore')->name('user.avatar.store');
        Route::post('user', 'UserController@store')->name('user.store');

        Route::get('area', 'AreaController@show')->name('area.show');

        Route::get('settings', 'SettingsController@index')->name('settings.index');
        Route::post('settings', 'SettingsController@store')->name('settings.store');

        Route::get('services', 'ServicesController@index')->name('services');
        Route::get('serviceRequests', 'ServicesController@serviceRequests')->name('services.requests');
        Route::post('serviceRequests', 'ServicesController@store')->name('services.requests.store');

        Route::post('abuse', 'AbuseController@store')->name('abuse.store');

        Route::post('meters_data', 'MetersDataController@store')->name('meters_data.store');
        Route::get('get_meters', 'MetersDataController@getMeters')->name('meters_data.get_meters');
        Route::get('get_meters_history', 'MetersDataController@getMetersHistory')->name('meters_data.get_meters_history');

        Route::get('get_payments', 'PaymentsController@index')->name('payments.get_payments');
        Route::get('get_balance', 'PaymentsController@getBalance')->name('payments.get_balance');
        Route::get('get_last_payments', 'PaymentsController@getLastPayments')->name('payments.get_last_payments');
        Route::get('get_month_payments', 'PaymentsController@getMonthPayments')->name('payments.get_month_payments');
    });
});
