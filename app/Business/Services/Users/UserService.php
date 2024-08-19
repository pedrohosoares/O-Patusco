<?php

namespace App\Business\Services\Users;

use App\Business\Repositories\Users\UserRepository;
use App\Business\Services\Abstracts\CrudAbstract;
use App\Models\Users\User;
use App\Traits\HttpResponseTrait;
use Illuminate\Support\Facades\Gate;

class UserService extends CrudAbstract
{

    use HttpResponseTrait;

    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(object $request)
    {
        if(Gate::denies('viewAny',User::class))
        {
            return $this->errorResponse('Ação não permitida');
        }
        return parent::index($request);
    }

    public function show(int $id)
    {
        if(Gate::denies('view',User::class))
        {
            return $this->errorResponse('Ação não permitida');
        }
        return parent::show($id);
    }

    public function store(array $data)
    {
        if(Gate::denies('create',User::class))
        {
            return $this->errorResponse('Ação não permitida');
        }
        return parent::store($data);
    }

    public function update(int $id, array $data)
    {
        if(Gate::denies('update',User::class))
        {
            return $this->errorResponse('Ação não permitida');
        }
        return parent::update($id, $data);
    }

    public function destroy(int $id)
    {
        if(Gate::denies('delete',User::class))
        {
            return $this->errorResponse('Ação não permitida');
        }
        return parent::destroy($id);
    }

}