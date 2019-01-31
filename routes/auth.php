<?php

Route::get('/login', [
    'as' => 'get.auth.login',
    'uses' => 'LoginController@loginPage'
]);

Route::post('/login', [
    'as' => 'post.auth.login',
    'uses' => 'LoginController@login'
]);

Route::get('/register', [
    'as' => 'get.auth.register',
    'uses' => 'RegisterController@registerPage'
]);

Route::post('/register', [
    'as' => 'post.auth.register',
    'uses' => 'RegisterController@register'
]);

Route::post('/logout', [
    'as' => 'post.auth.logout',
    'uses' => 'LoginController@logout'
]);

Route::get('/account-verify/{token}', [
    'as' => 'get.auth.accountVerify',
    'uses' => 'RegisterController@accountVerify'
]);

Route::get('/reset-password', [
    'as' => 'get.auth.resetPassword',
    'uses' => 'PasswordController@resetPage'
]);

Route::post('/reset-password', [
    'as' => 'post.auth.resetPassword',
    'uses' => 'PasswordController@reset'
]);

Route::get('/change-password/{token}', [
    'as' => 'get.auth.changePassword',
    'uses' => 'PasswordController@changePage'
]);

Route::post('/change-password', [
    'as' => 'post.auth.changePassword',
    'uses' => 'PasswordController@change'
]);
