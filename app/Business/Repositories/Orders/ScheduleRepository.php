<?php

namespace App\Business\Repositories\Orders;

use App\Business\Repositories\Abstracts\CrudAbstract;
use App\Business\Repositories\Contracts\ReadableInterface;
use App\Business\Repositories\Contracts\WritableInterface;
use App\Models\Services\Schedule;

class ScheduleRepository extends CrudAbstract implements ReadableInterface,WritableInterface
{

    protected $model;

    public function __construct(Schedule $model)
    {
        $this->model = $model;
    }

    public function index($request): ?object
    {
        $date_start = $request['date_start'] ?? null;
        $date_end = $request['date_end'] ?? null;
        $race = $request['race'] ?? null;
        if($date_start and $date_end)
        {
            $this->model = $this->model->whereBetween('date',[$date_start,$date_end]);
        }
        if($date_start and !$date_end)
        {
            $this->model = $this->model->where('date','>=',$date_start);
        }
        if(!$date_start and $date_end)
        {
            $this->model = $this->model->where('date','<=',$date_end);
        }
        if($race)
        {
            $this->model = $this->model->whereHas('order.animal.race',function($query) use ($race){
                return $query->where('name','like',"{$race}%");
            });
        }
        $model = $this->model->paginate(env('PAGINATE',15));
        return $model;
    }

    public function show($id): ?object
    {
        return $this->model->with([
            'doctor',
            'order',
            'order.animal',
            'order.animal.race',
            'order.client'
        ])->find($id);
    }

    public function getSpecific(int $id)
    {
        return $this->model->find($id);
    }

}