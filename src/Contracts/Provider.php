<?php
namespace Ollieslab\Multitenancy\Contracts;

/**
 * Interface Driver
 *
 * @package Ollieslab\Multitenancy\Contracts
 */

interface Provider
{

    public function retrieveById($identifier, $secondaryIdentifier = null);
}