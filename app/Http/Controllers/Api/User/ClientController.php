<?php
namespace App\Http\Controllers\Api\User;

use App\Business\Services\Users\ClientService;
use App\Http\Controllers\Api\User\Contracts\ClientInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\ClientRequest;

class ClientController extends Controller implements ClientInterface
{
    protected $service;

    public function __construct(ClientService $service)
    {
        $this->service = $service;
    }

    public function storeOrder(ClientRequest $request): array
    {
        try {
            return $this->service->storeOrder($request->all());    
        } catch (\Throwable $th) {
            return [$th->getMessage()];
        }
        
    }
}