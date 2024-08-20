<?php
namespace App\Http\Controllers\Api\User;

use App\Business\Services\Users\ClientService;
use App\Http\Controllers\Api\User\Contracts\ClientInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\ClientRequest;
use App\Traits\HttpResponseTrait;
use Illuminate\Http\JsonResponse;

class ClientController extends Controller implements ClientInterface
{

    use HttpResponseTrait;
    
    protected $service;

    public function __construct(ClientService $service)
    {
        $this->service = $service;
    }

    public function storeOrder(ClientRequest $request): JsonResponse
    {
        try {
            return $this->service->store($request->all());    
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
        
    }
}