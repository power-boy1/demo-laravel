<?php

Route::prefix('users')->middleware('checkPolicy:admin')->group(function () {
    Route::get('/', [
        'as' => 'get.manage.user.show',
        'uses' => 'UserController@index'
    ]);

    Route::get('/create', [
        'as' => 'get.manage.user.create',
        'uses' => 'UserController@create'
    ]);

    Route::post('/create', [
        'as' => 'post.manage.user.create',
        'uses' => 'UserController@createUser'
    ]);

    Route::get('/edit/{id}', [
        'as' => 'get.manage.user.edit',
        'uses' => 'UserController@edit'
    ]);

    Route::post('/update', [
        'as' => 'post.manage.user.update',
        'uses' => 'UserController@updateUser'
    ]);

    Route::get('/details/{id}', [
        'as' => 'get.manage.user.details',
        'uses' => 'UserController@details'
    ]);

    Route::post('/delete', [
        'as' => 'post.manage.user.delete',
        'uses' => 'UserController@deleteUser'
    ]);
});
