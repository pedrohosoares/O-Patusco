<?php

namespace App\Business\Services\Abstracts;

use App\Traits\HttpResponseTrait;
use App\Traits\LogsTrait;

abstract class CrudAbstract
{

    use LogsTrait,HttpResponseTrait;

    protected $repository;

    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    public function index(object $request)
    {
        try {
            return $this->repository->index($request->all());
        } catch (\Throwable $th) {
            $this->log($th->getMessage());
        }
    }

    public function show(int $id)
    {
        try {
            return $this->successResponse($this->repository->show($id));
        } catch (\Throwable $th) {
            $this->log($th->getMessage());
        }
    }

    public function store(array $data)
    {
        try {
            return $this->successResponse($this->repository->store($data));
        } catch (\Throwable $th) {
            $this->log($th->getMessage());
        }
    }

    public function update(int $id,array $data)
    {
        try {
            return $this->successResponse($this->repository->update($id,$data));
        } catch (\Throwable $th) {
            $this->log($th->getMessage());
        }
    }
    
    public function destroy(int $id)
    {
        try {
            return $this->successResponse($this->repository->destroy($id));
        } catch (\Throwable $th) {
            $this->log($th->getMessage());
        }
    }

    public function storeOrUpdate(array $dataToSave,string $columToSearch,string $valueToSearch): object
    {
        try {
            $data = $this->repository->$columToSearch($dataToSave[$valueToSearch]);
            if($data)
            {
                $this->repository->update($data['id'],$dataToSave);
                $data = $this->repository->$columToSearch($data[$valueToSearch]);
            }else{
                $data = $this->repository->store($dataToSave);
            }
            return $data;
        } catch (\Throwable $th) {
            $this->log($th->getMessage());
        }
    }
    
}