<?php

namespace App\Business\Repositories\Animals;

use App\Business\Repositories\Abstracts\CrudAbstract;
use App\Business\Repositories\Contracts\ReadableInterface;
use App\Business\Repositories\Contracts\WritableInterface;
use App\Models\Animals\Race;

class RaceRepository extends CrudAbstract implements ReadableInterface,WritableInterface
{
    protected $model;

    public function __construct(Race $model)
    {
        $this->model = $model;
    }
}