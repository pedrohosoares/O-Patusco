<?php

namespace App\Business\Services\Users;

use App\Business\Repositories\Users\RuleRepository;
use App\Business\Services\Abstracts\CrudAbstract;

class RuleService extends CrudAbstract
{

    protected $repository;

    public function __construct(RuleRepository $repository)
    {
        $this->repository = $repository;
    }

}