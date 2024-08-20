<?php

namespace App\Http\Controllers\Api\Order;

use App\Business\Services\Orders\ScheduleService;
use App\Http\Controllers\Api\Abstracts\CrudAbstractController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Schedules\UpdateSchedulesRequest;
use App\Http\Resources\ScheduleResource;
use App\Traits\HttpResponseTrait;
use Illuminate\Http\Request;

class ScheduleController extends CrudAbstractController
{
    use HttpResponseTrait;

    protected $service;

    public function __construct(ScheduleService $service)
    {
        $this->service = $service;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            return $this->service->index($request);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

    public function updateSchedule(UpdateSchedulesRequest $request)
    {
        try {
            return $this->service->updateSchedule($request->all());
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }
    

}
