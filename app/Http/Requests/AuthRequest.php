<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
            'email'=>'required|email|exists:users,email',
            'password'=>'required|min:5'
        ];
    }

    public function messages(): array
    {
        return [
            'email.required'=>'Informe um e-mail',
            'email.required'=>'Informe um e-mail válido',
            'email.exists'=>'Login inexistente',
            'password.required'=>'Informe a senha',
            'password.exists'=>'A senha deve ter pelo menos 5 caracteres'
        ];
    }
}
