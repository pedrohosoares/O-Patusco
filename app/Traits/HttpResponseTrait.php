<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait HttpResponseTrait
{
    protected function successResponse($response,int $status = 200) : JsonResponse
    {
        return response()->json(
            [
                'success'=>true,
                'data'=>$response,
                'code'=>$status
            ],200
        ); 
    }

    protected function errorResponse($response,int $status = 500) : JsonResponse
    {
        return response()->json(
            [
                'success'=>false,
                'data'=>$response,
                'code'=>$status
            ],500
        ); 
    }
}