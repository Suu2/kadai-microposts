<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
/* defaultを削除
Route::get('/', function () {
    return view('welcome');
});
*/

// TOPページにアクセスされた時のルーティングを変更
Route::get('/', 'WelcomeController@index');


// ユーザ登録
Route::get('signup', 'Auth\AuthController@getRegister')->name('signup.get');
Route::post('signup', 'Auth\AuthController@postRegister')->name('signup.post');

// ログイン
Route::get('login', 'Auth\AuthController@getLogin')->name('login.get');
Route::post('login', 'Auth\AuthController@postLogin')->name('login.post');
Route::get('logout', 'Auth\AuthController@getLogout')->name('logout.get');

// ログイン認証付き
Route::group(['middleware' => 'auth'], function () {
    Route::resource('users', 'UsersController', ['only' => ['index', 'show']]);
    Route::group(['prefix' => 'users/{id}'], function () {
        Route::post('follow', 'UserFollowController@store')->name('user.follow');
        Route::delete('unfollow', 'UserFollowController@destroy')->name('user.unfollow');
        Route::get('followings', 'UsersController@followings')->name('users.followings');
        Route::get('followers', 'UsersController@followers')->name('users.followers');
        
        Route::post('add_favorite', 'UserFavoriteController@store')->name('user.add_favorite');
        Route::delete('delete_favorite', 'UserFavoriteController@destroy')->name('user.delete_favorite');
        Route::get('users_favorites', 'UsersController@users_favorites')->name('users.users_favorites');        
        
    });

    Route::resource('microposts', 'MicropostsController', ['only' => ['index', 'store', 'destroy']]);
    // ルーティンググループを作り、prefix microposts/{id}の設定がいるのか
    // Route::getでmicroposts_favoritesの設定が・・・必要なのか？　5/10（木）18:40時点で保留
});
