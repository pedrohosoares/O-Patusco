<?php

namespace App\Business\Services\Orders;

use App\Business\Repositories\Orders\OrderRepository;
use App\Business\Services\Abstracts\CrudAbstract;

class OrderService extends CrudAbstract
{

    protected $repository;

    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function storeAndReturnData(array $data)
    {
        return $this->repository->storeAndReturnData($data);
    }

}