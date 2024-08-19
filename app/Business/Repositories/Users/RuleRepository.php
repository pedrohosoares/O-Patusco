<?php

namespace App\Business\Repositories\Users;

use App\Business\Repositories\Abstracts\CrudAbstract;
use App\Business\Repositories\Contracts\ReadableInterface;
use App\Business\Repositories\Contracts\WritableInterface;
use App\Models\Users\Rule;

class RuleRepository extends CrudAbstract implements ReadableInterface,WritableInterface
{

    protected $model;

    public function __construct(Rule $model)
    {
        $this->model = $model;
    }

}