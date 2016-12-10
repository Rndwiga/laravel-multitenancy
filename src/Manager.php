<?php
namespace Ollieslab\Multitenancy;

use InvalidArgumentException;
use Ollieslab\Multitenancy\Contracts\Provider;
use Ollieslab\Multitenancy\Driver\Directory;
use Ollieslab\Multitenancy\Driver\Domain;
use Ollieslab\Multitenancy\Driver\Subdomain;
use Ollieslab\Multitenancy\Providers\Database;
use Ollieslab\Multitenancy\Providers\Eloquent;

/**
 * Class Manager
 *
 * @package Ollieslab\Multitenancy
 */
class Manager
{

    protected $app;

    protected $driver;

    protected $customProviders = [];

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function __call($method, $parameters)
    {
        return $this->driver()->{$method}(...$parameters);
    }

    public function driver()
    {
        return $this->driver ? $this->driver : $this->driver = $this->resolve();
    }

    public function resolve()
    {
        return $this->createDriver($this->app['config']['multitenancy']);
    }

    public function provider($driver, \Closure $callback)
    {
        $this->customProviders[$driver] = $callback;
        return $this;
    }

    public function createDriver($config)
    {
        $provider = $this->createProvider($config);

        $driverMethod = 'create'.ucfirst($config['type']).'Driver';

        if (method_exists($this, $driverMethod)) {
            return $this->{$driverMethod}($provider);
        }

        throw new InvalidArgumentException("Auth guard driver [{$config['type']}] is not defined.");
    }

    protected function createSubdomainDriver(Provider $provider)
    {
        return new Subdomain($provider);
    }

    protected function createDirectoryDriver(Provider $provider)
    {
        return new Directory($provider);
    }

    protected function createDomainDriver(Provider $provider)
    {
        return new Domain($provider);
    }

    protected function createProvider($config)
    {
        if (isset($this->customProviders[$config['provider']])) {
            return call_user_func(
                $this->customProviders[$config['provider']], $this->app, $config
            );
        }

        switch($config['provider']) {
            case 'eloquent':
                return $this->createEloquentProvider($config);
            case 'database':
                return $this->createDatabaseProvider($config);
        }
    }

    protected function createEloquentProvider($config)
    {
        return new Eloquent($config['model']);
    }

    protected function createDatabaseProvider($config)
    {
        $connection = $this->app['db']->connection();;
        return new Database($connection, $config['table'], $config['identifiers']);
    }
}