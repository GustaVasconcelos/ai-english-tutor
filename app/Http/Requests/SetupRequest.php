<?php

namespace App\Http\Requests;

use App\Http\Requests\Base\BaseFormRequest;

class SetupRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'correct_always' => ['required', 'boolean'],
            'explanation_language' => ['required', 'in:pt,en'],
            'level' => ['required', 'in:beginner,intermediate,advanced'],
        ];
    }

    public function messages(): array
    {
        return [
            'correct_always.required' => 'O campo "corrigir sempre" é obrigatório.',
            'correct_always.boolean' => 'O campo "corrigir sempre" deve ser verdadeiro ou falso.',

            'explanation_language.required' => 'O idioma da explicação é obrigatório.',
            'explanation_language.in' => 'O idioma da explicação deve ser "pt" ou "en".',

            'level.required' => 'O nível é obrigatório.',
            'level.in' => 'O nível deve ser: beginner, intermediate ou advanced.',
        ];
    }
}