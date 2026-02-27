<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

class ApiResponse
{
    public static function success(
        mixed $data = null,
        string $message = 'Operação realizada com sucesso.',
        int $status = 200
    ): JsonResponse {
        return response()->json([
            'message' => $message,
            'data'    => $data,
        ], $status);
    }

    public static function error(
        string $message = 'Erro interno.',
        int $status = 500,
        mixed $errors = null
    ): JsonResponse {
        return response()->json([
            'message' => $message,
            'errors'  => $errors,
        ], $status);
    }
}