<?php

namespace App\Business\Repositories\Animals;

use App\Business\Repositories\Abstracts\CrudAbstract;
use App\Business\Repositories\Contracts\ReadableInterface;
use App\Business\Repositories\Contracts\WritableInterface;
use App\Models\Animals\Animal;

class AnimalRepository extends CrudAbstract implements ReadableInterface,WritableInterface
{
    protected $model;

    public function __construct(Animal $model)
    {
        $this->model = $model;
    }

    public function show($id): object
    {
        return $this->model->with([
            'owner',
            'race',
        ])->find($id);
    }

    public function storeAndReturnData(array $data)
    {
        return $this->model->create($data);
    }

}