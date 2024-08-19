<?php

namespace App\Business\Services\Animals;

use App\Business\Repositories\Animals\AnimalRepository;
use App\Business\Services\Abstracts\CrudAbstract;
use App\Models\Animals\Animal;
use App\Traits\HttpResponseTrait;
use Illuminate\Support\Facades\Gate;

class AnimalService extends CrudAbstract
{

    use HttpResponseTrait;

    protected $repository;

    public function __construct(AnimalRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(object $request)
    {
        if(Gate::denies('viewAny',Animal::class))
        {
            return $this->errorResponse('Ação não permitida');
        }
        return parent::index($request);
    }

    public function show(int $id)
    {
        if(Gate::denies('view',Animal::class))
        {
            return $this->errorResponse('Ação não permitida');
        }
        return parent::show($id);
    }

    public function store(array $data)
    {
        if(Gate::denies('create',Animal::class))
        {
            return $this->errorResponse('Ação não permitida');
        }
        return parent::store($data);
    }

    public function update(int $id, array $data)
    {
        if(Gate::denies('update',Animal::class))
        {
            return $this->errorResponse('Ação não permitida');
        }
        return parent::update($id, $data);
    }

    public function destroy(int $id)
    {
        if(Gate::denies('delete',Animal::class))
        {
            return $this->errorResponse('Ação não permitida');
        }
        return parent::destroy($id);
    }
}
