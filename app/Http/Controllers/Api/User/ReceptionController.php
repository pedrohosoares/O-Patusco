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

    protected $receptionService;

    public function __construct(
        ReceptionService $receptionService
    ) {
        $this->receptionService = $receptionService;
    }

    public function joinScheduleToDoctor(int $schedule_id, int $doctor_id)
    {
        try {
            return $this->receptionService->joinScheduleToDoctor($schedule_id, $doctor_id);
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

}
