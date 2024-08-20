<?php

namespace App\Business\Repositories\Orders;

use App\Business\Repositories\Abstracts\CrudAbstract;
use App\Business\Repositories\Contracts\ReadableInterface;
use App\Business\Repositories\Contracts\WritableInterface;
use App\Models\Services\Order;

class OrderRepository extends CrudAbstract implements ReadableInterface,WritableInterface
{
    protected $model;

    public function __construct(Order $model)
    {
        $this->model = $model;
    }

    public function show($id): object
    {
        return $this->model->with(['client','animal','animal.race'])->find($id);
    }

    public function storeAndReturnData(array $data)
    {
        return $this->model->create($data);
    }


}