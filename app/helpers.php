<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

function createResponse(Model|Collection|array|null $response, int $status = 200): JsonResponse
{
    if (!$response) {
        $status = 404;
    }
    return response()->json([
        'data' => $response,
        'status' => $status,
    ], $status);
}

function createErrorResponse(Exception $e): JsonResponse
{
    Log::error($e->getMessage());
    Log::error($e->getTraceAsString());
    return createResponse(['error' => $e->getMessage()], 500);
}
