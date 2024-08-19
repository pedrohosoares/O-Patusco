<?php

namespace App\Http\Requests\Services;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'animal_id'=>'required|numeric|exists:animals,id',
            'client_id'=>'required|numeric|exists:users,id',
            'symptoms'=>'required|min:3'
        ];
    }

    public function messages(): array
    {
        return [
            'animal_id.required'=>'O campo animal é requirido',
            'animal_id.numeric'=>'O animal informado não esta com os dados corretos',
            'animal_id.exists'=>'O animal precisa estar cadastrado no nosso sistema',
            'client_id.required'=>'O cliente é obrigatório',
            'client_id.numeric'=>'O cliente não esta com os dados corretos',
            'client_id.exists'=>'O cliente precisa estar cadastrado no nosso sistema',
            'symptoms.required'=>'Informe algum sintoma',
            'symptoms.min'=>'Informe um simtoma de no mínimo :min caractéres'
        ];
    }
}
