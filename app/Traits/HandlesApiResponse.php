<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait HandlesApiResponse
{

    /**
     *  Handle success API response
     *
     * @param mixed $data
     * @param int $code
     *
     * @return Illuminate\Http\JsonResponse
    */

    protected function successResponse(mixed $data = null, int $code = 200): JsonResponse
    {
        // Define base of response
        $response = [ 'success' => true ];

        // Append data if recieved
        if($data !== null ) {
            $response['data'] = $data;
        }

        // Return response
        return response()->json($response, $code);
    }

    /**
     *  Handle error API response
     *
     * @param mixed $data
     * @param int $code
     *
     * @return Illuminate\Http\JsonResponse
    */

    protected function errorResponse(string $message = null, int $code): JsonResponse
    {
        // Define base of response
        $response = [ 'success' => false ];

        // Append data if recieved
        if($message !== null ) {
            $response['message'] = $message;
        }
        return response()->json($response, $code);
    }
}
