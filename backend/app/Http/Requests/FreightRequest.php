<?php

namespace App\Http\Requests;

use App\Models\Freight;
use Illuminate\Foundation\Http\FormRequest;

class FreightRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    //aqui autorizo para que eu possa fazer o uso
    //chamar os arrays estaticos rules e messages
    //por padrão vem false.
    public function authorize()
 {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    //TODO aqui eu chamo o meu model Freight
    //TODO fazendo o uso :: quando quero
    //TODO chamar uma funcao ou variavel
    //TODO sendo estatica aqui vai ser os campos
    //TODO que são obrigatorios desse array
    //TODO e fazendo o uso da funcao rules.
    public function rules()
    {
        return Freight::$rules;
    }
    //TODO uma função messages
    //TODO que vai retornar as minhas mensagens
    //TODO lá para o meu controller
    public function messages()
    {
        return Freight::$messages;
    }
}
