<?php

/*
|-------------------------------------------------------
| Settings
|-------------------------------------------------------
*/
Route::group([
    'prefix'    => 'admin',
    'namespace' => 'Terranet\Administrator',
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
