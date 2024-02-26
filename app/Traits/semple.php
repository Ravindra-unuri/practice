<?php

namespace App\Traits;

trait ResponseTrait
{
    private $status_ok = 200;
    // private $status_bad_request = 400;
    // private $status_unauthorized = 401;
    // private $status_forbidden = 403;
    // private $status_not_found = 404;
    // private $status_not_allowed = 405;
    // private $status_validation_failed = 422;
    // private $status_server_error = 500;

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
        return $this->sendJsonResponse(
            [
                'code' => $code ?? $this->status_ok,
                'message' => $message,
                'data' => $data ?? (object) [],
            ],
            $this->status_ok
        );
    }

    // /**
    //  * Returns http bad request response with 400 status code
    //  *
    //  * @param string $message
    //  * @param array|object  (optional) $data
    //  * @param int (optional) $code
    //  *
    //  * @returns \Illuminate\Http\JsonResponse
    //  */
    // public function sendBadRequestResponse($message, $data = null, $code = null)
    // {
    //     return $this->sendJsonResponse(
    //         [
    //             'code' => $code ?? $this->status_bad_request,
    //             'message' => $message,
    //             'data' => $data ?? (object) [],
    //         ],
    //         $this->status_bad_request
    //     );
    // }

    // /**
    //  * Returns http unauthorized response with 401 status code
    //  *
    //  * @param string (optional) $message
    //  *
    //  * @returns \Illuminate\Http\JsonResponse
    //  */
    // public function sendUnauthorizedResponse($message = null)
    // {
    //     return $this->sendJsonResponse(
    //         [
    //             'code' => $this->status_unauthorized,
    //             'message' => $message ?? trans('translation.response.unauthorized'),
    //             'data' => (object) [],
    //         ],
    //         $this->status_unauthorized
    //     );
    // }

    // /**
    //  * Returns http forbidden response with 403 status code
    //  *
    //  * @param string (optional) $message
    //  *
    //  * @returns \Illuminate\Http\JsonResponse
    //  */
    // public function sendForbiddenResponse($message = null)
    // {
    //     return $this->sendJsonResponse(
    //         [
    //             'code' => $this->status_forbidden,
    //             'message' => $message ?? 'Invalid permission',
    //             'data' => (object) [],
    //         ],
    //         $this->status_forbidden
    //     );
    // }

    // /**
    //  * Returns http not found response with 404 status code
    //  *
    //  * @param string (optional) $message
    //  *
    //  * @returns \Illuminate\Http\JsonResponse
    //  */
    // public function sendNotFoundResponse($message = null)
    // {
    //     return $this->sendJsonResponse(
    //         [
    //             'code' => $this->status_not_found,
    //             'message' => $message ?? 'Not found',
    //             'data' => (object) [],
    //         ],
    //         $this->status_not_found
    //     );
    // }

    // /**
    //  * Returns http method not allowed response with 405 status code
    //  *
    //  * @param string (optional) $message
    //  *
    //  * @returns \Illuminate\Http\JsonResponse
    //  */
    // public function sendMethodNotAllowedResponse($message = null)
    // {
    //     return $this->sendJsonResponse(
    //         [
    //             'code' => $this->status_not_allowed,
    //             'message' => $message ?? 'Request ' . request()->method() . ' is not supported for this end point',
    //             'data' => (object) [],
    //         ],
    //         $this->status_not_allowed
    //     );
    // }

    // /**
    //  * Returns http server error response with 500 status code
    //  *
    //  * @param string (optional) $message
    //  *
    //  * @returns \Illuminate\Http\JsonResponse
    //  */
    // public function sendServerErrorResponse($message = null, $code = null)
    // {
    //     return $this->sendJsonResponse(
    //         [
    //             'code' => $code ?? $this->status_server_error,
    //             'message' => $message ?? 'Something went wrong, please try again later',
    //             'data' => (object) [],
    //         ],
    //         $this->status_server_error
    //     );
    // }

    // /**
    //  * Returns http validation failed error response with 422 status code
    //  *
    //  * @param array $data
    //  * @param string $message
    //  * @throws \Illuminate\Http\Exceptions\HttpResponseException
    //  */
    // public function sendValidationFailedResponse($data, $message)
    // {
    //     throw new HttpResponseException(
    //         response()->json([
    //             'data' => (object) ['errors' => $data],
    //             'message' => $message,
    //             'code' => $this->status_validation_failed,
    //         ], $this->status_validation_failed)
    //             ->setEncodingOptions(JSON_NUMERIC_CHECK)
    //             ->setEncodingOptions(JSON_PRESERVE_ZERO_FRACTION)
    //             ->setEncodingOptions(JSON_UNESCAPED_SLASHES)
    //     );
    // }

    // /**
    //  * Returns JSON response for http request
    //  *
    //  * @param array $data
    //  * @param int $status_code
    //  *
    //  * @returns \Illuminate\Http\JsonResponse
    //  */
    // private function sendJsonResponse($data, $status_code)
    // {
    //     return response()->json(
    //         $data,
    //         $status_code,
    //         [],
    //         JSON_UNESCAPED_UNICODE | JSON_PRESERVE_ZERO_FRACTION | JSON_UNESCAPED_SLASHES
    //     );
    // }
}
