<?php
namespace Ollieslab\Multitenancy\Contracts;

use Illuminate\Http\Request;

/**
 * Interface Driver
 *
 * @package Ollieslab\Multitenancy\Contracts
 */

interface Driver
{

    /**
     * Provides a route group for the current driver.
     *
     * @param \Closure $routes
     *
     * @return \Illuminate\Routing\Route
     */
    public function routes(\Closure $routes);

    /**
     * Retrieve the current tenant.
     *
     * @return Tenant
     */
    public function get();

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function process(Request $request);

    /**
     * @return Provider
     */
    public function provider();
}