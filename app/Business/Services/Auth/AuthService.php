<?php
namespace App\Business\Services\Auth;

use App\Business\Repositories\Users\UserRepository;
use App\Business\Services\Contracts\AuthInterface;
use App\Http\Requests\AuthRequest;
use App\Models\Users\Rule;
use App\Traits\HttpResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthService implements AuthInterface
{

    use HttpResponseTrait;

    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function login($request): JsonResponse
    {
        $data = $request->only(['email','password']);
        if(!Auth::attempt($data))
        {
            return $this->errorResponse('Login não encontrado');
        }
        $rule = Auth::user()->rule->name_type;
        $token = Auth::user()->createToken($rule)->plainTextToken;
        return $this->successResponse(['token'=>$token]);
    }

    public function logout(): JsonResponse
    {
        Auth::user()->tokens()->delete();
        return $this->successResponse('Logout realizado com sucesso!');
    }
}