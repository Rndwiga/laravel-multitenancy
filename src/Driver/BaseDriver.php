<?php
namespace Ollieslab\Multitenancy\Driver;

use Illuminate\Http\Request;
use Ollieslab\Multitenancy\Contracts\Driver;
use Ollieslab\Multitenancy\Contracts\Provider;
use Ollieslab\Multitenancy\Contracts\Tenant;
use Ollieslab\Multitenancy\Exceptions\InvalidTenantException;

/**
 * Class BaseDriver
 *
 * @package Ollieslab\Multitenancy\Driver
 */
abstract class BaseDriver implements Driver
{

    /**
     * @var Provider
     */
    protected $provider;

    /**
     * @var Tenant
     */
    protected $tenant;

    public function __construct(Provider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * Retrieve the current tenant.
     *
     * @return Tenant
     */
    public function get()
    {
        return $this->tenant;
    }

    /**
     * @return Provider
     */
    public function provider()
    {
        return $this->provider;
    }

    /**
     * @param Request $request
     *
     * @return mixed|void
     * @throws \Ollieslab\Multitenancy\Exceptions\InvalidTenantException
     */
    public function process(Request $request)
    {
        $identifier = $request->route()->parameter('_multitenant_');

        if ($identifier) {
            $this->tenant = $this->provider->retrieveById($identifier);
        }

        if (!$this->tenant) {
            throw new InvalidTenantException('Invalid Tenant \''.$identifier.'\'');
        }

        $request->route()->forgetParameter('_multitenant_');
    }
}