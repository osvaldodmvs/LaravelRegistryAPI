<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class ApiController extends Controller
{
    /**
     * Create a success response.
     *
     * @param array|null $data
     * @param int $statusCode
     * @return JsonResponse
     */
    protected function successResponse($data = null, $statusCode = 200)
    {
        return response()->json([
            'success' => true,
            'data' => $data,
        ], $statusCode);
    }

    /**
     * Create an error response.
     *
     * @param string|array $message
     * @param int $statusCode
     * @return JsonResponse
     */
    protected function errorResponse($message, $statusCode)
    {
        return response()->json([
            'success' => false,
            'error' => $message,
        ], $statusCode);
    }
}
