<?php

namespace App\Http\Controllers\Api\User;

use App\Business\Services\Users\UserService;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Traits\HttpResponseTrait;
use Illuminate\Http\Request;

class UserController extends Controller
{

    use HttpResponseTrait;

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        try {
            return UserResource::collection($this->userService->index($request));
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

    public function show(int $id)
    {
        try {
            return $this->userService->show($id);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }
}
