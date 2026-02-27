<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\ChatRequest;
use App\Services\ChatService;
use Throwable;

class ChatController extends Controller
{
    public function __construct(
        protected ChatService $service
    ) {}

    public function send(ChatRequest $request)
    {
        try {
            $response = $this->service->send(
                $request->validated()['message']
            );

            return ApiResponse::success([
                'response' => $response
            ], 'Mensagem processada com sucesso.');
        } catch (Throwable $e) {
            return ApiResponse::error(
                message: 'Erro ao processar mensagem.',
                errors: $e->getMessage(),
                status: 500
            );
        }
    }

    public function conversations()
    {
        try {
            $response = $this->service->listUserConversations();

            return ApiResponse::success([
                'response' => $response
            ], 'Conversas listadas com sucesso.');
        } catch (Throwable $e) {
            return ApiResponse::error(
                message: 'Erro ao listar conversas.',
                errors: $e->getMessage(),
                status: 500
            );
        }
    }
}