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

    public function storeOrder(array $data)
    {
        try {
            $data['user']['rule_id'] = Rule::USER_TYPES['cliente'];
            return $this->service->store($data)->toArray();
        } catch (\Throwable $th) {
            $this->log($th->getMessage());
        }
    }
}