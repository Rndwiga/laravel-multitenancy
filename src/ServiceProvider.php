<?php
namespace Ollieslab\Multitenancy;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

/**
 * Version Service Provider
 *
 * @package Ollieslab\Version
 */
class ServiceProvider extends BaseServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/multitenancy.php' => config_path('multitenancy.php')
        ], 'config');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('multitenancy', function ($app) {
            $app['multitenancy.loaded'] = true;

            return new Manager($app);
        });

        $this->app->singleton('multitenancy.driver', function ($app) {
            return $app['multitenancy']->driver();
        });
    }
}