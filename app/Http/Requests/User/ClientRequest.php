<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'user.name'=>'required|min:3|string',
            'user.email'=>'required|email',
            'animal.name'=>'required|min:3|string',
            'race.name'=>'required|min:3|string',
            'animal.birthday'=>'required|string',
            'order.symptoms'=>'required|min:3|string',
            'schedule.date'=>'required|date',
            'schedule.time'=>'required'
        ];
    }

    public function messages(): array
    {
        return [
            'user.name.required'=>'O nome do utente é obrigatório',
            'user.name.min'=>'O nome do utente precisa ter pelo menos 3 letras',
            'user.name.string'=>'O nome do utente precisa ser um texto',
            'user.email.required'=>'O e-mail do utente é obrigatório',
            'user.email.email'=>'Informe um e-mail válido para o utente',
            'animal.name.required'=>'O nome do animal é obrigatório',
            'animal.name.min'=>'Informe o nome do animal com pelo menos 3 letras',
            'animal.name.string'=>'Informe o nome do animal como um texto',
            'race.name.required'=>'O nome do tipo do animal é obrigatório',
            'race.name.min'=>'O tipo do animal precisa ter 3 letras no mínimo',
            'race.name.string'=>'Informe o tipo do animal como um texto',
            'animal.birthday.required'=>'Informe a data de nascimento do animal',
            'animal.birthday.string'=>'A data de nascimento precisa ser um texto YYYY-mm-dd',
            'order.symptoms.string'=>'Os sintomas precisam ser um texto',
            'order.symptoms.min'=>'Os sintomas devem ter no mínimo 3 letras',
            'order.symptoms.required'=>'Informe os sintomas do animal',
            'schedule.date.required'=>'A data do agendamento é obrigatória',
            'schedule.date.date'=>'Informe a data desejada para o atendimento',
            'schedule.time.required'=>''
        ];
    }
}
