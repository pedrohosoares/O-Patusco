<?php

namespace App\Http\Controllers\Api\Abstracts;

use App\Http\Controllers\Controller;
use App\Http\Resources\AbstractResource;
use App\Traits\HttpResponseTrait;
use Illuminate\Http\Request;

abstract class CrudAbstractController extends Controller
{
    use HttpResponseTrait;

    protected $service;

    public function __construct($service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            return AbstractResource::collection($this->service->index($request));
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            return $this->service->store($request->all());
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        try {
            return $this->service->show($id);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            return $this->service->update($id,$request->all());
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            return $this->service->destroy($id);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }
}