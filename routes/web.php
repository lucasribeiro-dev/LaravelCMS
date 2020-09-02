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

Route::get('/', 'Site\HomeController@index'); //Home Site

Route::prefix('panel')->group(function(){
    Route::get('/', 'Admin\HomeController@index')->name('admin');//Home Panel Admin

    Route::get('login', 'Admin\Auth\LoginController@index')->name('login'); //Login Admin Page
    Route::post('login', 'Admin\Auth\LoginController@authenticate');//Make Login

    Route::get('register', 'Admin\Auth\RegisterController@index')->name('register');//Register Admin Page
    Route::post('register', 'Admin\Auth\RegisterController@register'); //Make Register

    Route::post('logout', 'Admin\Auth\LoginController@logout')->name('logout'); //Make logout

    Route::resource('users', 'Admin\UserController'); //CRUD

    Route::get('profile','Admin\ProfileController@index')->name('profile'); // Show info about profile 
    Route::put('profileupdate','Admin\ProfileController@update')->name('profile.update'); // Update profile

    Route::get('settings','Admin\SettingController@index')->name('settings'); // Show info about settings 
    Route::put('settingsupdate','Admin\SettingController@update')->name('settings.update'); // Update settings

    Route::resource('pages', 'Admin\PageController'); //CRUD
});

Route::fallback('Site\PageController@index');