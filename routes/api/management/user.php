<?php

Route::prefix('user')->middleware('checkPolicy:admin')->group(function () {
    Route::get('/list', [
        'as' => 'get.manage.user.list',
        'uses' => 'UserController@list'
    ]);

    Route::delete('/{id}', [
        'as' => 'delete.manage.user.delete',
        'uses' => 'UserController@deleteUser'
    ]);
});
