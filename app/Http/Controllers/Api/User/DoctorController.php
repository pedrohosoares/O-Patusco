<?php
namespace App\Http\Controllers\Api\User;

use App\Business\Services\Users\DoctorService;
use App\Http\Controllers\Api\User\Contracts\DoctorInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DoctorController extends Controller implements DoctorInterface
{
    protected $service;

    public function __construct(DoctorService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        try {
            return $this->service->index($request->all());
        } catch (\Throwable $th) {
            return [$th->getMessage()];
        }
    }
}