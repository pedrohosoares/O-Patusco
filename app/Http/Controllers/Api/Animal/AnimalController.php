<?php

namespace App\Http\Controllers\Api\Animal;

use App\Business\Services\Animals\AnimalService;
use App\Http\Controllers\Api\Abstracts\CrudAbstractController;
use App\Http\Controllers\Controller;
use App\Http\Resources\AnimalResource;
use App\Traits\HttpResponseTrait;
use Illuminate\Http\Request;

class AnimalController extends CrudAbstractController
{
    use HttpResponseTrait;

    protected $service;

    public function __construct(AnimalService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            return AnimalResource::collection($this->service->index($request));
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }
}
