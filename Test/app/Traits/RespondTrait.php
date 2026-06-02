<?php

namespace App\Traits;

trait RespondTrait
{
    public function successResponse($data = null, $message = 'Success', $code = 200)
    {
         $response = [
            'status' => 'success',
            'message' => $message,
        ];
        if (!is_null($data)) {
            $response['data'] = $data;
        }
        return response()->json($response, $code);
    }
    public function errorResponse($message = 'Error', $code = 400)
    {
        return response()->json([
            'status' => 'Failed',
            'message' => $message
        ], $code);
    }
}
