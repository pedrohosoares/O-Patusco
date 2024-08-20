<?php
namespace App\Business\Services\Users;

use App\Business\Services\Orders\ScheduleService;
use App\Models\Users\Rule;
use App\Traits\HttpResponseTrait;
use App\Traits\LogsTrait;

class ClientService
{

    use LogsTrait,HttpResponseTrait;

    protected $service;

    public function __construct(ScheduleService $service)
    {
        $this->service = $service;
    }

    public function store(array $data)
    {
        try {
            $data['user']['rule_id'] = Rule::USER_TYPES_ID['cliente'];
            return $this->successResponse($this->service->store($data)->toArray());
        } catch (\Throwable $th) {
            $this->log($th->getMessage());
        }
    }
}