<?php

namespace App\Business\Repositories\Users;

use App\Business\Repositories\Abstracts\CrudAbstract;
use App\Business\Repositories\Contracts\ReadableInterface;
use App\Business\Repositories\Contracts\WritableInterface;
use App\Models\Users\User;
use Illuminate\Support\Facades\DB;

class UserRepository extends CrudAbstract implements ReadableInterface,WritableInterface
{

    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function show($id): object
    {
        return $this->model->with('rule')->find($id);
    }

}