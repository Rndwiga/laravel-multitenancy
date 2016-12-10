<?php
namespace Ollieslab\Multitenancy\Traits;

/**
 * Interface Tenant
 *
 * @package Ollieslab\Multitenancy\Traits
 */

trait Tenant
{

    public function getIdentifierName()
    {
        return 'identifier';
    }

    public function getIdentifier()
    {
        return $this->{$this->getIdentifierName()};
    }
}