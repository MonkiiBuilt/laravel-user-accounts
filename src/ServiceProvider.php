<?php
/**
 * @author Jonathon Wallen
 * @date 24/4/17
 * @time 10:35 AM
 * @copyright 2008 - present, Monkii Digital Agency (http://monkii.com.au)
 */

namespace MonkiiBuilt\LaravelUserAccounts;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    public function boot(\MonkiiBuilt\LaravelAdministrator\PackageRegistry $packageRegistry)
    {
        $packageRegistry->registerConfig(config_path() . '/laravel-administrator/laravel-administrator-user-accounts.php');

        $this->loadRoutesFrom(__DIR__.'/routes.php');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'user-accounts');

        $this->publishes([
            __DIR__. '/../config/laravel-administrator-user-accounts.php' => config_path('/laravel-administrator/laravel-administrator-user-accounts.php')
        ], 'administrator-user-accounts-config');
    }
}