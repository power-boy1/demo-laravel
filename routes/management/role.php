<?php

Route::prefix('roles')->middleware('checkPolicy:admin')->group(function () {
    Route::get('/', [
        'as' => 'get.manage.role.show',
        'uses' => 'RoleController@index'
    ]);

    Route::get('/create', [
        'as' => 'get.manage.role.create',
        'uses' => 'RoleController@create'
    ]);

    Route::post('/create', [
        'as' => 'post.manage.role.create',
        'uses' => 'RoleController@createRole'
    ]);

    Route::get('/edit/{id}', [
        'as' => 'get.manage.role.edit',
        'uses' => 'RoleController@edit'
    ]);

    Route::post('/update', [
        'as' => 'post.manage.role.update',
        'uses' => 'RoleController@updateRole'
    ]);

    Route::get('/details/{id}', [
        'as' => 'get.manage.role.details',
        'uses' => 'RoleController@details'
    ]);

    Route::post('/delete', [
        'as' => 'post.manage.role.delete',
        'uses' => 'RoleController@deleteRole'
    ]);
});
