<?php
/**
 * @author Jonathon Wallen
 * @date 24/4/17
 * @time 10:57 AM
 * @copyright 2008 - present, Monkii Digital Agency (http://monkii.com.au)
 */

Route::group(['prefix' => 'admin', 'namespace' => 'MonkiiBuilt\LaravelUserAccounts', 'middleware' => ['laravel-administrator-menus', 'web']], function() {

    Route::get('users', ['as' => 'laravel-administrator-user-accounts', 'uses' => 'Controllers\UserAccountsController@index']);

    Route::get('users/create', ['as' => 'laravel-administrator-user-accounts-create', 'uses' => 'Controllers\UserAccountsController@create']);

    Route::get('users/{id}/edit', ['as' => 'laravel-administrator-user-accounts-edit', 'uses' => 'Controllers\UserAccountsController@edit']);

    Route::get('users/data', ['as' => 'laravel-administrator-user-accounts-data', 'uses' => 'Controllers\UserAccountsController@data']);

    Route::post('users', ['as' => 'laravel-administrator-user-accounts-post', 'uses' => 'Controllers\UserAccountsController@store']);

    Route::put('users/{id}', ['as' => 'laravel-administrator-user-accounts-put', 'uses' => 'Controllers\UserAccountsController@update']);

    Route::delete('users/{id}', ['as' => 'laravel-administrator-user-accounts-destroy', 'uses' => 'Controllers\UserAccountsController@destroy']);

    Route::get('permissions', ['as' => 'laravel-administrator-permissions', 'uses' => 'Controllers\PermissionsController@index']);

    Route::post('permissions', ['as' => 'laravel-administrator-permissions-post', 'uses' => 'Controllers\PermissionsController@store']);
});
