<?php
namespace Ollieslab\Multitenancy\Providers;

use Ollieslab\Multitenancy\Contracts\TenantSecondary;
use Ollieslab\Multitenancy\Contracts\Provider;

/**
 * Class Eloquent
 *
 * @package Ollieslab\Multitenancy\Drivers
 */
class Eloquent implements Provider
{

    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function retrieveById($identifier, $secondaryIdentifier = null)
    {
        $model = $this->createModel();
        $query = $model->newQuery();

        if ($identifier) {
            $query->where($model->getIdentifierName(), '=', $identifier);
        }

        if ($secondaryIdentifier && $model instanceof TenantSecondary) {
            $query->orWhere($model->getSecondaryIdentifierName(), '=', $secondaryIdentifier);
        }

        return $query->first();
    }

    public function createModel()
    {
        $class = '\\'.ltrim($this->model, '\\');

        return new $class;
    }

    public function getModel()
    {
        return $this->model;
    }

    /**
     * Sets the name of the Eloquent user model.
     *
     * @param  string  $model
     * @return $this
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }
}