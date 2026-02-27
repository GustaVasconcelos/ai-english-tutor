<?php

namespace App\Http\Requests;

use App\Http\Requests\Base\BaseFormRequest;

class ChatRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'message' => ['required', 'string', 'min:1'],
        ];
    }

    public function messages(): array
    {
        return [
            'message.required' => 'A mensagem é obrigatória.',
            'message.string'   => 'A mensagem deve ser um texto.',
            'message.min'      => 'A mensagem não pode estar vazia.',
        ];
    }
}