<?php

Route::prefix('role')->middleware('checkPolicy:admin')->group(function () {
    Route::get('/list', [
        'as' => 'get.manage.role.list',
        'uses' => 'RoleController@list'
    ]);

    Route::delete('/{id}', [
        'as' => 'delete.manage.role.delete',
        'uses' => 'RoleController@deleteRole'
    ]);
});
