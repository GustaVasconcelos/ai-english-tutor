<?php

namespace App\Http\Controllers;

use App\Http\Requests\SetupRequest;
use App\Services\SetupService;
use App\Helpers\ApiResponse;
use Throwable;

class SetupController extends Controller
{
    public function __construct(
        protected SetupService $service
    ) {}

    public function store(SetupRequest $request)
    {
        try {
            $profile = $this->service->save($request->validated());

            return ApiResponse::success(
                $profile,
                'Configuração salva com sucesso.'
            );

        } catch (Throwable $e) {
            return ApiResponse::error(
                'Erro ao salvar configuração.',
                500,
                $e->getMessage()
            );
        }
    }

    public function show()
    {
        try {
            return ApiResponse::success(
                $this->service->get()
            );
        } catch (Throwable $e) {
            return ApiResponse::error(
                'Erro ao buscar configuração.',
                500,
                $e->getMessage()
            );
        }
    }
}