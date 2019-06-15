<?php

// User Auth
Auth::routes();
Route::post('password/change', 'UserController@changePassword')->middleware('auth');

// Github Auth Route
Route::group(['prefix' => 'auth/github'], function () {
    Route::get('/', 'Auth\AuthController@redirectToProvider');
    Route::get('callback', 'Auth\AuthController@handleProviderCallback');
    Route::get('register', 'Auth\AuthController@create');
    Route::post('register', 'Auth\AuthController@store');
});

// Search
Route::get('search', 'HomeController@search');

// Discussion
Route::resource('discussion', 'DiscussionController', ['except' => 'destroy']);

// User
Route::group(['prefix' => 'user'], function () {
    Route::get('/', 'UserController@index');

    Route::group(['middleware' => 'auth'], function () {
        Route::get('profile', 'UserController@edit');
        Route::put('profile/{id}', 'UserController@update');
        Route::post('follow/{id}', 'UserController@doFollow');
        Route::get('notification', 'UserController@notifications');
        Route::post('notification', 'UserController@markAsRead');
    });

    Route::group(['prefix' => '{username}'], function () {
        Route::get('/', 'UserController@show');
        Route::get('comments', 'UserController@comments');
        Route::get('following', 'UserController@following');
        Route::get('discussions', 'UserController@discussions');
    });
});

// User Setting
Route::group(['middleware' => 'auth', 'prefix' => 'setting'], function () {
    Route::get('/', 'SettingController@index')->name('setting.index');
    Route::get('binding', 'SettingController@binding')->name('setting.binding');

    Route::get('notification', 'SettingController@notification')->name('setting.notification');
    Route::post('notification', 'SettingController@setNotification');
});

// Link
Route::get('link', 'LinkController@index');

// Category
Route::group(['prefix' => 'category'], function () {
    Route::get('{category}', 'CategoryController@show');
    Route::get('/', 'CategoryController@index');
});

// Tag
Route::group(['prefix' => 'tag'], function () {
    Route::get('/', 'TagController@index');
    Route::get('{tag}', 'TagController@show');
});

/* Dashboard Index */
Route::group(['prefix' => 'dashboard', 'middleware' => ['auth', 'admin']], function () {
   Route::get('{path?}', 'HomeController@dashboard')->where('path', '[\/\w\.-]*');
});

// Article
Route::get('/article', 'ArticleController@index');
//Route::get('/', function (){
//    return View::make('index');
//});
// Route::get('{slug}', 'ArticleController@show');



Route::get('/task', 'TasksController@index');
Route::get('tasks/create', 'TasksController@create');
// error_log(implode(' | ',array(__CLASS__,__FUNCTION__,__LINE__,'gtest--1234')));
Route::post('/tasks/store', 'TasksController@store');
// Route::get('/tasks/store',function(){
//     error_log(implode(' | ',array(__CLASS__,__FUNCTION__,__LINE__,'gtest--1234')));
//     // error_log(implode(' | ',array(__CLASS__,__FUNCTION__,__LINE__,'gtest--1234',json_encode($_REQUEST))));
// });

Route::get('/user', 'UserController@index');

Route::get('/', 'TasksController@index');
Route::get('/detail', 'TasksController@detail');
Route::get('/buser', 'BuserController@index');
Route::get('/wish', 'WishController@index');
Route::get('/wish/agree/{id}', 'WishController@agree');
Route::get('/wdetail', 'WishController@detail');
Route::get('/publish', function (){
    return View::make('buxian.publish');
});
Route::get('/edit', function (){
    return View::make('buxian.editinfo');
});
