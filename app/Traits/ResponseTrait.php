<?php

namespace App\Traits;

trait ResponseTrait
{
    private $status_ok = 200;
    private $status_conflict = 409;


    /**
     * Returns http Ok response with 200 status code
     *
     * @param string $message
     * @param array|object  (optional) $data
     * @param int (optional) $code
     *
     * @returns \Illuminate\Http\JsonResponse
     */
    
    public function sendSuccessResponse($message, $data = null, $code = null)
    {
        return response(
            [
                'code' => $code ?? $this->status_ok,
                'message' => $message,
                'data' => $data ?? (object) [],
            ],
            $this->status_ok
        );
    }

    /**
     * Returns http CONFLICT response with 409 status code
     *
     * @param string $message
     * @param array|object  (optional) $data
     * @param int (optional) $code
     *
     */
    
     public function sendConflictResponse($message, $data = null, $code = null)
     {
         return response(
             [
                 'code' => $code ?? $this->status_conflict,
                 'message' => $message,
                 'data' => $data ?? (object) [],
             ],
             $this->status_conflict
         );
     }
}
