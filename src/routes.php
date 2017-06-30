<?php

/*
|-------------------------------------------------------
| Settings
|-------------------------------------------------------
*/
Route::group([
    'prefix'    => config('administrator.prefix', 'admin'),
    'namespace' => 'Terranet\Administrator\Controllers',
    'middleware'=> ['web'],
], function () {
    Route::group([], function () {
        Route::get('settings', [
            'as'    => 'scaffold.settings.edit',
            'uses'  => 'SettingsController@edit',
        ]);

        Route::post('settings', [
            'as'    => 'scaffold.settings.update',
            'uses'  => 'SettingsController@update',
        ]);
    });
});
