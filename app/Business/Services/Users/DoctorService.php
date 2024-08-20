<?php
namespace App\Business\Services\Users;

use App\Business\Repositories\Users\UserRepository;
use App\Business\Services\Orders\ScheduleService;
use App\Models\Users\User;
use Illuminate\Http\Request;
use App\Traits\HttpResponseTrait;
use App\Traits\LogsTrait;
use Illuminate\Support\Facades\Gate;

class DoctorService
{

    use LogsTrait,HttpResponseTrait;

    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(array $data)
    {
        try {
            if(Gate::denies('viewAny',User::class))
            {
                return $this->errorResponse('Ação não permitida');
            }
            return $this->repository->getAllDoctors($data);
        } catch (\Throwable $th) {
            $this->log($th->getMessage());
        }
    }


}