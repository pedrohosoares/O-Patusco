<?php

namespace App\Business\Repositories\Abstracts;

use App\Contracts\ReadableInterface;
use App\Contracts\WritableInterface;

abstract class CrudAbstract
{

    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function index($request): object
    {
        return $this->model->paginate(env('PAGINATE',15));
    }

    public function show($id): object
    {
        return $this->model->find($id);
    }

    public function store(array $data): object
    {
        return $this->model->create($data);
    }
    
    public function update(int $id,array $data): bool
    {
        return $this->model->where('id',$id)->update($data);
    }

    public function destroy(int $id): bool
    {
        return $this->model->destroy($id);
    }

    public function __call(string $method,array $value)
    {
        if(strpos($method,'findBy') === 0)
        {
            $column = strtolower(str_replace('findBy','',$method));
            return $this->model->where($column,$value[0])->first();
        }
        
    }
    
}