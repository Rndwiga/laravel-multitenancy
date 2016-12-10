<?php
namespace Ollieslab\Multitenancy\Driver;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Ollieslab\Multitenancy\Middleware\LoadTenant;

/**
 * Class Directory
 *
 * @package Ollieslab\Multitenancy\Driver
 */
class Directory extends BaseDriver
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
                'prefix'        => '{_multitenant_}',
                'middleware'    => LoadTenant::class
            ],
            $routes);
    }
}