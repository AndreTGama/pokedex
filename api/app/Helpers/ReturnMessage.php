<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

class ReturnMessage
{
    /**
     * Returns a JSON response indicating a successful operation.
     *
     * @param string $message The success message to be included in the response.
     * @param array $data Optional. Additional data to include in the response. Defaults to an empty array.
     * @param int $status Optional. The HTTP status code for the response. Defaults to 200.
     *
     * @return \Illuminate\Http\JsonResponse The JSON response containing the success message, data, and error flag.
     */
    public static function success(string $message, array $data = [], int $status = 200): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'exception' => null,
            'data' => $data,
            'error' => false,
        ], $status ?? 200);
    }

    /**
     * Returns a JSON response for an error message.
     *
     * @param string $message The error message to be returned.
     * @param array $data Optional additional data to include in the response. Defaults to an empty array.
     * @param int $status The HTTP status code for the response. Defaults to 400.
     * 
     * @return \Illuminate\Http\JsonResponse The JSON response containing the error message, data, and status.
     */
    public static function error(string $message, mixed $exexception, array $data = [], int $status = 400): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'exception' => $exexception,
            'data' => $data,
            'error' => true,
        ], $status ?? 400);
    }
}
