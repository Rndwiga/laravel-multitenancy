<?php
namespace Ollieslab\Multitenancy\Driver;

use Illuminate\Support\Facades\Route;
use Ollieslab\Multitenancy\Middleware\LoadTenant;

/**
 * Class Subdomain
 *
 * @package Ollieslab\Multitenancy\Driver
 */
class Subdomain extends BaseDriver
{

    /**
     * Provides a route group for the current driver.
     *
     * @param \Closure $routes
     *
     * @return \Illuminate\Routing\Route
     */
    public function routes(\Closure $routes)
    {
        return Route::group(
            [
                'domain'        => '{_multitenant_}.' . config('multitenancy.domain'),
                'middleware'    => LoadTenant::class
            ],
            $routes);
    }
}