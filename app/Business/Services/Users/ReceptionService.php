<?php

namespace App\Business\Services\Users;

use App\Business\Services\Orders\ScheduleService;
use App\Http\Resources\ScheduleResource;
use App\Models\Services\Schedule;
use App\Traits\HttpResponseTrait;
use App\Traits\LogsTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ReceptionService
{

    use LogsTrait, HttpResponseTrait;

    protected $service;

    public function __construct(
        ScheduleService $service
    ) {
        $this->service = $service;
    }


    public function joinScheduleToDoctor(int $schedule_id, int $doctor_id)
    {
        try {
            if (Gate::denies('attachDoctor', Schedule::class)) {
                return $this->errorResponse('Ação não permitida');
            }
            $schedule = $this->service->show($schedule_id);
            $schedule->doctor()->detach($doctor_id);
            $schedule->doctor()->attach($doctor_id);
            return $this->successResponse('Médico atribuido com sucesso!');
        } catch (\Throwable $th) {
            $this->log($th->getMessage());
            return [$th->getMessage()];
        }
    }

    public function removeScheduleToDoctor(int $schedule_id, int $doctor_id)
    {
        try {
            if (Gate::denies('detachDoctor', Schedule::class)) {
                return $this->errorResponse('Ação não permitida');
            }
            $schedule = $this->service->show($schedule_id);
            $schedule->doctor()->detach($doctor_id);
            return $this->successResponse('Médico removido com sucesso!');
        } catch (\Throwable $th) {
            $this->log($th->getMessage());
            return [$th->getMessage()];
        }
    }
}
