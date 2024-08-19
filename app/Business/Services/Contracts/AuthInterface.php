<?php
namespace App\Business\Services\Contracts;

use App\Http\Requests\AuthRequest;
use Illuminate\Http\JsonResponse;

interface AuthInterface
{
    public function login(AuthRequest $request): JsonResponse;
    public function logout(): JsonResponse;
}