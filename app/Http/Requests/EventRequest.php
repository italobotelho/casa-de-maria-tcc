<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
     *  @return array
     */

     public function rules(): array
     {
         return [
             'title' => 'required|min:3',
             'start' => 'required|date_format:H:i', // Validar apenas a hora
             'end' => 'required|date_format:H:i|after:start', // Validar apenas a hora
         ];
     }

    public function messages(): array    
    {
        return[
            'title.required' => 'Prencha o campo Titulo',
            'title.min' => 'Titulo necessita de pelo menos 03 caracteres',
            'start.date_format' => 'Preencha uma data inicial com valor válido!',
            'start.before' => 'A data/hora inicial deve ser menor que a data final',
            'end.date_format' => 'Preencha uma data final com valor válido!',
            'end.after' => 'A data/hora final deve ser maior que a data inicial',
        ];
    }
}
