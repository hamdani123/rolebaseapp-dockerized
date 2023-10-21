<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{

    public function sendApiResponse($status_code, $data, $message) : JsonResponse
    {
        return response()->json([
            'status_code' => $status_code,
            'message'=>$message,
            'data' => $data
        ]);
    }
}
