<?php
namespace App\Http\Controllers\Api\Login;

use App\Business\Services\Auth\AuthService;
use App\Http\Requests\AuthRequest;
use Illuminate\Http\JsonResponse;

class LoginController
{

    protected $service;

    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }

    public function login(AuthRequest $request): JsonResponse
    {
        return $this->service->login($request);
    }

    public function logout(): JsonResponse
    {
        return $this->service->logout();
    }
}