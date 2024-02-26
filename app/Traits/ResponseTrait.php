<?php

namespace App\Traits;

trait ResponseTrait
{
    /**
     * Returns http Ok response with 200 status code
     *
     * @param string $message
     * @param array|object  (optional) $data
     * @param int (optional) $code
     *
     * @returns \Illuminate\Http\JsonResponse
     */
    public function sendSuccessResponse($message, $data = null, $code = 200)
    {
        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => $data ?? (object) [],
        ], $code);
    }
}
