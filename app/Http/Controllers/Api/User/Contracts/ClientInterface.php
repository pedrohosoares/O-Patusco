<?php
namespace App\Http\Controllers\Api\User\Contracts;

use App\Http\Requests\User\ClientRequest;

interface ClientInterface
{
    public function storeOrder(ClientRequest $request): array;

}