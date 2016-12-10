<?php
namespace Ollieslab\Multitenancy\Middleware;

use Closure;
use Ollieslab\Multitenancy\Facades\Multitenancy;

/**
 * Class LoadTenant
 *
 * @package Ollieslab\Multitenancy\Middleware
 */
class LoadTenant
{

    public function handle($request, Closure $next)
    {
        Multitenancy::process($request);

        return $next($request);
    }
}