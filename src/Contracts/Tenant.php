<?php
namespace Ollieslab\Multitenancy\Contracts;

/**
 * Interface Tenant
 *
 * The Tenant contact to be used by classes that represent a tenant.
 *
 * @package Ollieslab\Multitenancy\Contracts
 */

interface Tenant
{

    /**
     * The name of the field used to identify the tenant.
     *
     * @return string
     */
    public function getIdentifierName();

    /**
     * The value of the field used to identify the tenant.
     *
     * @return mixed
     */
    public function getIdentifier();
}