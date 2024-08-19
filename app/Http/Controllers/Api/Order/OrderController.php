<?php

namespace App\Http\Controllers\Api\Order;

use App\Business\Services\Orders\OrderService;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Traits\HttpResponseTrait;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use HttpResponseTrait;

    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            return OrderResource::collection($this->orderService->index($request));
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        try {
            return $this->orderService->show($id);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
