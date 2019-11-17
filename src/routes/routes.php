<?php
/**
 * @author: tuanha
 * @last-mod: 17-Nov-2019
 */
Route::group(
    [
        'prefix' => 'cms',
        'namespace' => 'Bkstar123\BksCMS\Dashboard\Http\Controllers',
        'middleware' => [
            'web', 'bkscms-auth:admins'
        ],
    ],
    function () {
        Route::get('/dashboard', 'DashboardController@index')
            ->name('dashboard.index');
        Route::get('/json/dashboard/sysinfo', 'DashboardController@sysinfo')
            ->name('json.dashboard.sysinfo');
    }
);
