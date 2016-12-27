<?php
namespace Ollieslab\Multitenancy\Traits;

/**
 * Interface Tenant
 *
 * @package Ollieslab\Multitenancy\Traits
 */

trait TenantSecondary
{

    public function getSecondaryIdentifierName()
    {
        return 'secondary_identifier';
    }

    public function getSecondaryIdentifier()
    {
        return $this->{$this->getIdentifierName()};
    }
}