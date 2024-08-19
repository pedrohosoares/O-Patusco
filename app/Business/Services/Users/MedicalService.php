<?php
namespace App\Business\Services\Users;

use App\Business\Services\Orders\ScheduleService;
use Illuminate\Http\Request;
use App\Traits\HttpResponseTrait;
use App\Traits\LogsTrait;

class MedicalService
{

    use LogsTrait,HttpResponseTrait;

    protected $service;

    public function __construct(ScheduleService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        try {
            return $this->service->index($request);
        } catch (\Throwable $th) {
            $this->log($th->getMessage());
        }
    }

    public function updateSchedule(int $id,array $data)
    {
        try {
            $this->service->update($id,$data);
            return $this->successResponse('Marcação editada com sucesso');
        } catch (\Throwable $th) {
            $this->log($th->getMessage());
        }
    }

}