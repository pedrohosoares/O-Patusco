<?php

namespace App\Http\Controllers\Api\User;

use App\Business\Services\Orders\ScheduleService;
use App\Business\Services\Users\ReceptionService;
use App\Http\Controllers\Api\User\Contracts\ReceptionInterface;
use App\Http\Controllers\Controller;
use App\Models\Services\Schedule;
use App\Traits\HttpResponseTrait;
use App\Traits\LogsTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ReceptionController extends Controller implements ReceptionInterface
{

    use LogsTrait, HttpResponseTrait;

    protected $service;
    protected $receptionService;

    public function __construct(
        ScheduleService $service,
        ReceptionService $receptionService
    ) {
        $this->service = $service;
        $this->receptionService = $receptionService;
    }

    public function allSchedules(Request $request)
    {
        try {
            return $this->service->index($request);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

    public function showSchedule(int $id)
    {
        try {
            return $this->service->show($id);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

    public function joinScheduleToDoctor(int $schedule_id, int $doctor_id)
    {
        try {
            return $this->receptionService->joinScheduleToDoctor($schedule_id, $doctor_id);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

    public function createSchedule(array $data)
    {
        try {
            return $this->service->store($data);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

    public function updateSchedule(int $id, array $data)
    {
        try {
            return $this->service->update($id, $data);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

    public function removeScheduleToDoctor(int $schedule_id, int $doctor_id)
    {
        try {
            return $this->receptionService->removeScheduleToDoctor($schedule_id, $doctor_id);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

    public function deleteSchedule(int $id)
    {
        try {
            $remove = $this->service->destroy($id);
            return $this->successResponse('Agenda excluída com sucesso!');
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }
}
