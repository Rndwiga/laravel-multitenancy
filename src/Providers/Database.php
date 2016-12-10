<?php
namespace Ollieslab\Multitenancy\Providers;

use Illuminate\Database\ConnectionInterface;
use Ollieslab\Multitenancy\Contracts\Provider;
use Ollieslab\Multitenancy\GenericTenant;

/**
 * Class Database
 *
 * @package Ollieslab\Multitenancy\Drivers
 */
class Database implements Provider
{

    protected $connection;

    protected $table;

    protected $identifier;

    protected $secondaryIdentifier;

    public function __construct(ConnectionInterface $connection, $table, $identifiers)
    {
        $this->connection = $connection;
        $this->table = $table;
        $this->identifier = $identifiers[0];
        $this->secondaryIdentifier = $identifiers[1];
    }

    public function retrieveById($identifier, $secondaryIdentifier = null)
    {
        $query = $this->connection->table($this->table);
        $query->where($this->identifier, '=', $identifier);

        if ($this->secondaryIdentifier) {
            $query->orWhere($this->secondaryIdentifier, '=', $secondaryIdentifier);
        }

        return $this->getGenericTenant($query->first());
    }

    protected function getGenericTenant($user)
    {
        if (! is_null($user)) {
            return new GenericTenant((array) $user);
        }
    }
}