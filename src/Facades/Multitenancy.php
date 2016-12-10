<?php
namespace Ollieslab\Multitenancy\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Multitenancy
 *
 * @package Ollieslab\Multitenancy\Facades
 */
class Multitenancy extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'multitenancy';
    }
}