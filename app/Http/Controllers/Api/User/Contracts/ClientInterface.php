<?php
namespace App\Http\Controllers\Api\User\Contracts;

use App\Http\Requests\User\ClientRequest;
use Illuminate\Http\JsonResponse;

interface ClientInterface
{
    public function storeOrder(ClientRequest $request): JsonResponse;

}