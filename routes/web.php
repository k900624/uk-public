<?php

/*php
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Front routes

Auth::routes(['register' => false]);

Route::namespace('Auth')->group(function () {
    Route::get('/', 'LoginController@login')->name('home');
    Route::get('logout', 'LoginController@logout');
});

// Admin routes

Route::group(['prefix' => 'admin'], function () {
    Route::get('login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {

    Route::group(['middleware' => ['auth:admin', 'permission']], function () {

        Route::get('/', 'HomeController@index')->name('admin.dashboard.index');

        Route::resource('menu', 'MenuController', ['except' => ['show', 'destroy']])->names('admin.menu');
        Route::get('menu/{id}/activate', 'MenuController@activate')->name('admin.menu.activate');
        Route::get('menu/{id}/deactivate', 'MenuController@deactivate')->name('admin.menu.deactivate');
        Route::get('menu/{id}/delete', 'MenuController@delete')->name('admin.menu.delete');

        Route::resource('menu/group', 'MenuGroupController', ['except' => ['show', 'destroy']])->names('admin.menu_group');
        Route::get('menu/group/{id}/delete', 'MenuGroupController@delete')->name('admin.menu_group.delete');

        Route::resource('pages', 'PageController', ['except' => ['show', 'destroy']])->names('admin.pages');
        Route::get('pages/{id}/activate', 'PageController@activate')->name('admin.pages.activate');
        Route::get('pages/{id}/deactivate', 'PageController@deactivate')->name('admin.pages.deactivate');
        Route::get('pages/{id}/delete', 'PageController@delete')->name('admin.pages.delete');

        Route::get('feedback', 'FeedbackController@index')->name('admin.feedback.index');
        Route::get('feedback/create', 'FeedbackController@create')->name('admin.feedback.create');
        Route::post('feedback/store', 'FeedbackController@store')->name('admin.feedback.store');
        Route::get('feedback/{id}/ajax_show', 'FeedbackController@show')->name('admin.feedback.show');
        Route::get('feedback/{id}/delete', 'FeedbackController@delete')->name('admin.feedback.delete');
        Route::get('feedback/{id}/spam', 'FeedbackController@spam')->name('admin.feedback.spam');
        Route::get('feedback/{id}/forceDelete', 'FeedbackController@forceDelete')->name('admin.feedback.forceDelete');
        Route::get('feedback/{id}/restore', 'FeedbackController@restore')->name('admin.feedback.restore');
        Route::get('feedback/ajaxSendEmail', 'FeedbackController@ajaxSendEmail')->name('admin.feedback.ajax_send_email');

        Route::resource('faq', 'FaqController', ['except' => ['show', 'destroy']])->names('admin.faq');
        Route::get('faq/{id}/activate', 'FaqController@activate')->name('admin.faq.activate');
        Route::get('faq/{id}/deactivate', 'FaqController@deactivate')->name('admin.faq.deactivate');
        Route::get('faq/{id}/delete', 'FaqController@delete')->name('admin.faq.delete');

        Route::resource('faq/category', 'FaqCategoryController', ['except' => ['show', 'destroy']])->names('admin.faq.category');
        Route::get('faq/category/{id}/delete', 'FaqCategoryController@delete')->name('admin.faq.category.delete');

        Route::get('abuses', 'AbuseController@index')->name('admin.abuses.index');
        Route::get('abuses/{id}/ajax_show', 'AbuseController@show')->name('admin.abuses.show');
        Route::get('abuses/{id}/delete', 'AbuseController@delete')->name('admin.abuses.delete');

        Route::resource('polls', 'PollController', ['except' => ['show', 'destroy']])->names('admin.polls');
        Route::get('polls/{id}/activate', 'PollController@activate')->name('admin.polls.activate');
        Route::get('polls/{id}/deactivate', 'PollController@deactivate')->name('admin.polls.deactivate');
        Route::get('polls/{id}/delete', 'PollController@delete')->name('admin.polls.delete');
        Route::get('polls/{id}/statistic', 'PollController@statistic')->name('admin.polls.statistic');

        // Ajax routes
        Route::group(['prefix' => 'ajax'], function () {
            Route::post('ordering_edit', 'AjaxController@orderingEdit')->name('ajax.orderingEdit');
            Route::post('translite_title', 'AjaxController@transliteTitle')->name('ajax.transliteTitle');
            Route::post('check_unique_alias', 'AjaxController@checkUniqueAlias')->name('ajax.checkUniqueAlias');

            Route::post('ajax_save_notes', 'HomeController@ajaxSaveNotes');
            Route::post('ajax_todo', 'HomeController@ajaxTodo');
        });

        // Articles routes
        Route::namespace('Articles')->group(function () {
            Route::resource('categories', 'CategoryController', ['except' => ['show', 'destroy']])->names('admin.categories');
            Route::get('categories/{id}/activate', 'CategoryController@activate')->name('admin.categories.activate');
            Route::get('categories/{id}/deactivate', 'CategoryController@deactivate')->name('admin.categories.deactivate');
            Route::get('categories/{id}/delete', 'CategoryController@delete')->name('admin.categories.delete');

            Route::resource('articles', 'ArticleController', ['except' => ['show', 'destroy']])->names('admin.articles');
            Route::get('articles/{id}/activate', 'ArticleController@activate')->name('admin.articles.activate');
            Route::get('articles/{id}/deactivate', 'ArticleController@deactivate')->name('admin.articles.deactivate');
            Route::get('articles/{id}/delete', 'ArticleController@delete')->name('admin.articles.delete');

            Route::resource('adverts', 'AdvertController', ['except' => ['show', 'destroy']])->names('admin.adverts');
            Route::get('adverts/{id}/activate', 'AdvertController@activate')->name('admin.adverts.activate');
            Route::get('adverts/{id}/deactivate', 'AdvertController@deactivate')->name('admin.adverts.deactivate');
            Route::get('adverts/{id}/delete', 'AdvertController@delete')->name('admin.adverts.delete');

            Route::resource('handbook', 'HandbookController', ['except' => ['show', 'destroy']])->names('admin.handbook');
            Route::get('handbook/{id}/activate', 'HandbookController@activate')->name('admin.handbook.activate');
            Route::get('handbook/{id}/deactivate', 'HandbookController@deactivate')->name('admin.handbook.deactivate');
            Route::get('handbook/{id}/delete', 'HandbookController@delete')->name('admin.handbook.delete');

            Route::get('comments', 'CommentController@index')->name('admin.comments.index');
            Route::get('comments/{id}/ajax_show', 'CommentController@show')->name('admin.comments.show');
            Route::patch('comments/{id}/update', 'CommentController@update')->name('admin.comments.update');
            Route::get('comments/{id}/activate', 'CommentController@activate')->name('admin.comments.activate');
            Route::get('comments/{id}/deactivate', 'CommentController@deactivate')->name('admin.comments.deactivate');
            Route::get('comments/{id}/delete', 'CommentController@delete')->name('admin.comments.delete');
            Route::get('comments/{id}/forceDelete', 'CommentController@forceDelete')->name('admin.comments.forceDelete');
            Route::get('comments/{id}/restore', 'CommentController@restore')->name('admin.comments.restore');
        });

        // Users routes
        Route::namespace('Users')->group(function () {
            Route::resource('areas', 'AreaController', ['except' => ['destroy']])->names('admin.areas');
            Route::get('areas/{id}/delete', 'AreaController@delete')->name('admin.areas.delete');
            Route::get('areas/{id}/all', 'UserController@allUsersArea')->name('admin.areas.all');
            Route::get('areas/{id}/invoice', 'AreaController@invoice')->name('admin.areas.invoice');
            Route::get('areas/{id}/meters_data/edit', 'AreaController@metersDataEdit')->name('admin.areas.meters_data.edit');
            Route::get('areas/{id}/ajax_set_meters', 'AreaController@ajaxSetMeters')->name('admin.areas.ajax_set_meters');
            Route::post('areas/{id}/set_meters/store', 'AreaController@setMetersStore')->name('admin.areas.set_meters.store');

            Route::resource('users/roles', 'RoleController', ['except' => ['show', 'destroy']])->names('admin.users.roles');
            Route::get('users/roles/{id}/delete', 'RoleController@delete')->name('admin.users.roles.delete');

            Route::get('users/{id}/addBlackList', 'UserController@addBlackList')->name('admin.users.blacklist.add');
            Route::get('users/{id}/removeBlackList', 'UserController@removeBlackList')->name('admin.users.blacklist.remove');

            Route::resource('users', 'UserController', ['except' => ['destroy']])->names('admin.users');
            Route::get('users/{id}/activate', 'UserController@activate')->name('admin.users.activate');
            Route::get('users/{id}/deactivate', 'UserController@deactivate')->name('admin.users.deactivate');
            Route::get('users/{id}/delete', 'UserController@delete')->name('admin.users.delete');
            Route::get('users/{id}/forceDelete', 'UserController@forceDelete')->name('admin.users.forceDelete');
            Route::get('users/{id}/restore', 'UserController@restore')->name('admin.users.restore');
            Route::get('users/{id}/invite', 'UserController@invite')->name('admin.users.invite');
            Route::get('users/{id}/account', 'AccountController@edit')->name('admin.users.account.edit');
            // Route::patch('users/{id}/account/update', 'AccountController@update')->name('admin.users.account.update');

            // Route::get('users/{id}/meters_data/edit', 'MetersDataController@edit')->name('admin.users.meters_data.edit');
        });

        Route::get('registry', 'RegistryController@index')->name('admin.registry.index');
        Route::post('registry/update', 'RegistryController@store')->name('admin.registry.store');
        Route::get('registry/getForm', 'RegistryController@getForm')->name('admin.registry.ajax_tariff_form');

        Route::get('notify', 'NotifyController@getForm')->name('admin.areas.notify');
        Route::post('notify/{id}/toOne', 'NotifyController@toOne')->name('admin.areas.notify.toOne');
        Route::post('notify/toAll', 'NotifyController@toAll')->name('admin.areas.notify.toAll');

        // Services routes
        Route::namespace('Services')->group(function () {
            Route::resource('services', 'ServiceController', ['except' => ['destroy']])->names('admin.services');
            Route::get('services/group/add', 'ServiceGroupController@create')->name('admin.services.groups.create');
            Route::get('services/group/{id}/edit', 'ServiceGroupController@edit')->name('admin.services.groups.edit');
        });

        // Route::get('/sms/send/{to}', function(\Nexmo\Client $nexmo, $to){
        //     $message = $nexmo->message()->send([
        //         'to' => $to,
        //         'from' => env('NEXMO_NUMBER'),
        //         'text' => 'Sending SMS from Laravel. Woohoo!'
        //     ]);
        //     Log::info('sent message: ' . $message['message-id']);
        // });

        // System routes
        Route::namespace('System')->group(function () {
            Route::get('feed', 'FeedController@index')->name('admin.feed.index');
            Route::get('feed/clear', 'FeedController@deleteAll')->name('admin.feed.deleteAll');

            Route::get('settings', 'SettingController@index')->name('admin.settings.index');
            Route::post('settings/update', 'SettingController@update')->name('admin.settings.update');

            Route::match(['get', 'post'], 'commands', 'CommandController@index')->name('admin.commands.index');

            Route::get('logs', 'LogController@index')->name('admin.logs.index');
        });

        // Statistic routes
        Route::namespace('Statistic')->group(function () {
            Route::get('statistic', 'StatisticController@index')->name('admin.statistic.index');
            Route::get('statistic/{id}/ajax_show', 'StatisticController@ajax_show')->name('admin.statistic.show');
            Route::get('statistic/{id}/delete', 'StatisticController@delete')->name('admin.statistic.delete');
        });

        Route::namespace('Dev')->group(function () {
            Route::get('design', 'DesignController@index')->name('admin.design.index');
        });

        // Route Admin download from files
        Route::get('download/files/{filename}', function ($filename) {
            if (Storage::disk('public')->exists('files/'. $filename)) {
                return Storage::disk('public')->download('files/'. $filename);
            } else {
                exit('Requested file does not exist on server');
            }
        })->name('admin.download');

    });

});


// Front routes

Route::group(['namespace' => 'Front'], function () {
	
	// Нужно для админки!!!
    Route::group(['prefix' => 'ajax'], function () {
        Route::get('loadMsg', 'AjaxController@loadMsg')->name('ajax.loadMsg');
    });

    Route::group(['middleware' => 'auth'], function () {

        // Users routes
        Route::group(['prefix' => 'profile'], function () {
            Route::get('/', 'MainController@index')->name('profile');
        });

        Route::get('/{any?}', 'MainController@index')->where('any', '^(?!api\/)[\/\w\.-]*');
    });

});

Route::get('badBrowser', function () {
    return view('pages/bad_browser');
})->name('badBrowser');

