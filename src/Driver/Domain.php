<?php
namespace Ollieslab\Multitenancy\Driver;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Ollieslab\Multitenancy\Middleware\LoadTenant;

/**
 * Class Domain
 *
 * @package Ollieslab\Multitenancy\Driver
 */
class Domain extends BaseDriver
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
        Route::pattern('_multitenant_', '[a-z0-9.]+');

        return Route::group(
            [
                'domain'        => '{_multitenant_}',
                'middleware'    => LoadTenant::class
            ],
            $routes);
    }

    public function process(Request $request)
    {
        $identifier = $request->route()->parameter('_multitenant_');

        if ($identifier) {
            $this->tenant = $this->provider()->retrieveById($identifier, str_replace('.' . config('multitenancy.domain'), '', $identifier));
        }

        $request->route()->forgetParameter('_multitenant_');
    }


}